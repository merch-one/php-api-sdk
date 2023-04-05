<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers;

final class OrdersApiResponse
{
    public const GET_ALL = [
        'data' => [
            [
                'id'              => 'PPO21694395T',
                'external_id'     => '',
                'is_test'         => true,
                'shipping_method' => [
                    'code' => 'DHL',
                    'name' => 'DHL',
                ],
                'status'       => 'DRAFT',
                'status_label' => 'Draft',
                'created_at'   => '2023-01-01T00:00:00.000000Z',
                'updated_at'   => '2023-01-01T00:00:00.000000Z',
                'shipments'    => [
                    [
                        'shipping_method' => [
                            'code' => 'DHL',
                            'name' => 'DHL',
                        ],
                        'tracking_number' => 'tracking-number-id',
                        'tracking_url'    => 'https://tracking.com?track=tracking-number-id',
                        'shipped_at'      => '2023-01-01T00:00:00.000000Z',
                        'items'           => [
                            [
                                'item_id'          => 1,
                                'item_external_id' => '1',
                                'quantity'         => 1,
                            ],
                        ],
                    ],
                ],
                'items' => [
                    [
                        'id'            => 3399,
                        'external_id'   => null,
                        'variant_id'    => 3,
                        'name'          => '40x30 cm',
                        'quantity'      => 1,
                        'price'         => 24.92,
                        'price_details' => [
                            'currency'   => 'EUR',
                            'formatted'  => '24.92 €',
                            'in_subunit' => '2492',
                        ],
                        'file'    => 'https://dummyimage.com/4000x3000/fff/000&text=api.picanova.com',
                        'options' => [
                            [
                                'id'    => 1,
                                'name'  => 'Canvas border',
                                'value' => [
                                    'id'   => 3,
                                    'name' => 'Stretched',
                                ],
                            ],
                        ],
                    ],
                ],
                'totals' => [
                    'subtotal_amount'         => 24.92,
                    'subtotal_amount_details' => [
                        'currency'   => 'EUR',
                        'formatted'  => '24.92 €',
                        'in_subunit' => '2492',
                    ],
                    'shipping_amount'         => 3.34,
                    'shipping_amount_details' => [
                        'currency'   => 'EUR',
                        'formatted'  => '3.34 €',
                        'in_subunit' => '334',
                    ],
                    'total_amount'         => 28.26,
                    'total_amount_details' => [
                        'currency'   => 'EUR',
                        'formatted'  => '28.26 €',
                        'in_subunit' => '2826',
                    ],
                    'customs_shipping_costs'         => 5.99,
                    'customs_shipping_costs_details' => [
                        'currency'   => 'EUR',
                        'formatted'  => '5.99 €',
                        'in_subunit' => '599',
                    ],
                ],
            ],
        ],

        'meta' => [
            'pagination' => [
                'total'        => 10,
                'count'        => 10,
                'per_page'     => 1,
                'current_page' => 1,
                'total_pages'  => 1,
                'links'        => [
                    'previous' => '/api/beta/orders?page=1',
                    'next'     => '/api/beta/orders?page=3',
                ],
            ],
        ],
    ];

    public const GET_ORDER = [
        'data' => [
            'id'              => 'PPO21694395T',
            'external_id'     => '',
            'is_test'         => true,
            'shipping_method' => [
                'code' => 'DHL',
                'name' => 'DHL',
            ],
            'status'       => 'DRAFT',
            'status_label' => 'Draft',
            'created_at'   => '2023-01-01T00:00:00.000000Z',
            'updated_at'   => '2023-01-01T00:00:00.000000Z',
            'shipments'    => [
                [
                    'shipping_method' => [
                        'code' => 'DHL',
                        'name' => 'DHL',
                    ],
                    'tracking_number' => 'tracking-number-id',
                    'tracking_url'    => 'https://tracking.com?track=tracking-number-id',
                    'shipped_at'      => '2023-01-01T00:00:00.000000Z',
                    'items'           => [
                        [
                            'item_id'          => 1,
                            'item_external_id' => '1',
                            'quantity'         => 1,
                        ],
                    ],
                ],
            ],
            'items' => [
                [
                    'id'            => 3399,
                    'external_id'   => null,
                    'variant_id'    => 3,
                    'name'          => '40x30 cm',
                    'quantity'      => 1,
                    'price'         => 24.92,
                    'price_details' => [
                        'currency'   => 'EUR',
                        'formatted'  => '24.92 €',
                        'in_subunit' => '2492',
                    ],
                    'file'    => 'https://dummyimage.com/4000x3000/fff/000&text=api.picanova.com',
                    'options' => [
                        [
                            'id'    => 1,
                            'name'  => 'Canvas border',
                            'value' => [
                                'id'   => 3,
                                'name' => 'Stretched',
                            ],
                        ],
                    ],
                ],
            ],
            'totals' => [
                'subtotal_amount'         => 24.92,
                'subtotal_amount_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '24.92 €',
                    'in_subunit' => '2492',
                ],
                'shipping_amount'         => 3.34,
                'shipping_amount_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '3.34 €',
                    'in_subunit' => '334',
                ],
                'total_amount'         => 28.26,
                'total_amount_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '28.26 €',
                    'in_subunit' => '2826',
                ],
                'customs_shipping_costs'         => 5.99,
                'customs_shipping_costs_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '5.99 €',
                    'in_subunit' => '599',
                ],
            ],
        ],
    ];
}
