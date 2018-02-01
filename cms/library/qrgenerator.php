<?php
/**
 * Created by PhpStorm.
 * User: corler1u
 * Date: 23/11/2017
 * Time: 10:58
 */

function qrgenerator($qrcode_file_name, $url_target, $quality = "L", $size = 5, $color_1 = "#000000", $color_2 = "#FFFFFF", $margin = 2) {

    // Génération du QR Code
    $size = (int)$size;
    $margin = 0;
    $png = qrencode($url_target, $size, $quality, $color_1, $color_2, $margin);
    $url_qrcode = null;

    // Enregistrement du QR Code
    if ($png) {
        if (file_put_contents(ROOT_DIR . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'qrcodes' . DIRECTORY_SEPARATOR . $qrcode_file_name, $png)) {
            return ('/images/qrcodes/' . $qrcode_file_name);
        }
    }

    return false;
}