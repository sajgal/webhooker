<?php

use Tracy\Debugger;
use Webhook\Hook;

include_once('vendor/autoload.php');
Debugger::enable(Debugger::DEVELOPMENT);


$hook = new Hook('6O<<sYq0037H4i#O9o?90<6@4FrOo`');

if(!$hook->validateSignature()) {
    throw new Exception('Signature not valid!');
}

echo $hook->pull();