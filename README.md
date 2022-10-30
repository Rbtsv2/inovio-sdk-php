
# inovio-sdk-php
inovio-sdk-php for payment Gateway

[InovioPay](https://www.inoviopay.com/) Inovio is payments gateway.

## Installation

To install, simply add it to your `composer.json` file:

```json
{
    "type": "git",
    "url": "https://github.com/Rbtsv2/inovio-sdk-php.git"
}
```

```json
{
   "repositories": [
    {
      "type": "git",
      "url": "https://github.com/Rbtsv2/inovio-sdk-php.git"
    }
  ],
}
```

And run composer to update your dependencies:

composer require rbtsv2/inovio-sdk-php

## Start

```php
    /**
    * To call InovioPay Payments API, reqUsername, reqPassword, siteId, merchAcctId must be passed.
    * This can be seen in InovioPay admin portal.
    * Initialize the gateway
    */
    $gateway = new InovioGateway();
    $gateway->initialize([
        'reqUsername'              => 'test@example.com',
        'reqPassword'              => 'P5ssw0rd!1',
        'siteId'                   => '64557',
        'merchAcctId'              => '66824',
        'request _action'          => 'TESTAUTH',
        'productId'                => 85299,
        'request_response_format'  => 'json',
        'request_api_version'      => "4.5"
    ]);

    // Create a credit card object
    $cardObject = $gateway->createCardObject([
        'firstName'       => 'Example',
        'lastName'        => 'Customer',
        'number'          => '4242424242424242',
        'expiryMonth'     => '01',
        'expiryYear'      => '2032',
        'cvv'             => '123',
        'email'           => 'customer@example.com',
        'billingAddress1' => 'Mary',
        'billingCountry'  => 'SG',
        'billingCity'     => 'Singapore',
        'billingPostcode' => '567278',
        'billingState'    => 'Singapore',
    ]);

    // Do a purchase transaction on the gateway
    $transaction = $gateway->purchase([
        'amount'      => '50.00',
        'currency'    => 'EUR',
        'card'        => $cardObject,
        'transactionId' => random_int(0, 1000000000),
    ]);


    $response = $transaction->send();
    if ($response->isSuccessful()) {
        echo "Purchase transaction was successful!\n";
        $sale_id = $response->getTransactionReference();
        echo "Transaction reference = " . $sale_id . "\n";
    }

```
 * Card and Token payment is supported. In order to create a token payment, customer id (cust_id) and payment id (pmt_id) must be passed.
 * You can get these values from the response of the first purchase using Card payment.
 * This package supports only single item purchase and multiple items will only be supported in the future release.
 * For this package to work, you must pass the API credentials as part of the request body including the Product Id (li_prod_id_1) which can be created
 * in Inovio portal by creating product with type "Variable Price Product"
 

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



