<?php

namespace Tests\Unit;

use App\Services\SoundCallService;
use Mockery;
use Tests\TestCase;

class SoundCallServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    private function buildService()
    {
        return new SoundCallService;
    }

    private function basenames(array $paths)
    {
        return array_map(fn ($path) => basename($path), $paths);
    }

    /**
     * @dataProvider singleDigitProvider
     */
    public function test_single_digit_queue_number($number, $expectedSound)
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('A', (string) $number, 3));

        $this->assertSame([
            'nomor.wav',
            'antrian.wav',
            'a.wav',
            $expectedSound,
            'menuju.wav',
            'teller.wav',
            'tiga.wav',
        ], $sounds);
    }

    public function singleDigitProvider()
    {
        return [
            [1, 'satu.wav'],
            [5, 'lima.wav'],
            [9, 'sembilan.wav'],
        ];
    }

    /**
     * @dataProvider twoDigitProvider
     */
    public function test_two_digit_queue_number($number, array $expectedSounds)
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('A', (string) $number, 3));

        $this->assertSame(array_merge([
            'nomor.wav',
            'antrian.wav',
            'a.wav',
        ], $expectedSounds, [
            'menuju.wav',
            'teller.wav',
            'tiga.wav',
        ]), $sounds);
    }

    public function twoDigitProvider()
    {
        return [
            [10, ['sepuluh.wav']],
            [11, ['sebelas.wav']],
            [12, ['dua.wav', 'belas.wav']],
            [19, ['sembilan.wav', 'belas.wav']],
            [20, ['dua.wav', 'puluh.wav']],
            [21, ['dua.wav', 'puluh.wav', 'satu.wav']],
            [25, ['dua.wav', 'puluh.wav', 'lima.wav']],
            [90, ['sembilan.wav', 'puluh.wav']],
            [99, ['sembilan.wav', 'puluh.wav', 'sembilan.wav']],
        ];
    }

    /**
     * @dataProvider threeDigitProvider
     */
    public function test_three_digit_queue_number($number, array $expectedSounds)
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('A', (string) $number, 3));

        $this->assertSame(array_merge([
            'nomor.wav',
            'antrian.wav',
            'a.wav',
        ], $expectedSounds, [
            'menuju.wav',
            'teller.wav',
            'tiga.wav',
        ]), $sounds);
    }

    public function threeDigitProvider()
    {
        return [
            [100, ['seratus.wav']],
            [101, ['seratus.wav', 'satu.wav']],
            [105, ['seratus.wav', 'lima.wav']],
            [110, ['seratus.wav', 'sepuluh.wav']],
            [111, ['seratus.wav', 'sebelas.wav']],
            [115, ['seratus.wav', 'lima.wav', 'belas.wav']],
            [120, ['seratus.wav', 'dua.wav', 'puluh.wav']],
            [123, ['seratus.wav', 'dua.wav', 'puluh.wav', 'tiga.wav']],
            [199, ['seratus.wav', 'sembilan.wav', 'puluh.wav', 'sembilan.wav']],
            [200, ['dua.wav', 'ratus.wav']],
            [205, ['dua.wav', 'ratus.wav', 'lima.wav']],
            [250, ['dua.wav', 'ratus.wav', 'lima.wav', 'puluh.wav']],
            [500, ['lima.wav', 'ratus.wav']],
            [999, ['sembilan.wav', 'ratus.wav', 'sembilan.wav', 'puluh.wav', 'sembilan.wav']],
        ];
    }

    public function test_unit_service_a_uses_teller_footer()
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('A', '5', 3));

        $this->assertContains('a.wav', $sounds);
        $this->assertContains('teller.wav', $sounds);
        $this->assertNotContains('customer_service.wav', $sounds);
    }

    public function test_unit_service_b_uses_cs_footer()
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('B', '5', 3));

        $this->assertContains('b.wav', $sounds);
        $this->assertContains('customer_service.wav', $sounds);
        $this->assertNotContains('teller.wav', $sounds);
    }

    public function test_unit_service_c_uses_cs_footer()
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('C', '5', 3));

        $this->assertContains('c.wav', $sounds);
        $this->assertContains('customer_service.wav', $sounds);
        $this->assertNotContains('teller.wav', $sounds);
    }

    public function test_unit_service_is_case_insensitive()
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('a', '5', 3));

        $this->assertContains('a.wav', $sounds);
    }

    public function test_unknown_unit_service_is_skipped_without_error()
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('X', '5', 3));

        $this->assertSame([
            'nomor.wav',
            'antrian.wav',
            'lima.wav',
            'menuju.wav',
            'customer_service.wav',
            'tiga.wav',
        ], $sounds);
    }

    /**
     * @dataProvider counterNumberProvider
     */
    public function test_counter_number_maps_to_sound($counterNumber, $expectedSound)
    {
        $sounds = $this->basenames($this->buildService()->buildSoundPaths('A', '5', $counterNumber));

        $this->assertSame($expectedSound, end($sounds));
    }

    public function counterNumberProvider()
    {
        return [
            [1, 'satu.wav'],
            [5, 'lima.wav'],
            [10, 'sepuluh.wav'],
        ];
    }

    public function test_play_v1_sends_merged_sound_paths_to_initiate_sound()
    {
        config(['site.versionCaller' => 'v1']);

        $service = Mockery::mock(SoundCallService::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $service->shouldReceive('initiateSound')->once()
            ->withArgs(function ($sounds) {
                return $this->basenames($sounds) === [
                    'nomor.wav',
                    'antrian.wav',
                    'a.wav',
                    'dua.wav',
                    'puluh.wav',
                    'lima.wav',
                    'menuju.wav',
                    'teller.wav',
                    'tiga.wav',
                ];
            });

        $service->play('25', 'A', 3);

        $this->addToAssertionCount(1);
    }

    public function test_play_v2_dispatches_caller_exe()
    {
        config(['site.versionCaller' => 'v2']);

        $service = Mockery::mock(SoundCallService::class)
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        $service->shouldReceive('dispatchCallerExe')->once()->with('25', 'A', 3);

        $service->play('25', 'A', 3);

        $this->addToAssertionCount(1);
    }
}
