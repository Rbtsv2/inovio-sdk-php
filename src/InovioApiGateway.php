<?php

namespace Inovio\Api;
use Inovio\Api\Resources\Card;
use Inovio\Api\Resources\Transaction;
/**
 * InovioPay Gateway
 * @date      29/10/2022
 * @author    Charles FOURNIER
 */
class InovioApiGateway
{

    /**
     * Version of our client.
     */
    private const CLIENT_VERSION = "1.0.0";
    /**
     * Version of the remote API.
     */
    private const API_VERSION = 4.5;

    /**
     * Base Endpoint of the remote API.
     */
    private const API_ENDPOINT = "https://api.inoviopay.com";

    /**
     * Payment Endpoint of the remote API.
     */
    private const API_PAYMENT = "payment/pmt_service.cfm";

    /**
     * Ask token for do a payment the token is unique and for one-time use...
     */
    private const API_ASK_TOKEN = "payment/token_service.cfm";

    /**
    * HTTP Methods
    */
    private const HTTP_GET = "GET";
    private const HTTP_POST = "POST";
    private const HTTP_DELETE = "DELETE";
    private const HTTP_PATCH = "PATCH";

    /**
    * Methods request 
    */
    private const REQUEST_ACTION_AUTH            = "CCAUTHORIZE"; //  Ask just an Authorization request 
    private const REQUEST_ACTION_AUTH_CAPTURE    = "CCAUTHCA"; // Authorization and Capture requests. 
    private const REQUEST_ACTION_TEST            = "TESTGW"; // Use request action, “TESTGW”, to check if Payment Service is available to process requests.

    /**
    * Response format
    */
    private const REQUEST_FORMAT_RESPONSE_XML = "xml";
    private const REQUEST_FORMAT_RESPONSE_JSON = "json";

    /**
    * @var string
    */
    private $api_endpoint;

    /**
    * @var string
    */
    private $username;

    /**
    * @var string
    */
    private $password;

    /**
    * @var int
    */
    private $site_id;

    /**
    * @var int
    */
    private $merch_acct_id;

    /**
    * @var string
    */
    private $response_format;

    /**
    * @var string
    */
    private $request_action;

    /**
    * @var object
    */
    private $card;

    /**
    * @var object
    */
    private $transaction;

    /**
    * Params for client connexion.
    * @var array
    */
    private $params;

    public function __construct(string $username, string $password, int $site_id, int $merch_acct_id, string $response_format = null)
    {
 
        $this->addVersion("VERSION BUNDLE INOVIO/" . self::CLIENT_VERSION);
        $this->addVersion("VERSION API INOVIO/" . self::CLIENT_VERSION);
        $this->addVersion("VERSION PHP/" . phpversion());

        $this->setUsername($username);
        $this->setPassword($password);
        $this->setSiteId($site_id);
        $this->setMerchantAccId($merch_acct_id);
        $this->setRequestResponseFormat($response_format);

        $this->initializeResources();

    }

    public function initializeResources() {

        $this->card        = new Card();
        $this->transaction = new Transaction();
    }


    /**
     * @param string $param_url
     * @return string
     */
    public function getApiEndpoint()
    {
        return $this->api_endpoint;
    }

    /**
     * 
     * @return array
     */
    public function getVersions() {
        return $this->versionStrings;
    }

    public function auth(array $post_params = []) {

        return $this->initialize($post_params, self::API_PAYMENT, 'POST');
    }

    public function AuthorizationAndCapture(array $client_params = []) {

        $this->setRequestAction(self::REQUEST_ACTION_AUTH_CAPTURE);

        $post_params = $this->createTransaction($client_params);
    
        return $this->initialize($post_params, self::API_PAYMENT, 'POST');

    }

    public function refund(array $post_params = []) {

        return $this->initialize($post_params, self::API_PAYMENT, 'POST');

    }

    public function createCard(array $card_param) {

        return $this->card->create($card_param);

    }

    private function createTransaction(array $param_transaction) {

        return $this->transaction->create($param_transaction);
   
    }

    private function getRequestResponseFormat() {
        return $this->response_format;
    }

    private function getPassword() {
        return $this->password;
    }

    private function getUsername() {
        return $this->username;
    }

    private function getSiteId() {
        return $this->site_id;
    }

    private function getRequestAction() {
        return $this->request_action; 
    }

    private function getMerchantAccId() {
        return $this->merch_acct_id;
    }

    private function setPassword($password) {
        $this->password = $password;
        return $this->password;
    }

    private function setUsername($username) {
        $this->username = $username;
        return $this->username;
    }

    private function setSiteId($site_id) {
        $this->site_id = $site_id;
        return $this->site_id;
    }

    private function setMerchantAccId($merch_acct_id) {
        $this->merch_acct_id = $merch_acct_id;
        return $this->merch_acct_id;
    }

    private function setRequestAction($request_action) {
        $this->request_action = $request_action;
        return $this->request_action;
    }

    private function setRequestResponseFormat($format) {
        $this->response_format = $format;
        return $this->response_format;
    }
  
    private function getDefaultParameters() {

        return $this->params = [
            'req_username'              =>  $this->getUsername(),
            'req_password'              =>  $this->getPassword(),
            'site_id'                   =>  $this->getSiteId(),
            'merch_acct_id'             =>  $this->getMerchantAccId(),
            'request_action'            =>  $this->getRequestAction() ? $this->getRequestAction() : self::REQUEST_ACTION_TEST,
            'request_response_format'   =>  $this->getRequestResponseFormat() ? $this->getRequestResponseFormat() : self::REQUEST_FORMAT_RESPONSE_JSON,
            'request_api_version'       =>  self::API_VERSION 
        ];
    }

    /**
     * 
     * @param string $param_url
     * @return string
     */
    private function setApiEndpoint($param_url)
    {
        $this->api_endpoint = self::API_ENDPOINT . "/" . $param_url;
        return $this->api_endpoint;
    }

    /**
     * 
     * @param string $versionString
     * @return array
     */
    private function addVersion($versionString):void
    {
        $this->versionStrings[] = str_replace([" ", "\t", "\n", "\r"], '-', $versionString);
    }


    /**  
    * @param Array $params 
    * @param string $param_url 
    * @param string $methode 
    * @return object
    */
    private function initialize(array $client_params = [], $param_url, $methode ) {

        $initial_params = $this->getDefaultParameters();
        $post_params = array_merge($initial_params, $client_params);
        $endpoint = $this->setApiEndpoint($param_url);
        return $this->send($post_params, $endpoint, $methode);
    }

    /**  
    * @param Array $params
    * @param string $endpoint 
    * @param string $method 
    * @return object $response
    */
    private function send( array $params, string $endpoint, string $method) {

        var_dump($params);
        die;
        $ch = curl_init();
        // CURLOPT_SSLVERSION =>  6; 
        // CURL_SSLVERSION_TLSv1_2 for libcurl < 7.35

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


        if ($err) {
        return false;
        }
       
        if ( $this->getRequestResponseFormat() === self::REQUEST_FORMAT_RESPONSE_JSON)
            return json_decode($response);
        
        if ( $this->getRequestResponseFormat() === self::REQUEST_FORMAT_RESPONSE_XML)
            return $response;


    }



  
}