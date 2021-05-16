<?php

namespace Genzouw\Wpapi;

class Wp extends \Rolenweb\Wpapi\Wp
{
    private $url;
    private $login;
    private $pass;

    public function __construct($url, $login, $pass)
    {
        parent::__construct($url, $login, $pass);

        $this->url = $url;
        $this->login = $login;
        $this->pass = $pass;
    }

    public function xmlRpc($params, $action)
    {
        // initialize curl
        $ch = curl_init();
        // set url ie path to xmlrpc.php
        curl_setopt($ch, CURLOPT_URL, $this->url . '/xmlrpc.php');
        // xmlrpc only supports post requests
        curl_setopt($ch, CURLOPT_POST, true);
        // return transfear
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // setup post data

        $encodedParams = xmlrpc_encode_request($action, $params, array(
            'escaping' => 'cdata',
        ));

        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedParams);
        // execute the request
        $response = curl_exec($ch);
        // shutdown curl
        curl_close($ch);

        return $response;
    }

    public function getPosts($params)
    {
        $response = $this->xmlRpc(array(1, $this->login, $this->pass, $params), 'wp.getPosts');

        return $this->convertResponseArray($response);
    }
}
