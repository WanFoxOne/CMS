<?php

/**
 *
 * @copyright  2010-2016 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 *
 * Edité par CORLER Damien
 */

require_once 'readarg.php';
require_once 'strflat.php';
require_once 'validateurl.php';
require_once 'validatecolor.php';
require_once 'ismailinjected.php';
require_once 'tokenid.php';
require_once 'qrencode.php';
require_once 'qrgenerator.php';
require_once 'credit.php';

function bl_qrcode($lang)
{

    $user_id = null;
    $credit = null;
    if (user_is_identified()) {
        $user_id = $_SESSION['user']['id'];
        $credit = user_get_credit($user_id);
    }

    $action = 'init';
    if (isset($_POST['qrcode_generate_send'])) {
        $action = 'send';
    }

    $url_target = $color_1 = $color_2 = $quality = $size = $code = $token = false;

    global $debug;
    $debug = null;

    switch ($action) {
        case 'send':
            if (isset($_POST['qrcode_url_target'])) {
                $url_target = strip_tags(readarg($_POST['qrcode_url_target'], true));
            }
            if (isset($_POST['qrcode_code'])) {
                $code = readarg($_POST['qrcode_code'], true);
            }
            if (isset($_POST['qrcode_token'])) {
                $token = readarg($_POST['qrcode_token']);
            }
            if (isset($_POST['qrcode_quality'])) {
                $quality = readarg($_POST['qrcode_quality']);
            }
            if (isset($_POST['qrcode_size'])) {
                $size = readarg($_POST['qrcode_size']);
            }
            if (isset($_POST['qrcode_color_1'])) {
                $color_1 = readarg($_POST['qrcode_color_1']);
            }
            if (isset($_POST['qrcode_color_2'])) {
                $color_2 = readarg($_POST['qrcode_color_2']);
            }
            break;
        default:
            break;
    }

    $qrcode_ready = false;

    $missing_code = false;
    $bad_code = false;

    $bad_token = false;

    $missing_target_url = false;
    $bad_target_url = false;

    $missing_size = false;
    $missing_quality = false;
    $missing_color_1 = false;
    $bad_color_1 = false;
    $missing_color_2 = false;
    $bad_color_2 = false;

    $not_enough_credit = false;

    $home_page = url('home', $lang);

    $internal_error = false;

    $with_captcha = true;

    switch ($action) {
        case 'send':
            if (!isset($_SESSION['qrcode_token']) or $token != $_SESSION['qrcode_token']) {
                $bad_token = true;
                break;
            }

            if ($with_captcha) {
                if (!$code) {
                    $missing_code = true;
                    break;
                }
                $captcha = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : false;
                if (!$captcha or $captcha != strtoupper($code)) {
                    $bad_code = true;
                    break;
                }
            }

            if (!$url_target) {
                $missing_target_url = true;
            } else if (!validate_url($url_target)) {
                $bad_target_url = true;
            }

            // ToDo : effectuer des vérifications
            if (!$quality) {
                $missing_quality = true;
            }

            // ToDo : effectuer des vérifications
            if (!$size) {
                $missing_size = true;
            }


            if (!$color_1) {
                $missing_color_1 = true;
            } else if (!validate_color($color_1)) {
                $bad_color_1 = true;
            }
            if (!$color_2) {
                $missing_color_2 = true;
            } else if (!validate_color($color_2)) {
                $bad_color_2 = true;
            }

            break;
        default:
            break;
    }

    switch ($action) {
        case 'send':
            if ($bad_token or $missing_code or $bad_code or $missing_target_url or $bad_target_url or $missing_size
                or $missing_quality or $missing_color_1 or $missing_color_2 or $bad_color_1 or $bad_color_2) {
                break;
            }

            // Hash des paramètres pour éviter des doublons
            $qrcode_file_name = 'qr_' . hash('md5', $url_target . $color_1 . $color_2 . $quality . $size) . '.png';

            // Vérifier si le fichier existe
            if (file_exists(ROOT_DIR . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'qrcodes' . DIRECTORY_SEPARATOR . $qrcode_file_name)) {

                $url_qrcode = '/images/qrcodes/' . $qrcode_file_name;
                $qrcode_ready = true;

            } else {

                $qrcode_standard = true;

                // Si l'utilisateur est connecté
                if ($user_id !== null) {

                    // Réduire son nombre de crédits
                    if (user_remove_credit($user_id, 10)) {

                        if ($url_qrcode = qrgenerator($qrcode_file_name, $url_target, $quality, $size, $color_1, $color_2)) {

                            $qrcode_ready = true;
                            $qrcode_standard = false;

                        } else {
                            $internal_error = true;
                        }

                        $credit = user_get_credit($user_id);

                    } else {

                        $not_enough_credit = true;
                    }

                }

                // Si aucune action premium n'est effectuée, générer un QRCode standard
                if ($qrcode_standard) {
                    if ($url_qrcode = qrgenerator($qrcode_file_name, $url_target, $quality)) {
                        $qrcode_ready = true;
                    } else {
                        $internal_error = true;
                    }
                }

            }

            break;
        default:
            break;
    }

    $_SESSION['qrcode_token'] = $token = token_id();

    $errors = compact('missing_code', 'bad_code', 'missing_target_url', 'bad_target_url', 'missing_size', 'missing_quality', 'missing_color_1', 'missing_color_2', 'bad_color_1', 'bad_color_2', 'internal_error', 'not_enough_credit');
    $infos = compact('qrcode_ready', 'home_page');

    $output = view('form_qrcode', $lang, compact('token', 'with_captcha', 'url_target', 'message', 'errors', 'infos', 'url_qrcode', 'qrcode_ready', 'color_1', 'color_2', 'credit', 'debug'));

    return $output;
}
