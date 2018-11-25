<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BaseController
{

    protected $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function responseSerialized($valid, $code = Response::HTTP_OK) 
    {
        return new Response(
            $this->app['serializer']->serialize(['valid' => $valid, 'code' => $code], $this->app['var.requestFormat']), 
            $code, 
            array(
                "Content-Type" => (new Request)->getMimeType($this->app['var.requestFormat'])
            )
        );
    }

}
