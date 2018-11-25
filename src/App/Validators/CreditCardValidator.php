<?php

namespace App\Validators;

class CreditCardValidator extends BaseValidator implements ValidatorInterface
{

    /**
     * @param $value
     * @return bool
     */
    public function validate($value) 
    {
        $value = preg_replace('/[^\d]/', '', $value);

        if((int)$value > 0) {

            $value = strrev((string)$value);

            $sum = '';
            foreach (str_split($value) as $i => $d) {
                $sum .= $i % 2 !== 0 ? $d * 2 : $d;
            }
            $this->is_valid = (array_sum(str_split($sum)) % 10 === 0);
        }

        return $this->is_valid;
    }

}
