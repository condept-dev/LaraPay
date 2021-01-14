<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pay.nl's configuration variables
    |--------------------------------------------------------------------------
    |
    | Setup these variables ("PAY_TOKEN", "PAY_SERVICE_ID") inside your .env file so
    | this package can communicate with pay.nl
    |
    */

    /*
     * Token
     */
    'tokenId' => env('PAY_TOKEN'),

    /*
     * Service ID
     */
    'serviceId' => env('PAY_SERVICE_ID'),

    /*
     * Token code
     */
    'tokenCode' => env('PAY_TOKEN_CODE'),
];
