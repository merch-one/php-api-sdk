<?php

namespace MerchOne\PhpApiSdk\Tests\Unit\Clients\Helpers;

final class CatalogApiResponse
{
    public const GET_PRODUCTS = [
        'data' => [
            [
                'id'       => 2,
                'name'     => 'Canvas',
                'variants' => 64,
                'sku'      => 'CVS',
                'dpi'      => 36,
                'type'     => 'PRINT',
                'images'   => [
                    'id'        => 1,
                    'original'  => 'https://dummyimage.com/4000x3000/fff/000&text=api.merchone.com',
                    'thumbnail' => 'https://dummyimage.com/400x300/fff/000&text=api.merchone.com',
                ],
            ],
            [
                'id'       => 4,
                'name'     => 'Magic Mug',
                'variants' => 5,
                'sku'      => 'MGM',
                'dpi'      => 72,
                'type'     => 'PRINT',
                'images'   => [
                    'id'        => 2,
                    'original'  => 'https://dummyimage.com/4000x3000/fff/000&text=api.merchone.com',
                    'thumbnail' => 'https://dummyimage.com/400x300/fff/000&text=api.merchone.com',
                ],
            ],
        ],
    ];

    public const GET_PRODUCT_VARIANTS = [
        'data' => [
            [
                'id'           => 30,
                'code'         => 'QUAD-100X100-1',
                'variant_id'   => 30,
                'variant_code' => 'QUAD-100X100-1',
                'sku'          => '1001001',
                'name'         => '100x100 cm',
                'printfile'    => [
                    'format_width'  => 1000,
                    'format_height' => 1000,
                ],
                'price'         => 29.8,
                'price_details' => [
                    'currency'   => 'EUR',
                    'formatted'  => '29.09 €',
                    'in_subunit' => 298,
                ],
                'shipping_countries' => [
                    276,
                    826,
                    246,
                ],
                'options' => [
                    [
                        'name'        => 'Canvas border',
                        'description' => null,
                        'image'       => null,
                        'is_required' => true,
                        'values'      => [
                            [
                                'id'            => 1,
                                'name'          => 'Mirrored',
                                'sku'           => '',
                                'image'         => null,
                                'price'         => 0,
                                'price_details' => [
                                    'currency'   => 'EUR',
                                    'formatted'  => '29.09 €',
                                    'in_subunit' => 298,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    public const GET_VARIANT_OPTIONS = [
        'data' => [
            'id'           => 30,
            'code'         => 'QUAD-100X100-1',
            'variant_id'   => 30,
            'variant_code' => 'QUAD-100X100-1',
            'sku'          => '1001001',
            'name'         => '100x100 cm',
            'printfile'    => [
                'format_width'  => 1000,
                'format_height' => 1000,
            ],
            'price'         => 29.8,
            'price_details' => [
                'currency'   => 'EUR',
                'formatted'  => '29.09 €',
                'in_subunit' => 298,
            ],
            'shipping_countries' => [
                276,
                826,
                246,
            ],
            'options' => [
                [
                    'name'        => 'Canvas border',
                    'description' => null,
                    'image'       => null,
                    'is_required' => true,
                    'values'      => [
                        [
                            'id'            => 1,
                            'name'          => 'Mirrored',
                            'sku'           => '',
                            'image'         => null,
                            'price'         => 0,
                            'price_details' => [
                                'currency'   => 'EUR',
                                'formatted'  => '29.09 €',
                                'in_subunit' => 298,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    public const GET_VARIANT_COMBINATIONS = [
        'data' => [
            'sku'           => 'CVS0200201F2HCLMSB',
            'name'          => '20x20 cm, Canvas border: Mirrored,Stretcher frame: 2 cm,Frame: Floating Frame Black Matt,Hanger Set for Canvas: Hanger Set for Canvas',
            'price'         => 13.02,
            'price_details' => [
                'currency'   => 'EUR',
                'formatted'  => '13.02 €',
                'in_subunit' => 1302,
            ],
            'options' => [
                [
                    'id'          => 1,
                    'name'        => 'Canvas border',
                    'image'       => null,
                    'description' => '',
                    'is_required' => true,
                    'value'       => [
                        'id'    => 1,
                        'name'  => 'Mirrored',
                        'image' => [
                            'id'       => 1228,
                            'original' => 'https://euc-premiumprint-testing.s3.eu-central-1.amazonaws.com/images/image/dE/DU/dEDUgdRkTyh9EFtfirS3gfHvPmn466OJ4mQUqqYW.jpeg',
                        ],
                        'price'         => 0.2,
                        'price_details' => [
                            'currency'   => 'EUR',
                            'formatted'  => '0.20 €',
                            'in_subunit' => 20,
                        ],
                    ],
                ],
                [
                    'id'          => 2,
                    'name'        => 'Stretcher frame',
                    'image'       => null,
                    'description' => '',
                    'is_required' => true,
                    'value'       => [
                        'id'    => 6,
                        'name'  => '2 cm',
                        'image' => [
                            'id'       => 194,
                            'original' => 'https://euc-premiumprint-testing.s3.eu-central-1.amazonaws.com/images/image/lK/jc/lKjcoc347fqYciukY9Aw8VSRajNNRr9v0H1W2Erd.jpeg',
                        ],
                        'price'         => 2,
                        'price_details' => [
                            'currency'   => 'EUR',
                            'formatted'  => '2.00 €',
                            'in_subunit' => 200,
                        ],
                    ],
                ],
                [
                    'id'          => 5,
                    'name'        => 'Frame',
                    'image'       => null,
                    'description' => '',
                    'is_required' => false,
                    'value'       => [
                        'id'    => 18,
                        'name'  => 'Floating Frame Black Matt',
                        'image' => [
                            'id'       => 6581,
                            'original' => 'https://euc-premiumprint-testing.s3.eu-central-1.amazonaws.com/images/image/tU/9N/tU9NxIOS0PJ0iqPrIcfZ3K69hvxQIsm7AlbxcKPN.jpg',
                        ],
                        'price'         => 5.76,
                        'price_details' => [
                            'currency'   => 'EUR',
                            'formatted'  => '5.76 €',
                            'in_subunit' => 576,
                        ],
                    ],
                ],
                [
                    'id'          => 17,
                    'name'        => 'Hanger Set for Canvas',
                    'image'       => null,
                    'description' => null,
                    'is_required' => false,
                    'value'       => [
                        'id'    => 38,
                        'name'  => 'Hanger Set for Canvas',
                        'image' => [
                            'id'       => 6279,
                            'original' => 'https://euc-premiumprint-testing.s3.eu-central-1.amazonaws.com/images/image/KV/MS/KVMSFrC87rFCTkrAYSD9psNDIsvlCDfrApT74TaM.jpg',
                        ],
                        'price'         => 1.27,
                        'price_details' => [
                            'currency'   => 'EUR',
                            'formatted'  => '1.27 €',
                            'in_subunit' => 127,
                        ],
                    ],
                ],
            ],
        ],
    ];
}
