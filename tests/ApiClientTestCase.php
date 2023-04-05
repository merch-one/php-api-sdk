<?php

namespace MerchOne\PhpApiSdk\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use MerchOne\PhpApiSdk\Contracts\Http\HttpClient;
use MerchOne\PhpApiSdk\Http\Client;

abstract class ApiClientTestCase extends TestCase
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
     * @param  mixed  $body
     * @param  array  $headers
     * @param  int  $statusCode
     * @return void
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function mockGuzzleClient($body = '', $headers = [], $statusCode = 200): void
    {
        if (is_array($body)) {
            $body = json_encode($body);
        }

        $mock = new MockHandler([
            new Response($statusCode, $headers, $body),
        ]);
        $handler = HandlerStack::create($mock);

        $options = $this->getObjectProperty($this->client, 'clientOptions');
        $options['handler'] = $handler;

        $guzzleClient = new \GuzzleHttp\Client($options);

        $this->setObjectProperty($this->client, 'httpClient', $guzzleClient);
    }
}
