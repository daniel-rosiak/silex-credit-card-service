<?php

namespace App\Services;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ValidationService
{
    /**
     * @param $parameters
     * @param $form
     */
    public function validate($parameters, $form) {

        $errors = [];
        foreach($form as $key => $item) {

            if(isset($item['required']) && $item['required'] && (!isset($parameters[$key]) || ( isset($parameters[$key]) && empty($parameters[$key]) ) ) ) {
                $errors[$key]['required'] = true;
            }

            if(isset($parameters[$key]) && isset($item['validator']) && class_exists($item['validator']) ) {
                if(!(new $item['validator'])->validate($parameters[$key], isset($item['options']) ? $item['options'] : []) ) {
                    $errors[$key]['validator'] = true;
                }
            }
        }

        if(! empty($errors)) {
            throw new BadRequestHttpException();
        }

    }

}
