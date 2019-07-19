<?php


namespace App\Library\Contracts;

/**
 * Interface ParserInterface
 * @package App\Library\Contracts
 */
interface ParserInterface
{
    /**
     * @param array $options
     * @return mixed
     */
    public function parse(array $options = []);
}