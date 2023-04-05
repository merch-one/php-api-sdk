<?php

namespace MerchOne\PhpApiSdk\Clients\Beta;

use MerchOne\PhpApiSdk\Clients\BaseApiClient;
use MerchOne\PhpApiSdk\Contracts\Clients\ShippingApi;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiClientException;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiServerException;
use Tightenco\Collect\Support\Enumerable;

class Shipping extends BaseApiClient implements ShippingApi
{
    /**
     * @param  int  $countryID
     * @param  array  $items
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function getRates(int $countryID, array $items): Enumerable
    {
        $body = [
            'shipping' => [
                'country' => $countryID,
            ],
            'items' => $items,
        ];

        return $this->request('POST', 'shipping/rates', ['body' => json_encode($body)]);
    }

    /**
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getTypes(): Enumerable
    {
        return $this->request('GET', 'shipping/types');
    }

    /**
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getMethods(): Enumerable
    {
        return $this->request('GET', 'shipping/methods');
    }

    /**
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getCountries(): Enumerable
    {
        return $this->request('GET', 'countries');
    }

    /**
     * @param  int  $countryID
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function getRegions(int $countryID): Enumerable
    {
        return $this->request('GET', 'regions/' . $countryID);
    }
}
