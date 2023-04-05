<h2 align="center">
    PHP SDK for MerchOne API integration
</h2>

This package provide a set of tools that allow developers to easily integrate with MerchOne API.

## Installation
```shell
composer require merch-one/php-api-sdk
```

## Overview

- [Introduction](#introduction)
- [Basic Usage](#basic-usage)
- [Helpers](#helpers)
- [Exceptions](#exceptions)

---

### Introduction
**Client provide 3 different API's to interact with.**
- Catalog API
- Orders API
- Shipping API

**To get the list of available endpoints, please check 
[MerchOne API Documentation](https://docs.merchone.com/api-reference)**

--- 

### Basic Usage

**Create an instance of `MerchOne\PhpApiSdk\Http\Client`**

```php
use MerchOne\PhpApiSdk\Http\Client;

class MyService
 {
    private Client $httpClient;
 
    public function __construct()
    {
        $this->httpClient = new Client();
    }
 
    public function doSomething(): void
     {
        // authenticate client using credentials
        $this->httpClient->auth(
            'your-store-user',
            'your-store-key'
        );
        
        // or authenticate client using base64 encoded credentials
        $this->httpClient->basicAuth(
            base64_encode('your-store-user:your-store-key'),
        );
        
        /* Interact with Catalog API */
        /** @var \MerchOne\PhpApiSdk\Contracts\Clients\CatalogApi $catalogApi */
        $catalogApi = $this->httpClient->catalog();
        
        /* Interact with Orders API */
        /** @var \MerchOne\PhpApiSdk\Contracts\Clients\OrdersApi $ordersApi */
        $ordersApi = $this->httpClient->orders();
        
        /* Interact with Shipping API */
        /** @var \MerchOne\PhpApiSdk\Contracts\Clients\ShippingApi $shippingApi */
        $shippingApi = $this->httpClient->shipping();
        
        // switch API version you interact with
        $this->httpClient->setVersion($version);
        
        // get current API version
        $this->httpClient->getVersion();
    }
}
```
- The `Client` class accepts two parameters:
    - `$version` - API version to interact with. Default value is `beta`. 
      - See [Helpers](#helpers) for available versions.
    - `$clientOptions` - Custom options to use with request.
      - See [Guzzle Documentation](https://docs.guzzlephp.org/en/stable/request-options.html) for available options.
      - The `User-Agent`, `Accept` and `Content-Type` headers, as well as `http_error` properties **CAN NOT** be overwritten !


--- 

### Helpers

```php
use MerchOne\PhpApiSdk\Util\MerchOneApi;

// get the list of all available API versions
MerchOneApi::getVersions();
```
- Class `MerchOne\PhpSdk\Util\OrderStatus` provides a full list of Order statuses.

Check more in [MerchOne API Documentation](https://docs.merchone.com/api-reference/orders#order-status)

--- 

### Exceptions

The package can throw the following exceptions:

| Exception                     | Reason                                              |
|-------------------------------|-----------------------------------------------------|
| *MerchOneApiClientException*  | Request is not correct or validation did not pass.  |
| *MerchOneApiServerException*  | A server error occurred.                            |
| *InvalidApiVersionException*  | An invalid API version was provided to the Client.  |
| *InvalidCredentialsException* | Invalid API credentials was provided to the Client. |
