<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Http;

use MerchOne\PhpApiSdk\Contracts\Clients\CatalogApi;
use MerchOne\PhpApiSdk\Contracts\Clients\OrdersApi;
use MerchOne\PhpApiSdk\Contracts\Clients\ShippingApi;
use MerchOne\PhpApiSdk\Contracts\Http\HttpClient;
use MerchOne\PhpApiSdk\Exceptions\InvalidApiVersionException;
use MerchOne\PhpApiSdk\Http\Client;
use MerchOne\PhpApiSdk\Tests\TestCase;
use ReflectionException;

class ClientTest extends TestCase
{
    /**
     * @var HttpClient|Client
     */
    protected HttpClient $client;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->client = new Client();
    }

    /**
     * @return void
     */
    public function testCatalogReturnsCatalogClient(): void
    {
        $catalogClient = $this->client->catalog();
        $this->assertInstanceOf(CatalogApi::class, $catalogClient);
    }

    /**
     * @return void
     */
    public function testOrdersReturnsOrdersClient(): void
    {
        $ordersClient = $this->client->orders();
        $this->assertInstanceOf(OrdersApi::class, $ordersClient);
    }

    /**
     * @return void
     */
    public function testShippingReturnsShippingClient(): void
    {
        $shippingClient = $this->client->shipping();
        $this->assertInstanceOf(ShippingApi::class, $shippingClient);
    }

    /**
     * @return void
     *
     * @throws InvalidApiVersionException
     * @throws ReflectionException
     */
    public function testAuthSetsAuthorizationHeader(): void
    {
        $user = 'user';
        $key = 'key';
        $token = base64_encode("$user:$key");

        $this->client->auth($user, $key);
        $options = $this->getObjectProperty($this->client, 'clientOptions');

        $headers = $options['headers'];

        $this->assertArrayHasKey('Authorization', $headers);
        $this->assertEquals('Basic ' . $token, $headers['Authorization']);
    }

    /**
     * @return void
     *
     * @throws ReflectionException
     */
    public function testMapClientOptionsMapsHeadersCorrectly(): void
    {
        $options = [
            'headers' => [
                'User-Agent' => 'test-user-agent',
                'x-test'     => 'test-header',
            ],
        ];

        $mappedOptions = $this->callObjectMethod($this->client, 'mapClientOptions', [$options]);

        $this->assertArrayHasKey('headers', $mappedOptions);
        $this->assertArrayNotHasKey('User-Agent', $mappedOptions['headers']);
        $this->assertArrayHasKey('X-Test', $mappedOptions['headers']);
    }

    /**
     * @return void
     *
     * @throws InvalidApiVersionException
     * @throws ReflectionException
     */
    public function testDefaultClientOptionsAreImmutable(): void
    {
        $client = new Client('beta', [
            'headers' => [
                'X-Test'       => 'test-header',
                'user-agent'   => 'test-user-agent',
                'accept'       => 'test-accept',
                'content-type' => 'test-content-type',
            ],
            'http_errors' => true,
        ]);

        $options = $this->getObjectProperty($client, 'clientOptions');

        $this->assertArrayHasKey('headers', $options);
        $this->assertArrayHasKey('User-Agent', $options['headers']);
        $this->assertEquals('MerchOne PHP SDK v1.0.2', $options['headers']['User-Agent']);
        $this->assertEquals('application/json', $options['headers']['Accept']);
        $this->assertEquals('application/json', $options['headers']['Content-Type']);
        $this->assertArrayHasKey('http_errors', $options);
        $this->assertFalse($options['http_errors']);
        $this->assertArrayHasKey('X-Test', $options['headers']);
        $this->assertEquals('test-header', $options['headers']['X-Test']);
    }

    /**
     * @return void
     */
    public function testCanSetOnlyAllowedApiVersions(): void
    {
        $this->expectException(InvalidApiVersionException::class);

        new Client('invalid');
    }
}
