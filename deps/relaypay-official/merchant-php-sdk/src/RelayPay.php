<?php

namespace RelayPayDeps\RelayPay\SDK;

use RelayPayDeps\GuzzleHttp\Client;
use RelayPayDeps\RelayPay\Api\ECommerceApi;
use RelayPayDeps\RelayPay\Api\TransactionsApi;
use RelayPayDeps\RelayPay\Configuration;
use RelayPayDeps\RelayPay\SDK\Api\Transactions;
class RelayPay
{
    const URL_TEST = 'https://api.sandbox.relaypay.io';
    const URL_PROD = 'https://api.relaypay.io';
    private $client;
    private $environment;
    private Credentials $credentials;
    public function __construct(string $publicKey = '', string $privateKey = '', string $email = '', $environment = 'test')
    {
        $this->credentials = new Credentials($publicKey, $privateKey, $email);
        $this->environment = $environment;
    }
    public function getDefaultConfiguration()
    {
        $apiUrl = $this->environment === 'live' ? self::URL_PROD : self::URL_TEST;
        return Configuration::getDefaultConfiguration()->setHost($apiUrl);
    }
    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }
    /**
     * @param  mixed  $environment
     *
     * @return RelayPay
     */
    public function setEnvironment($environment)
    {
        $this->environment = $environment;
        return $this;
    }
    /**
     * @return Credentials
     */
    public function getCredentials() : Credentials
    {
        return $this->credentials;
    }
    /**
     * @param  Credentials  $credentials
     */
    public function setCredentials(Credentials $credentials) : void
    {
        $this->credentials = $credentials;
    }
    public function ecommerce()
    {
        $client = new ECommerceApi(new Client(), $this->getDefaultConfiguration());
        return new Transactions($this->credentials, $client);
    }
}
