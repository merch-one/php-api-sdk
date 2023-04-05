<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients;

use MerchOne\PhpApiSdk\Tests\ApiClientTestCase;
use MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers\ShippingApiResponse;

class ShippingApiTest extends ApiClientTestCase
{
    /**
     * @return void
     */
    public function testGetShippingRatesReturnsShippingRates(): void
    {
        $this->mockGuzzleClient(ShippingApiResponse::GET_SHIPPING_RATES);

        $response = $this->client->shipping()->getRates(1, []);

        $this->assertEquals(
            ShippingApiResponse::GET_SHIPPING_RATES['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetShippingTypesReturnsShippingTypes(): void
    {
        $this->mockGuzzleClient(ShippingApiResponse::GET_SHIPPING_TYPES);

        $response = $this->client->shipping()->getTypes();

        $this->assertEquals(
            ShippingApiResponse::GET_SHIPPING_TYPES['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetShippingMethodsReturnsShippingMethods(): void
    {
        $this->mockGuzzleClient(ShippingApiResponse::GET_SHIPPING_METHODS);

        $response = $this->client->shipping()->getMethods();

        $this->assertEquals(
            ShippingApiResponse::GET_SHIPPING_METHODS['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetCountriesReturnsCountries(): void
    {
        $this->mockGuzzleClient(ShippingApiResponse::GET_COUNTRIES);

        $response = $this->client->shipping()->getCountries();

        $this->assertEquals(
            ShippingApiResponse::GET_COUNTRIES['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetRegionsReturnsRegions(): void
    {
        $this->mockGuzzleClient(ShippingApiResponse::GET_REGIONS);

        $response = $this->client->shipping()->getRegions(1);

        $this->assertEquals(
            ShippingApiResponse::GET_REGIONS['data'],
            $response->toArray()
        );
    }
}
