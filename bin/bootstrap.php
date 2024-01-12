<?php

use Setup\Parser;
use App\ {
    Mines,
    Bot
};

require_once(__DIR__ . '/../vendor/autoload.php');

$setup = new Parser(__DIR__);
$mines = new Mines();
$bot = new Bot($_SETUP['BOT_TOKEN']);

$bot->sendMessage("*Sistema inicializado*", [
    "chat_id" => $_SETUP['CHAT_ID']
]);

/* Vamos inicilizar um Loop Infinito */
while (true) {
    try {
        $sinal = $mines->getSinal();
        $bot->sendMessage(Mines::make($sinal), [
            "chat_id" => $_SETUP['CHAT_ID']
        ]);

        /* Bota um sleep em minutos e não horas */
        sleep($sinal['minutos'] * 60);
    } catch (\Exception $e) {
        $bot->sendMessage($e->getMessage(), [
            "chat_id" => $_SETUP['CHAT_ID']
        ]);
    }
}