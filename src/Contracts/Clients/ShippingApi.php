<?php

namespace MerchOne\PhpApiSdk\Contracts\Clients;

use Tightenco\Collect\Support\Enumerable;

interface ShippingApi
{
    /**
     * Returns a list of calculated shipping rates
     * for the given items and shipping info.
     *
     * @param  int  $countryID
     * @param  array  $items
     * @return Enumerable
     */
    public function getRates(int $countryID, array $items): Enumerable;

    /**
     * Returns a list of all available shipping types.
     *
     * @return Enumerable
     */
    public function getTypes(): Enumerable;

    /**
     * Returns a list of all available shipping methods.
     *
     * @return Enumerable
     */
    public function getMethods(): Enumerable;

    /**
     * Returns a list of countries with IDs and their corresponding codes.
     *
     * @return Enumerable
     */
    public function getCountries(): Enumerable;

    /**
     * Returns a list of regions within a specific country by providing its ID.
     *
     * @param  int  $countryID
     * @return Enumerable
     */
    public function getRegions(int $countryID): Enumerable;
}
