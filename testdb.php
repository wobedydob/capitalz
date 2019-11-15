<?php

include 'autoloader.php';

$db = new Database();

$db->query('SELECT
                userId,
                AES_DECRYPT(email, "' . AES . '") AS email, 
                password, 
                userrole
            FROM user');
$db->execute();

$userArr = $db->resultset()[0];

$db->query('SELECT `key`, `value` FROM user_info WHERE userId = :userid');
$db->bind(':userid', (int)$userArr['userId']);

$db->execute();
$infoArr = $db->resultset();

$formatArr = array();
foreach ($infoArr as $value) {
    $formatArr[$value['key']] = $value['value'];
}

function get_userinfo(string $key = '')
{
    if ($key) return $this->formatArr[$key];
    else return $this->formatArr;
}

echo get_userinfo('kvk');