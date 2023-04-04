<?php

namespace MerchOne\PhpSdk\Clients\Beta;

use MerchOne\PhpSdk\Clients\BaseApiClient;
use MerchOne\PhpSdk\Contracts\Clients\CatalogApi;
use MerchOne\PhpSdk\Exceptions\MerchOneApiClientException;
use MerchOne\PhpSdk\Exceptions\MerchOneApiServerException;
use Tightenco\Collect\Support\Enumerable;

class Catalog extends BaseApiClient implements CatalogApi
{
    /**
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getProducts(): Enumerable
    {
        return $this->request('GET', 'products');
    }

    /**
     * @param  int  $productID
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getProductVariants(int $productID): Enumerable
    {
        return $this->request('GET', 'products/' . $productID);
    }

    /**
     * @param  int  $variantID
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getVariantOptions(int $variantID): Enumerable
    {
        return $this->request('GET', 'variants/' . $variantID);
    }

    /**
     * @param  int  $variantID
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getVariantCombinations(int $variantID): Enumerable
    {
        return $this->request('GET', "variants/{$variantID}/combinations");
    }
}
