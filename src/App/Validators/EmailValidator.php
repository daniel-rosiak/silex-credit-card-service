<?php

namespace App\Validators;

class EmailValidator extends BaseValidator implements ValidatorInterface
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value)
    {
        if(!filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
            $this->is_valid = true;
        }

        return $this->is_valid;
    }

}
