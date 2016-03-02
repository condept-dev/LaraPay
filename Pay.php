<?php

namespace App\Utilities;

use Illuminate\Support\Facades\Cache;
use Paynl\Config;
use Paynl\Paymentmethods;
use Paynl\Transaction;

class Pay
{
    /**
     * 172800 equals 2 days
     * @var int
     */
    protected $cacheTime = 172800;

    /**
     * Pay constructor.
     */
    public function __construct()
    {
        Config::setApiToken(env('PAY_TOKEN'));
        Config::setServiceId(env('PAY_SERVICEID'));
    }

    /**
     * @return array
     */
    public function banks()
    {
        return Cache::remember('banks', 4800, function () {
            $issuers = collect(Paymentmethods::getBanks(10));

            $idealIssuers = [];
            foreach ($issuers as $issuer)
            {
                $idealIssuers[$issuer['id']] = htmlspecialchars($issuer['name']);
            }

            return $idealIssuers;
        });
    }

    public function startTransaction($arr = [])
    {
        return Transaction::start($arr);
    }

    /**
     * @param $id
     * @return \Paynl\Result\Transaction\Transaction
     */
    public function getTransaction($id)
    {
        return Transaction::get($id);
    }
}