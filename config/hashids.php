<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@vinkla.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'salt' => 'your-salt-string',
            'length' => 'your-length-integer',
            'alphabet' => 'your-alphabet-string',
        ],

        'pg' => [
            'salt' => 'Bismillahirrohmanirrohim',
            'length' => 6,
            'alphabet' => 'PG1234567890EAWI',
        ],
        
        'st' => [
            'salt' => 'Alhamdulillahirobilalamin',
            'length' => 6,
            'alphabet' => 'ST1234567890URAG',
        ],

        'spd' => [
            'salt' => 'Arrohmanirrohim',
            'length' => 6,
            'alphabet' => 'SPDALURTEJNI1234567890',
        ],

        'user' => [
            'salt' => 'Malikiyaumiddin',
            'length' => 6,
            'alphabet' => 'USERuser1234567890',
        ],

        'nominatif' => [
            'salt' => 'Iyyakanabuduwaiyyakanastain',
            'length' => 6,
            'alphabet' => 'NOMIATF1234567890',
        ],

        'rincian' => [
            'salt' => 'Ihdinasshirotolmustaqim',
            'length' => 6,
            'alphabet' => 'RINCAN1234567890',
        ],

        'satker' => [
            'salt' => 'Shirotolladzinaan\'amta\'alaihim',
            'length' => 6,
            'alphabet' => 'SATKER1234567890',
        ],

        'kegiatan' => [
            'salt' => 'Ghoirilmaghdlubi\'alaihimwaladldlallin',
            'length' => 3,
            'alphabet' => 'KEGIATN1234567890',
        ],        
    ],

];
