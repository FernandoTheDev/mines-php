<?php

/**
* https://github.com/fernandothedev/mines-php
* @copyright 2023 - 2024
*/

namespace App;

/**
* Classe que realize as requesicoes
*/
class Bot {
    /**
    * Token do seu Bot
    * @value string
    */
    private string $bot_token;

    public function __construct(string $token = '') {
        if ($token == '') {
            throw new \Exception('Token is missing');
        }

        $this->bot_token = $token;
    }

    /**
    * Metodo que faz o sendMessage
    * @parameter String or Array $text, Array or Null $arg
    * @return array
    */
    public function sendMessage(string|array $text, ?array $arg = NULL): array
    {
        if (is_string($text) and !is_null($arg)) {
            $arg["text"] = $text;
            $arg["parse_mode"] = "Markdown";
            return $this->request("sendMessage", $arg);
        }

        throw new \Exception("Parameters incorrects");
    }

    /**
    * Metodo para fazer requesicoes
    * @return array
    */
    private function request(string $method, array $arg): array
    {
        $url = sprintf('https:///api.telegram.org/bot%s/%s?%s', $this->bot_token, $method, http_build_query($arg));

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $response;
    }
}