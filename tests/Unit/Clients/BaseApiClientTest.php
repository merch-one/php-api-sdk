<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients;

use MerchOne\PhpApiSdk\Exceptions\InvalidCredentialsException;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiClientException;
use MerchOne\PhpApiSdk\Tests\ApiClientTestCase;

class BaseApiClientTest extends ApiClientTestCase
{
    /**
     * @return void
     */
    public function testRightExceptionThrownWhenUnauthorized(): void
    {
        $this->expectException(InvalidCredentialsException::class);

        $this->mockGuzzleClient([], [], 401);

        $this->client->orders()->all();
    }

    /**
     * @return void
     */
    public function testRightExceptionThrownWhenValidationError(): void
    {
        $this->mockGuzzleClient([
            'message' => 'Bad Request',
            'errors'  => [
                'email' => [
                    'The email field is required.',
                ],
                'name' => [
                    'The name field is required.',
                ],
            ],
        ], [], 422);

        $this->expectException(MerchOneApiClientException::class);
        $this->expectExceptionMessage('The email field is required.|The name field is required.');

        $this->client->orders()->create([]);
    }

    /**
     * @return void
     */
    public function testRightExceptionThrownWhenBadRequest(): void
    {
        $this->mockGuzzleClient(['message' => 'Bad Request'], [], 400);

        $this->expectException(MerchOneApiClientException::class);
        $this->expectExceptionMessage('Bad Request');

        $this->client->orders()->create([]);
    }
}
