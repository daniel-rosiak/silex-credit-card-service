<?php

namespace App\Controllers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use App\Validators\CreditCardValidator;
use App\Validators\DateValidator;
use App\Validators\Cvv2Validator;
use App\Validators\EmailValidator;
use App\Validators\PhoneValidator;


class PaymentController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     *
     * url: /payment/credit-card
     */
    public function creditCard(Request $request)
    {
        try {
            
            $form = array(
                'number' => ['required' => true, 'validator' => CreditCardValidator::class],
                'expirationDate' => ['required' => true, 'validator' => DateValidator::class, 'options' => ['min_date' => new \DateTime()]],
                'cvv2' => ['required' => true, 'validator' => Cvv2Validator::class],
                'email' => ['required' => true, 'validator' => EmailValidator::class]
            );

            $this->app['auth.service']->auth($request);

            $this->app['validation.service']->validate($request->request->all(), $form);

            return $this->responseSerialized(true);

        }
        catch (AccessDeniedHttpException $e) {

            return $this->responseSerialized(false, Response::HTTP_FORBIDDEN);

        }
        catch (BadRequestHttpException $e) {

            return $this->responseSerialized(false, Response::HTTP_BAD_REQUEST);

        }
    }

    /**
     * @param Request $request
     * @return Response
     *
     * url: /payment/mobile
     */
    public function mobile(Request $request)
    {
        try {

            $form = array(
                'phone' => ['required' => true, 'validator' => PhoneValidator::class],
            );


            $this->app['auth.service']->auth($request);

            $this->app['validation.service']->validate($request->request->all(), $form);

            return $this->responseSerialized(true);

        }
        catch (AccessDeniedHttpException $e) {

            return $this->responseSerialized(false, Response::HTTP_FORBIDDEN);

        }
        catch (BadRequestHttpException $e) {

            return $this->responseSerialized(false, Response::HTTP_BAD_REQUEST);

        }
    }

}
