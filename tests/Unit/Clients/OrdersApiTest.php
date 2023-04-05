<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients;

use MerchOne\PhpApiSdk\Tests\ApiClientTestCase;
use MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers\OrdersApiResponse;

class OrdersApiTest extends ApiClientTestCase
{
    /**
     * @return void
     */
    public function testGetOrdersReturnsOrders(): void
    {
        $this->mockGuzzleClient(OrdersApiResponse::GET_ALL);

        $response = $this->client->orders()->all();

        $this->assertEquals(
            OrdersApiResponse::GET_ALL['data'],
            $response->get('orders')->toArray()
        );

        $this->assertEquals(
            OrdersApiResponse::GET_ALL['meta']['pagination'],
            $response->get('pagination')->toArray()
        );
    }

    /**
     * @return void
     */
    public function testCreateOrderReturnsOrder(): void
    {
        $this->mockGuzzleClient(OrdersApiResponse::GET_ORDER);

        $response = $this->client->orders()->create([]);

        $this->assertEquals(
            OrdersApiResponse::GET_ORDER['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testCancelOrder(): void
    {
        $this->mockGuzzleClient('', [], 404);
        $response = $this->client->orders()->cancel(1);
        $this->assertFalse($response);

        $this->mockGuzzleClient();
        $response = $this->client->orders()->cancel(1);
        $this->assertTrue($response);
    }
}
