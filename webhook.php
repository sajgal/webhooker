<?php

$post = file_get_contents('php://input');

if (!empty($post)) {
    $payload = json_decode($post);

    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $payload);
    echo 'Posted ----- ';
    echo $payload;
    exit;
}

echo 'not Posted';