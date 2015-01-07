<?php namespace Webhook;

class Hook
{

}


//$post = file_get_contents('php://input');
//
//if (!empty($post)) {
//
//    try {
//        $payload = json_decode($post);
//
//        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . time() . '.txt', $payload->pusher->email);
//        echo 'Posted ----- ';
//        exit;
//    } catch (Exception $e) {
//        echo $e->getMessage();
//        exit;
//    }
//}