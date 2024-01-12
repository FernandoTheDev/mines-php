<?php

/**
* https://github.com/fernandothedev/mines-php
* @copyright 2023 - 2024
*/

namespace App;

/**
* Classe que gera os sinais com seus métodos
*/
class Mines
{
    /**
    * Quantidade de Bombas
    */
    const BOMBS_TOTAL = 25;

    /**
    * Dados do sinal
    * sinal = [
    *    "minutos",
    *    "tentativas",
    *    "quantidade_minas"
    *    "map"
    * ]
    * @value array
    */
    protected array $sinal;

    /**
    * Retorna o número de diamantes
    * @return int
    */
    public function getDiamondQuantity(): int
    {
        return rand(1, 5);
    }

    /**
    * Retorna a quantidade de bombas e diamantes
    * @return string
    */
    public function getBombMap(): string
    {
        $diamonds = $this->getDiamondQuantity();
        $bombs = str_repeat("B", (self::BOMBS_TOTAL - $diamonds)) . str_repeat("D", $diamonds);
        return str_shuffle($bombs);
    }

    /**
    * Retorna nosso mapa de minas
    * @return string
    */
    public function createMap(): string
    {
        $bombMap = $this->getBombMap();
        $map = [];

        for ($i = 0; $i <= 5; $i++) {
            $map[] = substr($bombMap, $i * 5, 5);
        }

        $map = implode("\n", $map);
        $map = str_ireplace("B", "💣", $map);
        $map = str_ireplace("D", "💎", $map);

        return $map;
    }

    /**
    * Metodo que seta alguns parâmetros e retorna o $sinal
    * @return array
    */
    public function getSinal(): array
    {
        $this->sinal['minutos'] = rand(4, 5);
        $this->sinal['tentativas'] = rand(2, 3);
        $this->sinal['quantidade_minas'] = rand(3, 5);
        $this->sinal['map'] = $this->createMap();
        return $this->sinal;
    }

    /**
    * Metodo Estático para construir a mensagem do Mine
    * @parameter Array $sinal
    * sinal = [
    *    "minutos",
    *    "tentativas",
    *    "quantidade_minas"
    *    "map"
    * ]
    * @return string
    */
    public static function make(array $sinal): string
    {
        return "🔥* SINAL ENCONTRADO* 🔥\n\n💣 MINES VIP 💣\n\n{$sinal['map']}\n\nN° tentativas: *{$sinal['tentativas']}*\nQuantidade de minas: *{$sinal['quantidade_minas']}*\nVálido por *{$sinal['minutos']}* minutos.\n\nDesenvolvido por @fernandothedev";
    }
}