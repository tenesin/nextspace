<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode; // Import the QrCode facade

class QrCodeController extends Controller
{
    /**
     * Generate and return a QR code image.
     *
     * @param string $data The data to encode in the QR code.
     * @return \Illuminate\Http\Response
     */
    public function generate($data)
    {
        // Set the size and format of the QR code
        // You can customize size(), format('png' or 'svg'), color(), backgroundColor() etc.
        $qrCode = QrCode::size(150)->format('png')->generate($data);

        // Return the QR code as an image response
        return response($qrCode)->header('Content-Type', 'image/png');
    }
}