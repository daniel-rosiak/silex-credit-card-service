<?php

namespace App\Validators;

class Cvv2Validator extends BaseValidator implements ValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value) 
    {
        //I dont know what algorithm is used fot cvv validation
        if((strlen($value) == 3 || strlen($value) == 4)  && is_numeric($value)) {
            $this->is_valid = true;
        }
        return $this->is_valid;
    }

}
