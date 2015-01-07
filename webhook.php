<?php

if (isset($_POST) && !empty($_POST)) {
    file_put_contents(time(), $_POST);
    echo 'Posted';
}

echo '...';
