<?php


namespace App\Library\Contracts;

/**
 * Interface ParserInterface
 * @package App\Library\Contracts
 */
interface ParserInterface
{
    public function parse(array $options = []);
}