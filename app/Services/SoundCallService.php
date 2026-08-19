<?php

namespace App\Services;

use App\Enum\CodeServiceEnum;
use Illuminate\Support\Str;

class SoundCallService
{
    private $listSound = [
        '1' => 'satu',
        '2' => 'dua',
        '3' => 'tiga',
        '4' => 'empat',
        '5' => 'lima',
        '6' => 'enam',
        '7' => 'tujuh',
        '8' => 'delapan',
        '9' => 'sembilan',
        '10' => 'sepuluh',
        '11' => 'sebelas',
        'se' => 'se',
        'seratus' => 'seratus',
        'a' => 'a',
        'b' => 'b',
        'c' => 'c',
        'teller' => 'tlr',
        'cs' => 'cs',
        'counter' => 'counter',
        'puluh' => 'puluh',
        'menuju' => 'menuju',
        'ratus' => 'ratus',
        'belas' => 'belas',
    ];

    public function play(string $queueNumber, string $unitService, int $counterNumber)
    {
        if (config('site.versionCaller', 'v1') == 'v1') {
            $this->initiateSound($this->buildSoundPaths($unitService, $queueNumber, $counterNumber));
            sleep(1);
        } else {
            $this->dispatchCallerExe($queueNumber, $unitService, $counterNumber);
        }
    }

    public function buildSoundPaths(string $unitService, string $queueNumber, int $counterNumber)
    {
        return array_merge(
            $this->headerSound(),
            $this->listNumberSound($unitService, $queueNumber),
            $this->footerSound($unitService, $counterNumber)
        );
    }

    protected function dispatchCallerExe(string $queueNumber, string $unitService, int $counterNumber)
    {
        $path = base_path('caller.exe');
        exec($path." $queueNumber $unitService $counterNumber");
    }

    private function footerSound(string $unitService, int $counterNumber)
    {
        $counter = $this->listSound[(string) $counterNumber].'.wav';
        if (CodeServiceEnum::TELLER->value == $unitService) {
            $byCounterName = base_path('console\teller.wav');
        } else {
            $byCounterName = base_path('console\customer_service.wav');
        }

        return [
            base_path('console\menuju.wav'),
            $byCounterName,
            base_path("console/$counter"),
        ];
    }

    private function headerSound()
    {
        return [
            base_path('console\nomor.wav'),
            base_path('console\antrian.wav'),
        ];
    }

    private function listNumberSound(string $unitService, string $queueNumber)
    {
        $splittedNumber = str_split($queueNumber);
        $sound = [];
        $unitSound = $this->listSound[Str::lower($unitService)] ?? null;
        if ($unitSound !== null) {
            array_push($sound, $unitSound);
        }
        if (count($splittedNumber) == 1) {
            array_push($sound, $this->listSound[(string) $queueNumber]);
        } elseif (count($splittedNumber) == 2) {
            $puluhan = $this->formatPuluhan($queueNumber, $splittedNumber);
            $sound = array_merge($sound, $puluhan);
        } elseif (count($splittedNumber) == 3) {
            $ratusan = $this->formatRatusan($splittedNumber);
            $sound = array_merge($sound, $ratusan);
        }

        $soundPath = [];
        foreach ($sound as $key => $item) {
            $file = "console/$item.wav";
            array_push($soundPath, base_path($file));
        }

        return $soundPath;
    }

    private function formatRatusan($splittedNumber)
    {
        $headSound = [];
        if ((string) $splittedNumber[0] === '1') {
            array_push($headSound, $this->listSound['seratus']);
        } else {
            array_push($headSound, $this->listSound[(string) $splittedNumber[0]]);
            array_push($headSound, $this->listSound['ratus']);
        }

        $bodySound = [];
        array_shift($splittedNumber);
        if (implode($splittedNumber) != '00') {
            $bodySound = array_merge($bodySound, $this->formatPuluhan(implode($splittedNumber), $splittedNumber));
        }

        return array_merge($headSound, $bodySound);
    }

    private function formatPuluhan($queueNumber, $splittedNumber)
    {
        $puluhan = [];
        $number = (int) $queueNumber;
        if ($number == 11 || $number == 10) {
            array_push($puluhan, $this->listSound[(string) $number]);
        } elseif ($number < 10) {
            if ($number !== 0) {
                array_push($puluhan, $this->listSound[(string) $number]);
            }
        } elseif ($number < 20) {
            array_push($puluhan, $this->listSound[$splittedNumber[1]]);
            array_push($puluhan, $this->listSound['belas']);
        } else {
            foreach ($splittedNumber as $key => $value) {
                // last number
                if ($key + 1 === count($splittedNumber) && (count($splittedNumber) > 1)) {
                    array_push($puluhan, $this->listSound['puluh']);
                    if ($value !== '0') {
                        array_push($puluhan, $this->listSound[(string) $value]);
                    }
                } elseif ($value !== '0') {
                    array_push($puluhan, $this->listSound[(string) $value]);
                }
            }
        }

        return $puluhan;
    }

    protected function initiateSound($sounds)
    {
        $newCommanLine = [];
        foreach ($sounds as $value) {
            array_push($newCommanLine, '(New-Object Media.SoundPlayer "'.$value.'").PlaySync();');
        }
        $list = implode(' ', $newCommanLine);
        $method = getcwd().'\soundcaller.bat';

        // old
        // please use new command
        // exec("start /B cmd /C $method $list", $output);

        // old 2
        // exec('powershell -c ' . join(' ', $newCommanLine) . ' > NUL 2> NUL');

        // NEW FLOW SOUND CALLER
        pclose(popen('start /B cmd /C " '.$method.$list.' >NUL 2>NUL"', 'r'));
    }
}
