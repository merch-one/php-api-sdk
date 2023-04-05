<?php

namespace MerchOne\PhpApiSdk\Http;

use GuzzleHttp\Client as GuzzleClient;
use MerchOne\PhpApiSdk\Clients\BaseApiClient;
use MerchOne\PhpApiSdk\Contracts\Clients\CatalogApi;
use MerchOne\PhpApiSdk\Contracts\Clients\OrdersApi;
use MerchOne\PhpApiSdk\Contracts\Clients\ShippingApi;
use MerchOne\PhpApiSdk\Contracts\Http\HttpClient;
use MerchOne\PhpApiSdk\Exceptions\InvalidApiVersionException;
use MerchOne\PhpApiSdk\Util\MerchOneApi;
use MerchOne\PhpApiSdk\Util\Str;
use Tightenco\Collect\Support\Collection;

class Client implements HttpClient
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
    protected ?string $host = null;

    /**
     * List of default GuzzleClient options.
     *
     * @var array
     */
    protected array $clientOptions = [
        'headers' => [
            'User-Agent'   => 'MerchOne PHP SDK v1.0.2',
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json',
        ],
        'http_errors' => false,
    ];

    /**
     * @param  string  $version
     * @param  array  $clientOptions
     *
     * @throws InvalidApiVersionException
     */
    public function __construct(
        string $version = MerchOneApi::VERSION_BETA,
        array $clientOptions = []
    ) {
        $this->apiVersion = $version;
        $this->setClientOptions($clientOptions);

        $this->buildClient();
    }

    /**
     * @param  string  $user
     * @param  string  $key
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function auth(string $user, string $key): HttpClient
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
    public function basicAuth(string $token): HttpClient
    {
        $this->clientOptions['headers']['Authorization'] = 'Basic ' . $token;

        $this->buildClient();

        return $this;
    }

    /**
     * @param  string  $host
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function setHost(string $host): HttpClient
    {
        $this->host = $host;

        $this->buildClient();

        return $this;
    }

    /**
     * @param  string  $version
     * @return $this
     *
     * @throws InvalidApiVersionException
     */
    public function setVersion(string $version): HttpClient
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
        $client = "MerchOne\\PhpApiSdk\\Clients\\{$version}\\{$name}";

        return new $client($this->httpClient);
    }

    /**
     * @param  array  $options
     * @return void
     */
    private function setClientOptions(array $options): void
    {
        $this->clientOptions = (new Collection($this->clientOptions))
            ->mergeRecursive(
                $this->mapClientOptions($options)
            )->toArray();
    }

    /**
     * @param  array  $options
     * @return array
     */
    private function mapClientOptions(array $options): array
    {
        return (new Collection($options))->map(
            function ($value, $key) {
                if ($key === 'headers' && is_array($value)) {
                    return (new Collection($value))
                        ->mapWithKeys(
                            static fn ($value, $key) => [Str::title($key) => $value]
                        )->filter(
                            fn ($value, $key) => ! array_key_exists($key, $this->clientOptions['headers'])
                        )->toArray();
                }

                if (array_key_exists($key, $this->clientOptions)) {
                    return null;
                }

                return $value;
            }
        )->filter(static fn ($value) => ! empty($value))->toArray();
    }

    /**
     * @return void
     *
     * @throws InvalidApiVersionException
     */
    private function buildClient(): void
    {
        $this->clientOptions['base_uri'] = MerchOneApi::getBaseUrl(
            $this->apiVersion,
            $this->host
        );

        $this->httpClient = new GuzzleClient($this->clientOptions);
    }
}
