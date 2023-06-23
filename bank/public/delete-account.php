<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $accounts = file_get_contents(__DIR__ . '/../accounts.ser');
    $accounts = $accounts ? unserialize($accounts) : [];
    $accountId = $_GET['id'];

    foreach ($accounts as $acc) {
        if($acc['id'] == $accountId) {
            if($acc['balance'] === 0) {
                $accounts = array_filter($accounts, fn ($a) => $a['id'] != $accountId);
            } else {
                header('Location: ./main.php?alert=2');
                die;
            }
        }
    }

    $accounts = serialize($accounts);
    file_put_contents(__DIR__ . '/../accounts.ser', $accounts);
    header('Location: ./main.php?alert=3');
    die;
}