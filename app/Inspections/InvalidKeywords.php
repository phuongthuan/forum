<?php

namespace App\Inspections;

class InvalidKeywords
{

    protected $keywords = [
        'yahoo customer support'
    ];

    /**
     * @param $body
     * @return void
     * @throws \Exception
     */
    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if  (stripos($body, $keyword) !== false) {
                throw new \Exception('Your reply contains spam.');
            }
        }
    }
}