<?php

namespace App\Validators;

class DateValidator extends BaseValidator implements ValidatorInterface
{
    /**
     * @param $value
     * @param array $options
     * @return bool
     */
    public function validate($value, $options = array()) 
    {
        
        if (preg_match("/^((0[1-9])|(1[1-2]))-[0-9]{2}$/",$value) && ($date = \DateTime::createFromFormat("m-y", $value)) !== false) {

            if(isset($options['min_date']) && $date <= $options['min_date'] ) {

                return $this->is_valid;

            }

            $this->is_valid = true;
        }

        return $this->is_valid;
        
    }

}
