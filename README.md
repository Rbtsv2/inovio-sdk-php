
# inovio-sdk-php
inovio-sdk-php for payment Gateway

[InovioPay](https://www.inoviopay.com/) Inovio is payments gateway.

## REQUIREMENT

no dependencies required ! 

## COMPATIBLE

php >=7.4
symfony >=3.4

## Installation

To install, simply add it to your `composer.json` file:

```json

    "repositories": [
        {
        "type": "git",
        "url": "https://github.com/Rbtsv2/inovio-sdk-php.git"
        }
    ],

```

```json

    "require": {
        "rbtsv2/inovio-sdk-php": "dev-main"
    }
    
```

And run composer to update your dependencies:

composer require rbtsv2/inovio-sdk-php

## Start

 * Card and Token payment is supported. In order to create a token payment, customer id (cust_id) and payment id (pmt_id) must be passed.
 * You can get these values from the response of the first purchase using Card payment.
 * This package supports only single item purchase and multiple items will only be supported in the future release.
 * For this package to work, you must pass the API credentials as part of the request body including the Product Id (li_prod_id_1) which can be created
 * in Inovio portal by creating product with type "Variable Price Product"

```php

    /**
    * Initialize the inovio gateway Payments API, username, password, site_Id, merchand_account_id must be passed.
    * @param string username
    * @param string password
    * @param int site_id
    * @param int merchand_account_id
    * @param string format response json or xml (default : json) 
    */
    $this->inovio = new \Inovio\Api\InovioApiGateway('test@exemple.com', 'password', 1, 10, 'json');


    /**
    * check if the service api is available
    * @return object $response
    */   
    $response = $this->inovio->auth();

    /**
    * @param string all 
    * @return array $customer
    */
    $customer = $this->inovio->createCustomer([
        'firstName'       => 'Example',
        'lastName'        => 'Customer',
        'email'           => 'customer@example.com',
        'billingAddress1' => 'Mary',
        'billingCountry'  => 'SG',
        'billingCity'     => 'Singapore',
        'billingPostcode' => '567278',
        'billingState'    => 'Singapore',
    ]);

    /**
    * @param string all
    * @return array $card
    */
    $card = $this->inovio->createCard([
        'number'          => '4242424242424242',
        'expiryMonth'     => '01',
        'expiryYear'      => '2032',
        'cvc'             => '123',
    ]);

    /**
    * Do a purchase transaction on the gateway with customer card
    * @param string amount
    * @param string currency
    * @param array customer
    * @param array card
    * @param int tranasactionId
    * @return object $response
    */
    $response = $this->inovio->AuthorizationAndCapture([
        'amount'        => '50.00',
        'currency'      => 'EUR',
        'customer'      => $customer,
        'card'          => $card,
        'transactionId' => random_int(0, 1000000000),
    ]);

    /**
    * Do a purchase transaction on the gateway with Token ID
    * @param string amount
    * @param string currency
    * @param array customer
    * @param string token
    * @param int tranasactionId
    */
    $response = $this->inovio->AuthorizationAndCapture([
        'amount'        => '50.00',
        'currency'      => 'EUR',
        'customer'      => $customer,
        'token'         => '7BA39EAFDAAD6B3FA8A974098A267258E6D622D9',
        'transactionId' => random_int(0, 1000000000),
    ]);


    if ($response->isSuccessful()) {
        echo "Purchase transaction was successful!\n";
        $sale_id = $response->getTransactionReference();
        echo "Transaction reference = " . $sale_id . "\n";
    }

```

## Basic Usage

The following transactions are provided by this package via the REST API:

* Create a purchase
* Refunding a purchase
* Voiding a purchase
* 3DSecure purchase


## Quirks

Card and Token payment is supported. 
In order to create a token payment, customer id (cust_id) and payment id (pmt_id) must be passed.
You can get these values from the response of the first purchase using Card payment.

This package currently supports only single item purchase and multiple items will only be supported in the future release.

For this package to work, you must pass the API credentials as part of the request body including the Product Id (li_prod_id_1) which can be created
in InovioPay portal by creating product with type "Variable Price Product"

## Test modes

The API has only one endpoint which is https://api.inoviopay.com/payment/pmt_service.cfm

## Authentication

To call InovioPay Payments API, reqUsername, reqPassword, siteId, merchAcctId must be passed.
This can be seen in InovioPay admin portal.

## Unit Testing

Tests are not yet included

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/).



