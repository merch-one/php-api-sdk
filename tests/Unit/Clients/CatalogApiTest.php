<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients;

use MerchOne\PhpApiSdk\Tests\ApiClientTestCase;
use MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers\CatalogApiResponse;
use MerchOne\PhpApiSdk\Util\Data;

class CatalogApiTest extends ApiClientTestCase
{
    /**
     * @return void
     */
    public function testGetProductsReturnsProducts(): void
    {
        $this->mockGuzzleClient(CatalogApiResponse::GET_PRODUCTS);

        $response = $this->client->catalog()->getProducts();

        $this->assertInstanceOf(Data::class, $response);
        $this->assertEquals(
            CatalogApiResponse::GET_PRODUCTS['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetProductVariantsReturnVariants(): void
    {
        $this->mockGuzzleClient(CatalogApiResponse::GET_PRODUCT_VARIANTS);

        $response = $this->client->catalog()->getProductVariants(1);

        $this->assertEquals(
            CatalogApiResponse::GET_PRODUCT_VARIANTS['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetVariantOptionsReturnsOptions(): void
    {
        $this->mockGuzzleClient(CatalogApiResponse::GET_VARIANT_OPTIONS);

        $response = $this->client->catalog()->getVariantOptions(1);

        $this->assertEquals(
            CatalogApiResponse::GET_VARIANT_OPTIONS['data'],
            $response->toArray()
        );
    }

    /**
     * @return void
     */
    public function testGetVariantCombinationsReturnsCombinations(): void
    {
        $this->mockGuzzleClient(CatalogApiResponse::GET_VARIANT_COMBINATIONS);

        $response = $this->client->catalog()->getVariantCombinations(1);

        $this->assertEquals(
            CatalogApiResponse::GET_VARIANT_COMBINATIONS['data'],
            $response->toArray()
        );
    }
}
