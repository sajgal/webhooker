<?php

$post = file_gets_contents('php://input');

if (!empty($post['payload'])) {
    $payload = json_decode($post['payload']);

    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $payload);
    echo 'Posted ----- ';
    echo $payload;
    exit;
}

echo 'not Posted';