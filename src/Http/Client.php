<?php

namespace MerchOne\PhpSdk\Http;

use GuzzleHttp\Client as GuzzleClient;
use MerchOne\PhpSdk\Clients\BaseApiClient;
use MerchOne\PhpSdk\Contracts\Clients\CatalogApi;
use MerchOne\PhpSdk\Contracts\Clients\OrdersApi;
use MerchOne\PhpSdk\Contracts\Clients\ShippingApi;
use MerchOne\PhpSdk\Contracts\Http\HttpClient as HttpClientContract;
use MerchOne\PhpSdk\Exceptions\InvalidApiVersionException;
use MerchOne\PhpSdk\Util\MerchOneApi;
use MerchOne\PhpSdk\Util\Str;

class Client implements HttpClientContract
{
    /**
     * GuzzleHttp client instance.
     *
     * @var GuzzleClient
     */
    protected GuzzleClient $httpClient;

    /**
     * MerchOne API version to use.
     *
     * @var string
     */
    protected string $apiVersion;

    /**
     * @var string|null
     */
    protected ?string $baseUrl = null;

    /**
     * List of default request headers.
     *
     * @var array|string[]
     */
    protected array $headers = [
        'User-Agent'   => 'MerchOne PHP SDK v0.0.1',
        'Accept'       => 'application/json',
        'Content-Type' => 'application/json',
    ];

    /**
     * @param  string  $version
     *
     * @throws InvalidApiVersionException
     */
    public function __construct(string $version)
    {
        $this->apiVersion = $version;

        $this->buildClient();
    }

    /**
     * @param  string  $user
     * @param  string  $key
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function auth(string $user, string $key): Client
    {
        $this->basicAuth(
            base64_encode("{$user}:{$key}")
        );

        return $this;
    }

    /**
     * @param  string  $token
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function basicAuth(string $token): Client
    {
        $this->headers['Authorization'] = 'Basic ' . $token;

        $this->buildClient();

        return $this;
    }

    /**
     * @param  string  $baseUrl
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function setBaseUrl(string $baseUrl): Client
    {
        $this->baseUrl = $baseUrl;

        $this->buildClient();

        return $this;
    }

    /**
     * @param  string  $version
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function setVersion(string $version): Client
    {
        $this->apiVersion = $version;

        $this->buildClient();

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * Client for interacting with Catalog API endpoints.
     *
     * @see https://docs.merchone.com/api-reference/catalog
     *
     * @return BaseApiClient|CatalogApi
     */
    public function catalog(): CatalogApi
    {
        return $this->initApiClient('Catalog');
    }

    /**
     * Client for interacting with Orders API.
     *
     * @see https://docs.merchone.com/api-reference/orders
     *
     * @return BaseApiClient|OrdersApi
     */
    public function orders(): OrdersApi
    {
        return $this->initApiClient('Orders');
    }

    /**
     * Client for interacting with Shipping API.
     *
     * @see https://docs.merchone.com/api-reference/shipping
     *
     * @return BaseApiClient|ShippingApi
     */
    public function shipping(): ShippingApi
    {
        return $this->initApiClient('Shipping');
    }

    /**
     * @param  string  $name
     * @return BaseApiClient
     */
    private function initApiClient(string $name): BaseApiClient
    {
        $name = Str::title($name);
        $version = Str::title($this->apiVersion);
        $client = "MerchOne\\PhpSdk\\Clients\\{$version}\\{$name}";

        return new $client($this->httpClient);
    }

    /**
     * @return void
     *
     * @throws InvalidApiVersionException
     */
    private function buildClient(): void
    {
        $this->httpClient = new GuzzleClient([
            'base_uri'    => MerchOneApi::getBaseUrl($this->apiVersion, $this->baseUrl),
            'headers'     => $this->headers,
            'http_errors' => false,
        ]);
    }
}
