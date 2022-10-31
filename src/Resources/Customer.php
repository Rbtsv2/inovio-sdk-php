<?php

namespace Inovio\Api\Resources;


class Customer 
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

        return $customer_params = [
            'cust_fname'         => $this->setFirstname($card_param['firstName']),
            'cust_lname'         => $this->setLastname($card_param['lastName']),
            'cust_email'         => $this->setEmail($card_param['email']),
            'bill_addr'          => $this->setBillingAdress($card_param['billingAddress1']),
            'bill_addr_country'  => $this->setBillingCountry($card_param['billingCountry']), 
            'bill_addr_city'     => $this->setBillingCity($card_param['billingCity']), 
            'bill_addr_zip'      => $this->setBillingPostCode($card_param['billingPostcode']), 
            'bill_addr_state'    => $this->setbillingSate($card_param['billingState']) 
        ];
    }

}
