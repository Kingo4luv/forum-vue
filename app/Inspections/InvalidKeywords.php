<?php
/**
 * Created by PhpStorm.
 * User: kingo4luv
 * Date: 5/29/18
 * Time: 11:50 AM
 */

namespace App\Inspections;

use Exception;


class InvalidKeywords
{
    protected $keywords = [
        'yahoo customer support'
    ];

    public function detect($body){

        foreach ($this->keywords as $keyword){
            if(stripos($body, $keyword) !== false){
                throw new Exception('Your reply contains spam.');
            }
        }
    }

}