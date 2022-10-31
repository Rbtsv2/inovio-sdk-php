<?php

namespace Inovio\Api\Resources;


class Transaction 
{

    /**
    * @var string
    */
    private $amount;

    /**
    * @var string
    */
    private $currency;

    /**
    * @var string
    */
    private $transactionId;

    /**
    * @var array
    */
    private $card;

    /**
    * @var string
    */
    private $tokenId;


    private function setAmount(string $amount) {
        $this->amount = $amount;
        return $this->amount;
    }

    private function setCurrency(string $currency) {
        $this->currency = $currency;
        return $this->currency;
    }

    private function setTransactionId(string $transactionId) {
        $this->transactionId = $transactionId;
        return $this->transactionId;
    }

    private function setCard(array $card) {
        $this->card = $card;
        return $this->card;
    }

    private function setTokenId(string $tokenId) {
        $this->tokenId = $tokenId;
        return $this->tokenId;
    }
  

    private function getAmount() {

        return $this->firstname;

    }

    private function getCurrency() {

        return $this->currency;
    
    }

    private function getTransactionId() {

        return $this->transactionId;

    }

    private function getCard() {

        return $this->card;

    }

    private function getTokenId() {

        return $this->tokenId;

    }
   
    public function create(array $param_transaction) {

        $transaction = [
            'li_value_1'           => $this->setAmount($param_transaction['amount']),
            'request_currency'     => $this->setCurrency($param_transaction['currency']),
            'transactionId'        => $this->setTransactionId($param_transaction['transactionId']), 
        ];


        if (array_key_exists('token', $param_transaction)) {
            $transaction['token_guid'] = $this->setTokenId($param_transaction['token']);
        } else {
            if ( array_key_exists('card', $param_transaction) && is_array($param_transaction['card']) ) {
                $transaction = array_merge($transaction, $param_transaction['card']);
            } else {
                throw new Exception('"card" parameter is missing or does not match the required format of an array');
            }
        } 
          
        $transaction = array_merge($transaction, $param_transaction['customer']);

        return $transaction;

    }

}
