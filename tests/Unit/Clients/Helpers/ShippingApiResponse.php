<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers;

final class ShippingApiResponse
{
    public const GET_SHIPPING_RATES = [
        'data' => [
            [
                'code'          => 'DHL',
                'name'          => 'DHL',
                'price'         => 6.02,
                'price_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '6.02 €',
                    'in_subunit' => 602,
                ],
            ],
            [
                'code'          => 'DHL',
                'name'          => 'DHL',
                'price'         => 6.02,
                'price_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '6.02 €',
                    'in_subunit' => 602,
                ],
            ],
        ],
    ];

    public const GET_SHIPPING_TYPES = [
        'data' => [
            [
                'priority' => 1,
                'code'     => 'UNTRACKED',
            ],
            [
                'priority' => 2,
                'code'     => 'TRACKED',
            ],
        ],
    ];

    public const GET_SHIPPING_METHODS = [
        'data' => [
            [
                'code' => 'GEL',
                'name' => 'GEL',
            ],
            [
                'code' => 'UPS',
                'name' => 'UPS',
            ],
        ],
    ];

    public const GET_COUNTRIES = [
        'data' => [
            [
                'name'         => 'Germany',
                'country_id'   => 276,
                'country_code' => 'DE',
            ],
            [
                'name'         => 'Latvia',
                'country_id'   => 428,
                'country_code' => 'LV',
            ],
        ],
    ];

    public const GET_REGIONS = [
        'data' => [
            [
                'id'   => 52,
                'code' => 'AB',
                'name' => 'Alberta',
            ],
            [
                'id'   => 53,
                'code' => 'LB',
                'name' => 'Labrador',
            ],
        ],
    ];
}
