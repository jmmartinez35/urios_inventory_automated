<?php

namespace App\Livewire\Frontend\Borrower;

use Livewire\Component;
use Milon\Barcode\DNS1D;
use Carbon\Carbon;

class Bdownload extends Component
{
    public $imageBarcode, $expire;
    
    public function mount($imageBarcode, $expire)
    {
        $this->imageBarcode = $imageBarcode;
        $this->expire = Carbon::parse($expire)->format('F j, Y');   
    }
    
    public function downloadBarcode()
    {
        if (!$this->imageBarcode) {
            $this->dispatch('saveModal', status: 'warning', position: 'top', message: 'No barcode available to download.');
            return;
        }
    
        $barcode = new DNS1D();
        $barcodeData = base64_decode($barcode->getBarcodePNG($this->imageBarcode, 'C39'));
    
        $width = 400;
        $height = 200;
        $image = imagecreatetruecolor($width, $height);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
    
        // Fill Background with White
        imagefilledrectangle($image, 0, 0, $width, $height, $white);
    
        // Load Barcode Image
        $barcodeImage = imagecreatefromstring($barcodeData);
        $barcodeWidth = imagesx($barcodeImage);
        $barcodeHeight = imagesy($barcodeImage);
    
        // Center Barcode in Image
        $barcodeX = ($width - $barcodeWidth) / 2;
        $barcodeY = ($height - $barcodeHeight) / 3;
    
        // Draw Border Around Barcode
        $borderPadding = 5;
        imagerectangle(
            $image,
            $barcodeX - $borderPadding,
            $barcodeY - $borderPadding, 
            $barcodeX + $barcodeWidth + $borderPadding, 
            $barcodeY + $barcodeHeight + $borderPadding, 
            $black
        );
    
        imagecopy($image, $barcodeImage, $barcodeX, $barcodeY, 0, 0, $barcodeWidth, $barcodeHeight);
    
        $fontSize = 5;
        $expireText = "Expire: " . $this->expire; 
        $textWidth = imagefontwidth($fontSize) * strlen($expireText);
        $textX = ($width - $textWidth) / 2;
        $textY = $height - 25;
    
        imagestring($image, $fontSize, $textX, $textY, $expireText, $black);
    
        $fileName = 'barcode_' . $this->imageBarcode . '.png';
        $filePath = storage_path('app/public/' . $fileName);
        imagepng($image, $filePath);
        imagedestroy($image);
    
        return response()->download($filePath)->deleteFileAfterSend();
    }

    public function render()
    {
        return view('livewire.frontend.borrower.bdownload');
    }
}
