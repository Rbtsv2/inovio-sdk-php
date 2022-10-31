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
    private $customerId;


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

    private function setCustomerId(string $customerId) {
        $this->customerId = $customerId;
        return $this->customerId;
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

    private function getCustomerId() {

        return $this->customerId;

    }
   
    public function create(array $param_transaction) {

        $card = [
            'amount'           => $this->setAmount($param_transaction['amount']),
            'currency'         => $this->setCurrency($param_transaction['currency']),
            'transactionId'    => $this->setTransactionId($param_transaction['transactionId']), 
        ];

        if (!is_array($param_transaction['card'])) {
            $card['card'] = $this->setCustomerId($param_transaction['card']);
        } else {
            $card['card'] = $this->setCard($param_transaction['card']);
        }

        return $card;

    }

}
