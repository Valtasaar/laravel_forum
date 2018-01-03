<?php

namespace App\Inspections;


class KeyHeldDown
{
    /**
     * Detect key held down.
     *
     * @param $body
     * @throws \Exception
     */
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new \Exception('You reply contains spam.');
        }
    }
}