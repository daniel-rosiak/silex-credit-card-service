<?php

namespace App\Validators;


interface ValidatorInterface
{
    /**
     * @param $value
     * @return mixed
     */
    public function validate($value);
}
