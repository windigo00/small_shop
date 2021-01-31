<?php

namespace Modules\Core\SmallShop\Business\Services\Invoice;

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;

class Utils
{
    public static function format_price(float $value): string
    {
        return number_format($value, 2, ',', ' ');
    }

    public static function bar_code_base64(int $value): string
    {
        return 'data:image/png;base64,' . base64_encode(self::bar_code($value));
    }
    
    public static function bar_code(int $value): ?string
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $image = $generator->getBarcode($value, $generator::TYPE_UPC_A, 2, 80);
        return $image !== false ? $image : null;
    }

    public static function qr_code(string $value): string
    {
        $options = new QROptions([
                'version'    => 8,
                'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                'eccLevel'   => QRCode::ECC_L,
                'imageBase64'=> false,
        ]);

        // invoke a fresh QRCode instance
        $qrcode = new QRCode($options);
        return $qrcode->render($value);
    }
    
    public static function qr_code_base64(string $value): string
    {
        return 'data:image/png;base64,' . base64_encode(self::qr_code($value));
    }


}
