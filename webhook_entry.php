<?php

use Tracy\Debugger;
use Webhook\Hook;

include_once('vendor/autoload.php');
Debugger::enable();


$hook = new Hook('6O<<sYq0037H4i#O9o?90<6@4FrOo`');

if($hook->isValidSignature()) {
    $hook->pull();
}