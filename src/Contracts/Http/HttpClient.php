<?php

namespace MerchOne\PhpApiSdk\Contracts\Http;

use MerchOne\PhpApiSdk\Contracts\Clients\CatalogApi;
use MerchOne\PhpApiSdk\Contracts\Clients\OrdersApi;
use MerchOne\PhpApiSdk\Contracts\Clients\ShippingApi;

interface HttpClient
{
    /**
     * @param  string  $version
     * @param  array  $clientOptions
     */
    public function __construct(string $version, array $clientOptions = []);

    /**
     * @param  string  $user
     * @param  string  $key
     * @return HttpClient
     */
    public function auth(string $user, string $key): HttpClient;

    /**
     * @param  string  $token
     * @return HttpClient
     */
    public function basicAuth(string $token): HttpClient;

    /**
     * @param  string  $version
     * @return HttpClient
     */
    public function setVersion(string $version): HttpClient;

    /**
     * @return string
     */
    public function getVersion(): string;

    /**
     * @return CatalogApi
     */
    public function catalog(): CatalogApi;

    /**
     * @return OrdersApi
     */
    public function orders(): OrdersApi;

    /**
     * @return ShippingApi
     */
    public function shipping(): ShippingApi;
}
