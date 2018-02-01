<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 *
 * Edité par CORLER Damien
 */

function qrcode($lang) {

    head('title', translate('contact:title', $lang));
    head('description', false);
    head('keywords', false);
    head('robots', 'noindex, nofollow');
    head('javascript', 'jquery');
    head('javascript', 'jquery.minicolors.min');

    $banner = build('banner', $lang);

    $bl_qrcode = build('bl_qrcode', $lang);

    $content = view('v_qrcode', $lang, compact('bl_qrcode'));

    $output = layout('standard', compact('banner', 'content'));

    return $output;
}