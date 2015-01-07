<?php

if (isset($_POST)) {
    file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $_POST);
    echo 'Posted';
    exit;
}

echo '...';

