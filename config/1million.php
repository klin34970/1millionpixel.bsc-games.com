<?php

return [


    /**
     * 0x1 ETH
     *
     * 0x61 BSC testnet
     * 0x38 BSC
     *
     * 0x89 Polygon
     * 0x13881 Polygon testnet
     *
     * 0xfa FTM
     * 0xfa2 FTM testnet
     *
     * 0xa86a AVAX
     * 0xa869 AVAX testnet
     *
     * 0x80 HECO
     * 0x100 HECO testnet
     */
    'deployed' => [
        '0x61',
        '0xfa2',
        '0xa869',
        '0x13881',
        '0x100',

        '0x38',
        '0xfa',
        '0x89',
        '0xa86a',
        '0x80'
    ],

    'chains' => [

        'bsc' => [
            'id' => '0x38',
            'token' => 'BNB',
            'contract' => [
                '1million' => [
                    'address' => '0x6630F94f09cE67c3Ab6AFD3e90426B826CB997bD',
                    'price_per_pixel' => 0.0005
                ]
            ]
        ],
        'bsctestnet' => [
            'id' => '0x61',
            'token' => 'BNB',
            'contract' => [
                '1million' => [
                    'address' => '0xcF6C42A3b6F7aF379A4505FE53E9F74eFaC156Bf',
                    'price_per_pixel' => 0.0001
                ]
            ]
        ],

        'polygon' => [
            'id' => '0x89',
            'token' => 'MATIC',
            'contract' => [
                '1million' => [
                    'address' => '0x0b8C6d1dd2F2Ca1bD5FD3b605629E85019893695',
                    'price_per_pixel' => 0.1
                ]
            ]
        ],
        'polygontestnet' => [
            'id' => '0x13881',
            'token' => 'MATIC',
            'contract' => [
                '1million' => [
                    'address' => '0x1F05C0C1D11e79a51e46D98E7303c1Aab9ef6487',
                    'price_per_pixel' => 0.0001
                ]
            ]
        ],
        'ftm' => [
            'id' => '0xfa',
            'token' => 'FTM',
            'contract' => [
                '1million' => [
                    'address' => '0x6630F94f09cE67c3Ab6AFD3e90426B826CB997bD',
                    'price_per_pixel' => 0.5
                ]
            ]
        ],
        'ftmtestnet' => [
            'id' => '0xfa2',
            'token' => 'FTM',
            'contract' => [
                '1million' => [
                    'address' => '0x0c3cB94dEB63e1487972c35a8f06B40E45820D69',
                    'price_per_pixel' => 0.0001
                ]
            ]
        ],
        'avax' => [
            'id' => '0xa86a',
            'token' => 'AVAX',
            'contract' => [
                '1million' => [
                    'address' => '0xCb45eb657a8152FE9bd5E3B411D5468AB4e75AAA',//OLD CONTRACT WITH DELETE BUGS
                    'price_per_pixel' => 0.01
                ]
            ]
        ],
        'avaxtestnet' => [
            'id' => '0xa869',
            'token' => 'AVAX',
            'contract' => [
                '1million' => [
                    'address' => '0xCb45eb657a8152FE9bd5E3B411D5468AB4e75AAA',
                    'price_per_pixel' => 0.0001
                ]
            ]
        ],
        'heco' => [
            'id' => '0x80',
            'token' => 'HT',
            'contract' => [
                '1million' => [
                    'address' => '0x6630F94f09cE67c3Ab6AFD3e90426B826CB997bD',
                    'price_per_pixel' => 0.01
                ]
            ]
        ],
        'hecotestnet' => [
            'id' => '0x100',
            'token' => 'HT',
            'contract' => [
                '1million' => [
                    'address' => '0xCb45eb657a8152FE9bd5E3B411D5468AB4e75AAA',
                    'price_per_pixel' => 0.0001
                ]
            ]
        ]
    ]
];
