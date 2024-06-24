<?php

namespace App\Helper;

use App\Models\Properties;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

trait PrinterThermal
{
    public function execPrint($currentTime, $descTransaction, $unitNextNumber, Properties $properties)
    {
        $usePrinter = env('PRINTER_ENABLED', true);
        if (! $usePrinter) {
            return 'success';
        }

        try {
            $connector = new WindowsPrintConnector($properties->printer_name);
            $printer = new Printer($connector);

            $date = $currentTime->isoFormat('OY-MM-DD HH:mm:ss');
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $logo = EscposImage::load('images/logo_bri_black.png', false);
            $printer->bitImage($logo);
            $printer->feed(1);

            /* HEADER */
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(1, 2);
            $printer->setUnderline(2);
            $printer->text('Selamat datang!');
            $printer->feed(2);
            $printer->setUnderline(0);
            $printer->setTextSize(1, 1);
            $printer->text($date);
            $printer->feed(2);

            // BODY
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text($descTransaction);
            $printer->feed(1);
            $printer->setTextSize(6, 6);
            $printer->setUnderline(0);
            $printer->text($unitNextNumber);
            $printer->feed(2);
            $printer->setTextSize(1, 1);
            $printer->feed();
            $printer->text("Terima kasih atas kedatangan anda.\n");
            $printer->feed(4);
            $printer->text('');
            // END BODY

            $printer->cut();
            $printer->close();
            $status = 'success';
        } catch (\Exception|\TypeError|\Throwable|\ErrorException $e) {
            $status = $e->getMessage();
        }

        return $status;
    }
}
