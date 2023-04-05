<?php

namespace MerchOne\PhpApiSdk\Clients\Beta;

use MerchOne\PhpApiSdk\Clients\BaseApiClient;
use MerchOne\PhpApiSdk\Contracts\Clients\OrdersApi;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiClientException;
use MerchOne\PhpApiSdk\Exceptions\MerchOneApiServerException;
use MerchOne\PhpApiSdk\Util\Data;
use Tightenco\Collect\Support\Enumerable;

class Orders extends BaseApiClient implements OrdersApi
{
    /**
     * @param  int  $page
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function all(int $page = 1): Enumerable
    {
        $response = $this->request('GET', 'orders', [
            'page' => $page,
        ], null);

        return Data::make([
            'orders'     => $response->get('data'),
            'pagination' => $response->get('meta')->get('pagination'),
        ]);
    }

    /**
     * @param  array  $order
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     * @noinspection JsonEncodingApiUsageInspection
     */
    public function create(array $order): Enumerable
    {
        return $this->request('POST', 'orders', ['body' => json_encode($order)]);
    }

    /**
     * @param  string  $orderID
     * @param  bool  $usingExternalID
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function get(string $orderID, bool $usingExternalID = false): Enumerable
    {
        $orderID = $usingExternalID ? "@{$orderID}" : $orderID;

        return $this->request('GET', "orders/{$orderID}");
    }

    /**
     * @param  string  $orderID
     * @return bool
     *
     * @throws MerchOneApiServerException
     */
    public function cancel(string $orderID): bool
    {
        try {
            $this->request('DELETE', "orders/{$orderID}");

            return true;
        } catch (MerchOneApiClientException $e) {
            return false;
        }
    }

    /**
     * @param  array  $order
     * @return Enumerable
     *
     * @throws MerchOneApiClientException
     * @throws MerchOneApiServerException
     */
    public function firstOrCreate(array $order): Enumerable
    {
        try {
            $response = $this->get($order['external_id'], true);
        } catch (MerchOneApiClientException $e) {
            $response = $this->create($order);
        }

        return $response;
    }
}
