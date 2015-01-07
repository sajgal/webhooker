<?php

use Tracy\Debugger;
use Webhook\Hook;

include_once('vendor/autoload.php');
Debugger::enable(Debugger::DEVELOPMENT);



$hook = new Hook();

\Tracy\Debugger::dump($_SERVER);