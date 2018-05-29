<?php
/**
 * Created by PhpStorm.
 * User: kingo4luv
 * Date: 5/29/18
 * Time: 12:00 PM
 */

namespace App\Inspections;

use Exception;

class KeyHeldDown
{
    public function detect($body){

        if(preg_match('/(.)\\1{4,}/', $body)){
            throw new Exception('Your reply contains spam.');
        }
    }


}