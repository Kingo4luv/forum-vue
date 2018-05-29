<?php
/**
 * Created by PhpStorm.
 * User: kingo4luv
 * Date: 5/29/18
 * Time: 11:25 AM
 */

namespace App\Inspections;


class Spam
{
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    public function detect($body){

        foreach ($this->inspections as $inspection){
            app($inspection)->detect($body);
        }


        return false;

    }



}