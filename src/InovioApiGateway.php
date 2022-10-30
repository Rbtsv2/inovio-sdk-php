<?php

namespace Inovio\Api;


/**
 * InovioPay Gateway
 * @date      29/10/2022
 * @author    Charles FOURNIER
 */
class InovioApiGateway
{
    private $username;
    private $password;
    private $site_id;
    private $request_action;
    private $request_response_format;
    private $params;

    /**
     * Version of our client.
     */
    const CLIENT_VERSION = "1.0.0";
    /**
     * Version of the remote API.
     */
    const API_VERSION = 4.5;

    /**
     * Endpoint of the remote API.
     */
    private const ENDPOINT = "https://api.inoviopay.com/payment/pmt_service.cfm";


    /**
    * HTTP Methods
    */
    const HTTP_GET = "GET";
    const HTTP_POST = "POST";
    const HTTP_DELETE = "DELETE";
    const HTTP_PATCH = "PATCH";



    public function __construct()
    {
 
        $this->addVersionString("Inovio/" . self::CLIENT_VERSION);
        $this->addVersionString("PHP/" . phpversion());

    }

    /**
     * @param string $versionString
     *
     * @return array
     */
    public function addVersionString($versionString)
    {
        $this->versionStrings[] = str_replace([" ", "\t", "\n", "\r"], '-', $versionString);
        return $this;
    }

    public function getVersions() {
        return $this->versionStrings;
    }
    /**  
    * @param Array
    * @return $this
    */
    public function initialize(array $params = []) {




        $return = $this->send(
            [
                'reqUsername'              => 'test@example.com',
                'reqPassword'              => 'P5ssw0rd!1',
                'siteId'                   => '64557',
                'merchAcctId'              => '66824',
                'request _action'          => 'TESTAUTH',
                'productId'                => 85299,
                'request_response_format'  => 'json',
                'request_api_version'      => "4.5"  
            ], 
            self::ENDPOINT, 
            'POST'
        );

        var_dump($return);
        die;
        // // set default parameters
        // foreach ($this->getDefaultParameters() as $key => $value) {
        //     if (is_array($value)) {
        //         $this->parameters->set($key, reset($value));
        //     } else {
        //         $this->parameters->set($key, $value);
        //     }
        // }

        // return $this;

    }

    /**
     * Get default parameters
     *
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'reqUsername' => '',
            'reqPassword' => '',
            'siteId'      => '',
            'merchAcctId' => '',
          
        );
    }


    public function send( array $params, string $endpoint, string $method) {

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $endpoint,
            //CURLOPT_USERPWD => $this->login,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/x-www-form-urlencoded",
                'Accept-Charset' => 'iso-8859-1,*,utf-8',
            ]
        ]);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        //print_r($response);
        if ($err) {
        return false;
        }
        return json_decode($response);
    }
  
}