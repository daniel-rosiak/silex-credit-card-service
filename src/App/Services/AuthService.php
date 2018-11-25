<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class AuthService
{

    private $apiKey;

    /**
     * AuthService constructor.
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param Request $request
     */
    public function auth(Request $request)
    {

        $auth = false;
        $data = [];

        //get auth token
        if( $request->request->has('auth') ) {
            $auth = $request->request->get('auth');
            // $data = array_diff($request->request->all(), $auth);

        } else if( $request->query->has('auth') ) {
            $auth = $request->query->get('auth');
            // $data = array_diff($request->request->all(), $auth);
        }

        if(!$auth) {
            throw new AccessDeniedHttpException();
        }

        if(!is_array($auth) || !isset($auth['signature']) || !isset($auth['timestamp'])) {
            throw new AccessDeniedHttpException();
        }

        if($this->createSignature($data, $auth['timestamp']) != $auth['signature']) {
            throw new AccessDeniedHttpException();
        }

    }

    /**
     * @param array $data
     * @param null $timestamp
     * @return string
     */
    public function createSignature($data = [], $timestamp = NULL)
    {
        if($timestamp === NULL) {
            $timestamp = time();
        }

        return sha1($this->apiKey . $timestamp . json_encode($data));

    }

}
