<?php

namespace App\Services;

use App\Models\ButtonActor;
use App\Models\OriginCustomer;
use Illuminate\Support\Str;

class SoundCallService
{
    public $originCustomer;

    public $buttonActor;

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
        'teller' => 'tlr',
        'cs' => 'cs',
        'counter' => 'counter',
        'puluh' => 'puluh',
        'menuju' => 'menuju',
        'ratus' => 'ratus',
    ];

    public function __construct(OriginCustomer $originCustomer, ButtonActor $buttonActor)
    {
        $this->originCustomer = $originCustomer;
        $this->buttonActor = $buttonActor;
        $this->buttonActor = $buttonActor;
    }

    public function playSound()
    {
        $listSoundKounter = $this->headerSound($this->buttonActor);
        $listSoundForQueueNumber = $this->listNumberSound($this->buttonActor->unit_service, $this->originCustomer->origin_queue_number);
        $listSoundFooter = $this->footerSound($this->buttonActor);

        $this->initiateSound(array_merge($listSoundKounter, $listSoundForQueueNumber, $listSoundFooter));
    }

    private function footerSound(ButtonActor $buttonActor)
    {
        $counter = $this->listSound[(string) $buttonActor->counter_number] . '.wav';

        return [
            base_path('console\menuju.wav'),
            base_path('console\counter.wav'),
            base_path("console/$counter"),
        ];
    }

    private function headerSound(ButtonActor $buttonActor)
    {
        return [
            base_path('console\nomor.wav'),
            base_path('console\antrian.wav'),
        ];
    }

    private function listNumberSound($unitService, $queueNumber)
    {
        $splittedNumber = str_split($queueNumber);
        $sound = [];
        array_push($sound, $this->listSound[Str::lower((string) $unitService)]);
        if (count($splittedNumber) == 1) {
            array_push($sound, $this->listSound[(string) $queueNumber]);
        } elseif (count($splittedNumber) == 2) {
            $puluhan = $this->formatPuluhan($queueNumber, $splittedNumber);
            $sound = array_merge($sound, $puluhan);
        } elseif (count($splittedNumber) == 3) {
            $ratusan = $this->formatRatusan($queueNumber, $splittedNumber);
            $sound = array_merge($sound, $ratusan);
        }

        $soundPath = [];
        foreach ($sound as $key => $item) {
            $file = "console/$item.wav";
            array_push($soundPath, base_path($file));
        }

        return $soundPath;
    }

    private function formatRatusan($queueNumber, $splittedNumber)
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
            $bodySound = array_merge($bodySound, $this->formatPuluhan(implode($splittedNumber), str_split((int) implode($splittedNumber))));
        }

        return array_merge($headSound, $bodySound);
    }

    private function formatPuluhan($queueNumber, $splittedNumber)
    {
        $puluhan = [];
        if ((string) $queueNumber == '11' || (string) $queueNumber == '10') {
            array_push($puluhan, $this->listSound[(string) $queueNumber]);
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

    private function initiateSound($sounds)
    {
        foreach ($sounds as $key => $value) {
            exec('powershell -c (New-Object Media.SoundPlayer "' . $value . '").PlaySync();');
        }
    }
}
