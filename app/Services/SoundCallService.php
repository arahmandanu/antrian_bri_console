<?php

namespace App\Services;

use App\Enum\CodeServiceEnum;
use App\Models\ButtonActor;
use App\Models\OriginCustomer;
use Illuminate\Support\Str;

class SoundCallService
{
    public $originCustomer, $buttonActor;
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
        'menuju' => 'menuju'
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
        $counter = $this->listSound[(string)$buttonActor->counter_number] . '.wav';
        return [
            base_path('console\menuju.wav'),
            base_path('console\counter.wav'),
            base_path("console/$counter")
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
        # ditambahkan a / b nya dlu

        $sound = [];
        array_push($sound, $this->listSound[Str::lower((string)$unitService)]);
        if (sizeof($splittedNumber) == 1) {
            array_push($sound, $this->listSound[(string)$queueNumber]);
        } else if (sizeof($splittedNumber) == 2) {
            if ($queueNumber == 11 || $queueNumber == 10) {
                array_push($sound, $this->listSound[(string)$queueNumber]);
            } else {
                foreach ($splittedNumber as $key => $value) {
                    # last number
                    if ($key + 1 === sizeof($splittedNumber)) {
                        array_push($sound, $this->listSound['puluh']);
                    } else if ($value !== '0') {
                        array_push($sound, $this->listSound[(string)$value]);
                    }
                }
            }
        }

        $soundPath = [];
        foreach ($sound as $key => $item) {
            $file = "console/$item.wav";
            array_push($soundPath, base_path($file));
        }
        return $soundPath;
    }

    private function initiateSound($sounds)
    {
        foreach ($sounds as $key => $value) {
            exec('powershell -c (New-Object Media.SoundPlayer "' . $value . '").PlaySync();');
        }
    }
}
