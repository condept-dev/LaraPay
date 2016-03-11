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
     * Returns all payment methods
     *
     * @return \Illuminate\Support\Collection
     */
    public function methods()
    {
        $methods = collect(Paymentmethods::getList());

        return $methods;
    }

    /**
     * Returns the name for a method
     *
     * @param null $id
     * @return bool
     */
    public function methodName($id = null)
    {
        if(is_null($id)) return false;

        return $this->methods()->groupBy('id')->get($id)->first();
    }

    /**
     * Returns iDEAL bank lists as collection
     * Banks are cached so speed won't be an issue here.
     *
     * @return array
     */
    public function banks()
    {
        return Cache::remember('banks', $this->cacheTime, function () {
            $issuers = collect(Paymentmethods::getBanks(10));

            $idealIssuers = [];
            foreach ($issuers as $issuer)
            {
                $idealIssuers[$issuer['id']] = htmlspecialchars($issuer['name']);
            }

            return $idealIssuers;
        });
    }

    /**
     * Start transaction
     *
     * @param array $arr
     * @return \Paynl\Result\Transaction\Start
     */
    public function startTransaction($arr = [])
    {
        return Transaction::start($arr);
    }

    /**
     * Returns a transaction
     *
     * @param $id
     * @return \Paynl\Result\Transaction\Transaction
     */
    public function getTransaction($id)
    {
        return Transaction::get($id);
    }
}