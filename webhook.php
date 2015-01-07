<?php

if ( $_POST['payload'] ) {
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $_POST['payload']);
    echo 'Posted';
    exit;
}

echo 'not Posted';