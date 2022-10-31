<?php

namespace Inovio\Api\Resources;


class Card 
{

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

    private function expiryFormat(string $expiryMonth, string $expiryYear) {
        return $expiryMonth . '/' . $expiryYear;
    }
    
    public function create(array $card_param) {

        $expiry = $this->expiryFormat($this->setExpiryMonth($card_param['expiryMonth']), $this->setExpiryYear($card_param['expiryYear'])); 

        return $this->card_params = [
            'pmt_numb'           => $this->setNumber($card_param['number']),
            'pmt_expiry'         => $expiry, 
            'pmt_key'            => $this->setCvc($card_param['cvc']), 
        ];

        return $this->card_params;

    }

}
