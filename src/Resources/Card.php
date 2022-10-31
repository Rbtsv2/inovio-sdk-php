<?php

namespace Inovio\Api\Resources;


class Card 
{

    /**
    * @var string
    */
    private $firstname;

    /**
    * @var string
    */
    private $lastname;

    /**
    * @var string
    */
    private $number;

    /**
    * @var string
    */
    private $expiryMonth;

    /**
    * @var string
    */
    private $expiryYear;

    /**
    * @var string
    */
    private $cvc;
    
    /**
    * @var string
    */
    private $email;

    /**
    * @var string
    */
    private $billingAddress;

    /**
    * @var string
    */
    private $billingCountry;

    /**
    * @var string
    */
    private $billingCity;

    /**
    * @var string
    */
    private $billingPostcode;

    /**
    * @var string
    */
    private $billingState;

    private function setFirstname(string $firstname) {
        $this->firstname = $firstname;
        return $this->firstname;
    }

    private function setLastname(string $lastname) {
        $this->lastname = $lastname;
        return $this->lastname;
    }

    private function setNumber(string $number) {
        $this->number = $number;
        return $this->number;
    }

    private function setExpiryMonth($expiryMonth) {
        $this->expiryMonth = $expiryMonth;
        return $this->expiryMonth;
    }

    private function setExpiryYear($expiryYear) {
        $this->expiryYear = $expiryYear;
        return $this->expiryYear;
    }

    private function setCvc($cvc) {
        $this->cvc = $cvc;
        return $this->cvc;
    }

    private function setEmail($email) {
        $this->email = $email;
        return $this->email;
    }

    private function setBillingAdress($billingAddress) {
        $this->billingAddress = $billingAddress;
        return $this->billingAddress;
    }

    private function setBillingCountry($billingCountry) {
        $this->$billingCountry = $billingCountry;
        return $this->billingCountry;
    }

    private function setBillingCity($billingCity) {
        $this->billingCity = $billingCity;
        return $this->billingCity;
    }

    private function setBillingPostCode($billingPostcode) {
        $this->billingPostcode = $billingPostcode;
        return $this->billingPostcode;
    }

    private function setbillingSate($billingState) {
        $this->billingState = $billingState;
        return $this->billingState;
    }


    private function getFirstname() {

        return $this->firstname;

    }

    private function getLastname() {

        return $this->lastname;
    
    }

    private function getNumber() {

        return $this->number;

    }

    private function getExpiryMonth() {

        return $this->expiryMonth;

    }

    private function getExpiryYear() {

        return $this->expiryYear;

    }
    private function getCvc() {

        return $this->cvc;

    }

    private function getEmail() {

        return $this->email;

    }

    private function getBillingAdress() {

        return $this->billingAddress;
    
    }

    private function getBillingCountry() {

        return $this->$billingCountry;
    
    }

    private function getBillingCity() {

        return $this->billingCity;
    
    }

    private function getBillingPostCode() {

        return $this->billingPostcode;
    
    }

    private function getbillingSate() {

        return $this->billingState;
        
    }

    
    public function create(array $card_param) {

        return $this->card_params = [
            'firstName'       => $this->setFirstname($card_param['firstName']),
            'lastName'        => $this->setLastname($card_param['firstName']),
            'number'          => $this->setNumber($card_param['firstName']),
            'expiryMonth'     => $this->setExpiryMonth($card_param['firstName']), 
            'expiryYear'      => $this->setExpiryYear($card_param['firstName']), 
            'cvv'             => $this->setCvc($card_param['firstName']), 
            'email'           => $this->setEmail($card_param['firstName']),
            'billingAddress1' => $this->setBillingAdress($card_param['firstName']),
            'billingCountry'  => $this->setBillingCountry($card_param['firstName']), 
            'billingCity'     => $this->setBillingCity($card_param['firstName']), 
            'billingPostcode' => $this->setBillingPostCode($card_param['firstName']), 
            'billingState'    => $this->setbillingSate($card_param['firstName']) 
        ];

        return $this->card_params;

    }

}
