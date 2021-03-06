<?php

/**
 *
 * @copyright  2010 frasq.org
 * @version    2
 * @link       http://www.frasq.org
 */

define('AVATAR_SIZE', 40);
define('AVATARS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'avatars');

function user_create_avatar($name)
{
    require_once 'identicon.php';

    $img = identicon($name, AVATAR_SIZE);

    $r = imagepng($img, AVATARS_DIR . DIRECTORY_SEPARATOR . $name . '.png');

    return $r;
}

function user_delete_avatar($name)
{
    @unlink(AVATARS_DIR . DIRECTORY_SEPARATOR . $name . '.png');
}

function user_create($name, $password, $mail, $locale = 'fr')
{
    $sqlname = db_sql_arg($name, true);
    $sqlmail = db_sql_arg($mail, true);
    $sqllocale = db_sql_arg($locale);

    $sqlpassword = $password ? '\'' . md5($password) . '\'' : NULL;

    $tabuser = db_prefix_table('user');

    $sql = "INSERT IGNORE $tabuser (name, password, mail, created, locale) VALUES ($sqlname, $sqlpassword, $sqlmail, NOW(), $sqllocale)";

    $r = db_insert($sql);

    if (!$r) {
        return false;
    }

    $user_id = db_insert_id();

    user_create_avatar($name);

    return $user_id;
}

function user_set_newpassword($user_id, $password)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $sqlnewpassword = $password ? '\'' . md5($password) . '\'' : NULL;

    $tabuser = db_prefix_table('user');

    $sql = "UPDATE $tabuser SET newpassword=$sqlnewpassword WHERE user_id=$user_id LIMIT 1";

    $r = db_update($sql);

    return $r;
}

function user_get($user_id)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $tabuser = db_prefix_table('user');

    $sql = "SELECT name AS user_name, password AS user_password, newpassword AS user_newpassword, mail AS user_mail, UNIX_TIMESTAMP(created) AS user_created, UNIX_TIMESTAMP(access) AS user_access, locale AS user_locale, active AS user_active, banned AS user_banned FROM $tabuser WHERE user_id=$user_id LIMIT 1";

    $r = db_query($sql);

    return $r ? $r[0] : false;
}

function user_get_role($user_id)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $tabrole = db_prefix_table('role');
    $tabuserrole = db_prefix_table('user_role');

    $sql = "SELECT r.name AS role_name FROM $tabuserrole ur JOIN $tabrole r ON r.role_id=ur.role_id WHERE ur.user_id=$user_id";

    $r = db_query($sql);

    if (!$r) {
        return false;
    }

    $role = array();

    foreach ($r as $v) {
        $role[] = $v['role_name'];
    }

    return $role;
}

function user_find($login)
{
    $sqllogin = db_sql_arg($login, true);

    $tabuser = db_prefix_table('user');

    $sql = "SELECT user_id FROM $tabuser WHERE name=$sqllogin OR mail=$sqllogin LIMIT 1";

    $r = db_query($sql);

    return $r ? $r[0]['user_id'] : false;
}

function user_login($login, $password)
{
    $user_id = user_find($login);

    if (!$user_id) {
        return false;
    }

    $r = user_get($user_id);

    if (!$r) {
        return false;
    }

    extract($r);    /* user_name user_password user_mail user_created user_access user_locale user_active user_banned */

    if (!$user_active or $user_banned) {
        return false;
    }

    $password = md5($password);

    if (!($password == $user_password or $password == $user_newpassword)) {
        return false;
    }

    $now = time();

    $user = array();
    $user['id'] = $user_id;
    $user['name'] = $user_name;
    $user['mail'] = $user_mail;
    $user['locale'] = $user_locale;
    $user['created'] = (int)$user_created;
    $user['access'] = $now;

    $r = user_get_role($user_id);

    $user['role'] = $r;

    $tabuser = db_prefix_table('user');

    if ($user_newpassword) {
        if ($password == $user_newpassword) {
            // use the new one
            $sql = "UPDATE $tabuser SET access=FROM_UNIXTIME($now), password='$user_newpassword', newpassword=NULL WHERE user_id=$user_id LIMIT 1";
        } else {
            // keep the old one
            $sql = "UPDATE $tabuser SET access=FROM_UNIXTIME($now), newpassword=NULL WHERE user_id=$user_id LIMIT 1";
        }
    } else {
        // just keep track
        $sql = "UPDATE $tabuser SET access=FROM_UNIXTIME($now) WHERE user_id=$user_id LIMIT 1";
    }

    db_update($sql);

    return $user;
}

function user_check_name($name)
{
    $sqlname = db_sql_arg($name, true);

    $tabuser = db_prefix_table('user');

    $sql = "SELECT user_id FROM $tabuser WHERE name=$sqlname LIMIT 1";

    $r = db_query($sql);

    return $r ? false : true;
}

function user_check_mail($mail)
{
    $sqlmail = db_sql_arg($mail, true);

    $tabuser = db_prefix_table('user');

    $sql = "SELECT user_id FROM $tabuser WHERE mail=$sqlmail LIMIT 1";

    $r = db_query($sql);

    return $r ? false : true;
}
