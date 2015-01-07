<?php

if (!empty($_POST['payload'])) {
    $payload = json_decode($_POST['payload']);

    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $payload);
    echo 'Posted ----- ';
    echo $payload;
    exit;
}

echo 'not Posted';