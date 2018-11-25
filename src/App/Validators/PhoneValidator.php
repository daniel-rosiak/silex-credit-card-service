<?php

namespace App\Validators;

class PhoneValidator extends BaseValidator implements ValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        
        if(preg_match("/^(\(\+[0-9]{2,3}\))?[0-9]{9,11}$/", $value)) {
            $this->is_valid = true;
        }
        
        return $this->is_valid;
    }

}
