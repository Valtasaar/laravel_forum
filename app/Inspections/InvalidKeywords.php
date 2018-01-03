<?php

namespace App\Inspections;


class InvalidKeywords
{
    protected $keywords = [
        'yahoo Customer Support'
    ];

    /**
     * Detect invalid keywords
     *
     * @param $body
     * @throws \Exception
     */
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception('You reply contains spam.');
            };
        }
    }
}