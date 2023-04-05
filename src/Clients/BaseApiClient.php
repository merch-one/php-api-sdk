<?php

namespace MerchOne\PhpApiSdk\Clients;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response as PsrResponse;
use MerchOne\PhpApiSdk\Exceptions\InvalidCredentialsException;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiClientException;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiServerException;
use MerchOne\PhpApiSdk\Http\Response;
use MerchOne\PhpApiSdk\Util\Data;
use Tightenco\Collect\Support\Collection;
use Tightenco\Collect\Support\Enumerable;

abstract class BaseApiClient
{
    /**
     * @var GuzzleClient
     */
    protected GuzzleClient $httpClient;

    /**
     * @param  GuzzleClient  $httpClient
     */
    public function __construct(GuzzleClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param  string  $method
     * @param  string  $path
     * @param  array  $options
     * @param  string|null  $responseKey
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    protected function request(
        string $method,
        string $path,
        array $options = [],
        ?string $responseKey = 'data'
    ): Enumerable {
        try {
            $response = $this->handleResponse(
                $this->httpClient->request($method, $path, $options)
            );

            return new Data($response->json($responseKey));
        } catch (GuzzleException $exception) {
            throw new MerchOneApiClientException($exception->getMessage());
        }
    }

    /**
     * @param  PsrResponse  $psrResponse
     * @return Response
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    protected function handleResponse(PsrResponse $psrResponse): Response
    {
        return (new Response($psrResponse))
            ->onError(fn (Response $response) => $this->handleError($response));
    }

    /**
     * @param  Response  $response
     * @return void
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    protected function handleError(Response $response): void
    {
        if ($response->serverError()) {
            throw new MerchOneApiServerException($response->json('message'));
        }

        if ($response->unauthorized()) {
            throw new InvalidCredentialsException('Invalid API credentials.');
        }

        if ($response->clientError()) {
            $errors = $response->json('errors');

            if ($errors) {
                throw new MerchOneApiClientException(
                    (new Collection($errors))->collapse()->implode('|')
                );
            }

            throw new MerchOneApiClientException($response->json('message'));
        }
    }
}
