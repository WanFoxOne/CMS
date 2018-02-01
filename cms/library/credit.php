<?php
/**
 * Created by PhpStorm.
 * User: corler1u
 * Date: 23/11/2017
 * Time: 10:05
 */


function user_get_credit($user_id)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $tabuser = db_prefix_table('credit');

    $sql = "SELECT * FROM `credits` WHERE user_id = {$user_id} LIMIT 1";

    $r = db_query($sql);

    if (!$r) {
        return false;
    }

    return $r[0]['credit'];
}

function user_add_credit($user_id, $count)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $sql = "UPDATE `credits` SET `credit` = (`credit` + {$count}) WHERE `user_id` = {$user_id}";

    return db_update($sql);

}

function user_remove_credit($user_id, $count)
{
    if (!is_numeric($user_id)) {
        return false;
    }

    $sql = "UPDATE `credits` SET `credit` = (`credit` - {$count}) WHERE `user_id` = {$user_id} AND `credit` >= {$count};";


    return db_update($sql);
}