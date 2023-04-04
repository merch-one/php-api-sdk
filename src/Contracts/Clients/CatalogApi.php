<?php

namespace MerchOne\PhpSdk\Contracts\Clients;

use Tightenco\Collect\Support\Enumerable;

interface CatalogApi
{
    /**
     * Returns a list with all available products.
     *
     * @return Enumerable
     */
    public function getProducts(): Enumerable;

    /**
     * Returns a list of all available product's variants.
     *
     * @param  int  $productID
     * @return Enumerable
     */
    public function getProductVariants(int $productID): Enumerable;

    /**
     * Returns a list of all available variant's options.
     *
     * @param  int  $variantID
     * @return Enumerable
     */
    public function getVariantOptions(int $variantID): Enumerable;

    /**
     * Returns a list of all available SKU's variant options.
     *
     * @param  int  $variantID
     * @return Enumerable
     */
    public function getVariantCombinations(int $variantID): Enumerable;
}
