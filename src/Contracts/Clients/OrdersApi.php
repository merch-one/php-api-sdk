<?php

namespace MerchOne\PhpApiSdk\Contracts\Clients;

use Tightenco\Collect\Support\Enumerable;

interface OrdersApi
{
    /**
     * Returns a list of all the orders.
     *
     * @param  int  $page
     * @return Enumerable
     */
    public function all(int $page): Enumerable;

    /**
     * Creates an order and returns it.
     *
     * @param  array  $order
     * @return Enumerable
     */
    public function create(array $order): Enumerable;

    /**
     * Returns retrieves information about the specific order.
     *
     * @param  string  $orderID
     * @param  bool  $usingExternalID
     * @return Enumerable
     */
    public function get(string $orderID, bool $usingExternalID): Enumerable;

    /**
     * Cancels a specific order.
     *
     * @param  string  $orderID
     * @return bool
     */
    public function cancel(string $orderID): bool;

    /**
     * Returns an order if it exists or create a new one.
     *
     * @param  array  $order
     * @return Enumerable
     */
    public function firstOrCreate(array $order): Enumerable;
}
