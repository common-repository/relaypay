<?php

/**
 * ECommerceApi
 * PHP version 5
 *
 * @category Class
 * @package  RelayPay
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
/**
 * RelayPay-Api-Spec
 *
 * Relay Pay API documentation. Use `api.sandbox.relaypay.io` for Sandbox environment and `api.relaypay.io` for production.  Some useful links: - [Official docs](https://relaypay-merchant.readme.io/reference/merchant-native-integration)
 *
 * OpenAPI spec version: 0.0.2
 * Contact: support@relaypay.io
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.26
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */
namespace RelayPayDeps\RelayPay\Api;

use RelayPayDeps\GuzzleHttp\Client;
use RelayPayDeps\GuzzleHttp\ClientInterface;
use RelayPayDeps\GuzzleHttp\Exception\RequestException;
use RelayPayDeps\GuzzleHttp\Psr7\MultipartStream;
use RelayPayDeps\GuzzleHttp\Psr7\Request;
use RelayPayDeps\GuzzleHttp\RequestOptions;
use RelayPayDeps\RelayPay\ApiException;
use RelayPayDeps\RelayPay\Configuration;
use RelayPayDeps\RelayPay\HeaderSelector;
use RelayPayDeps\RelayPay\ObjectSerializer;
/**
 * ECommerceApi Class Doc Comment
 *
 * @category Class
 * @package  RelayPay
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ECommerceApi
{
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @var Configuration
     */
    protected $config;
    /**
     * @var HeaderSelector
     */
    protected $headerSelector;
    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     */
    public function __construct(ClientInterface $client = null, Configuration $config = null, HeaderSelector $selector = null)
    {
        $this->client = $client ?: new Client();
        $this->config = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
    }
    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }
    /**
     * Operation getMerchantTransaction
     *
     * Get merchant transaction for a given merchantId by a specified orderId
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  string $order_id Your unique reference for this payment. i.e. id of the current shopping cart (required)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RelayPay\Model\EcommerceMerchantTransaction
     */
    public function getMerchantTransaction($merchant_id, $order_id)
    {
        list($response) = $this->getMerchantTransactionWithHttpInfo($merchant_id, $order_id);
        return $response;
    }
    /**
     * Operation getMerchantTransactionWithHttpInfo
     *
     * Get merchant transaction for a given merchantId by a specified orderId
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  string $order_id Your unique reference for this payment. i.e. id of the current shopping cart (required)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RelayPay\Model\EcommerceMerchantTransaction, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMerchantTransactionWithHttpInfo($merchant_id, $order_id)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\EcommerceMerchantTransaction';
        $request = $this->getMerchantTransactionRequest($merchant_id, $order_id);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse() ? $e->getResponse()->getHeaders() : null, $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!\in_array($returnType, ['string', 'integer', 'bool'])) {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), 'RelayPayDeps\\RelayPay\\Model\\EcommerceMerchantTransaction', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }
    /**
     * Operation getMerchantTransactionAsync
     *
     * Get merchant transaction for a given merchantId by a specified orderId
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  string $order_id Your unique reference for this payment. i.e. id of the current shopping cart (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMerchantTransactionAsync($merchant_id, $order_id)
    {
        return $this->getMerchantTransactionAsyncWithHttpInfo($merchant_id, $order_id)->then(function ($response) {
            return $response[0];
        });
    }
    /**
     * Operation getMerchantTransactionAsyncWithHttpInfo
     *
     * Get merchant transaction for a given merchantId by a specified orderId
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  string $order_id Your unique reference for this payment. i.e. id of the current shopping cart (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMerchantTransactionAsyncWithHttpInfo($merchant_id, $order_id)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\EcommerceMerchantTransaction';
        $request = $this->getMerchantTransactionRequest($merchant_id, $order_id);
        return $this->client->sendAsync($request, $this->createHttpClientOption())->then(function ($response) use($returnType) {
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        }, function ($exception) {
            $response = $exception->getResponse();
            $statusCode = $response->getStatusCode();
            throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
        });
    }
    /**
     * Create request for operation 'getMerchantTransaction'
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  string $order_id Your unique reference for this payment. i.e. id of the current shopping cart (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMerchantTransactionRequest($merchant_id, $order_id)
    {
        // verify the required parameter 'merchant_id' is set
        if ($merchant_id === null || \is_array($merchant_id) && \count($merchant_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $merchant_id when calling getMerchantTransaction');
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || \is_array($order_id) && \count($order_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $order_id when calling getMerchantTransaction');
        }
        $resourcePath = '/api/v1/merchant/transaction';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // query params
        if ($merchant_id !== null) {
            $queryParams['merchantId'] = ObjectSerializer::toQueryValue($merchant_id, null);
        }
        // query params
        if ($order_id !== null) {
            $queryParams['orderId'] = ObjectSerializer::toQueryValue($order_id, null);
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['application/json']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['application/json'], []);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($httpBody);
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \RelayPayDeps\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \RelayPayDeps\GuzzleHttp\Psr7\build_query($queryParams);
        return new Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    /**
     * Operation getMerchantTxs
     *
     * Get all bill payment transactions for the merchant
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  int $page Starts from 0 (required)
     * @param  int $size how many records to be returned (required)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RelayPay\Model\PageEcommerceMerchantTransaction
     */
    public function getMerchantTxs($merchant_id, $page, $size)
    {
        list($response) = $this->getMerchantTxsWithHttpInfo($merchant_id, $page, $size);
        return $response;
    }
    /**
     * Operation getMerchantTxsWithHttpInfo
     *
     * Get all bill payment transactions for the merchant
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  int $page Starts from 0 (required)
     * @param  int $size how many records to be returned (required)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RelayPay\Model\PageEcommerceMerchantTransaction, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMerchantTxsWithHttpInfo($merchant_id, $page, $size)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\PageEcommerceMerchantTransaction';
        $request = $this->getMerchantTxsRequest($merchant_id, $page, $size);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse() ? $e->getResponse()->getHeaders() : null, $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!\in_array($returnType, ['string', 'integer', 'bool'])) {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), 'RelayPayDeps\\RelayPay\\Model\\PageEcommerceMerchantTransaction', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }
    /**
     * Operation getMerchantTxsAsync
     *
     * Get all bill payment transactions for the merchant
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  int $page Starts from 0 (required)
     * @param  int $size how many records to be returned (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMerchantTxsAsync($merchant_id, $page, $size)
    {
        return $this->getMerchantTxsAsyncWithHttpInfo($merchant_id, $page, $size)->then(function ($response) {
            return $response[0];
        });
    }
    /**
     * Operation getMerchantTxsAsyncWithHttpInfo
     *
     * Get all bill payment transactions for the merchant
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  int $page Starts from 0 (required)
     * @param  int $size how many records to be returned (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function getMerchantTxsAsyncWithHttpInfo($merchant_id, $page, $size)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\PageEcommerceMerchantTransaction';
        $request = $this->getMerchantTxsRequest($merchant_id, $page, $size);
        return $this->client->sendAsync($request, $this->createHttpClientOption())->then(function ($response) use($returnType) {
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        }, function ($exception) {
            $response = $exception->getResponse();
            $statusCode = $response->getStatusCode();
            throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
        });
    }
    /**
     * Create request for operation 'getMerchantTxs'
     *
     * @param  string $merchant_id merchantID obtained from Relaypay (required)
     * @param  int $page Starts from 0 (required)
     * @param  int $size how many records to be returned (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function getMerchantTxsRequest($merchant_id, $page, $size)
    {
        // verify the required parameter 'merchant_id' is set
        if ($merchant_id === null || \is_array($merchant_id) && \count($merchant_id) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $merchant_id when calling getMerchantTxs');
        }
        // verify the required parameter 'page' is set
        if ($page === null || \is_array($page) && \count($page) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $page when calling getMerchantTxs');
        }
        // verify the required parameter 'size' is set
        if ($size === null || \is_array($size) && \count($size) === 0) {
            throw new \InvalidArgumentException('Missing the required parameter $size when calling getMerchantTxs');
        }
        $resourcePath = '/api/v1/merchant/transaction/history';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // query params
        if ($merchant_id !== null) {
            $queryParams['merchantId'] = ObjectSerializer::toQueryValue($merchant_id, null);
        }
        // query params
        if ($page !== null) {
            $queryParams['page'] = ObjectSerializer::toQueryValue($page, 'int32');
        }
        // query params
        if ($size !== null) {
            $queryParams['size'] = ObjectSerializer::toQueryValue($size, 'int32');
        }
        // body params
        $_tempBody = null;
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['*/*']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['*/*'], []);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($httpBody);
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \RelayPayDeps\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \RelayPayDeps\GuzzleHttp\Psr7\build_query($queryParams);
        return new Request('GET', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    /**
     * Operation setEcommerceRequest
     *
     * Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.
     *
     * @param  \RelayPay\Model\EcommerceIncomingRequest $body body (optional)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \RelayPay\Model\EcommerceResponse
     */
    public function setEcommerceRequest($body = null)
    {
        list($response) = $this->setEcommerceRequestWithHttpInfo($body);
        return $response;
    }
    /**
     * Operation setEcommerceRequestWithHttpInfo
     *
     * Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.
     *
     * @param  \RelayPay\Model\EcommerceIncomingRequest $body (optional)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \RelayPay\Model\EcommerceResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function setEcommerceRequestWithHttpInfo($body = null)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\EcommerceResponse';
        $request = $this->setEcommerceRequestRequest($body);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse() ? $e->getResponse()->getHeaders() : null, $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if (!\in_array($returnType, ['string', 'integer', 'bool'])) {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), 'RelayPayDeps\\RelayPay\\Model\\EcommerceResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }
    /**
     * Operation setEcommerceRequestAsync
     *
     * Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.
     *
     * @param  \RelayPay\Model\EcommerceIncomingRequest $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setEcommerceRequestAsync($body = null)
    {
        return $this->setEcommerceRequestAsyncWithHttpInfo($body)->then(function ($response) {
            return $response[0];
        });
    }
    /**
     * Operation setEcommerceRequestAsyncWithHttpInfo
     *
     * Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.
     *
     * @param  \RelayPay\Model\EcommerceIncomingRequest $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setEcommerceRequestAsyncWithHttpInfo($body = null)
    {
        $returnType = 'RelayPayDeps\\RelayPay\\Model\\EcommerceResponse';
        $request = $this->setEcommerceRequestRequest($body);
        return $this->client->sendAsync($request, $this->createHttpClientOption())->then(function ($response) use($returnType) {
            $responseBody = $response->getBody();
            if ($returnType === '\\SplFileObject') {
                $content = $responseBody;
                //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = \json_decode($content);
                }
            }
            return [ObjectSerializer::deserialize($content, $returnType, []), $response->getStatusCode(), $response->getHeaders()];
        }, function ($exception) {
            $response = $exception->getResponse();
            $statusCode = $response->getStatusCode();
            throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
        });
    }
    /**
     * Create request for operation 'setEcommerceRequest'
     *
     * @param  \RelayPay\Model\EcommerceIncomingRequest $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function setEcommerceRequestRequest($body = null)
    {
        $resourcePath = '/api/v1/ecommerce/request';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(['*/*']);
        } else {
            $headers = $this->headerSelector->selectHeaders(['*/*'], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($httpBody);
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \RelayPayDeps\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Sign');
        if ($apiKey !== null) {
            $headers['Sign'] = $apiKey;
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \RelayPayDeps\GuzzleHttp\Psr7\build_query($queryParams);
        return new Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    /**
     * Operation setEcommerceSalesforce
     *
     * Ecommerce provider pushes a Salesforce specific data for authorisation.
     *
     * @param  \RelayPay\Model\MerchantSalesforcePlugin $body body (optional)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return void
     */
    public function setEcommerceSalesforce($body = null)
    {
        $this->setEcommerceSalesforceWithHttpInfo($body);
    }
    /**
     * Operation setEcommerceSalesforceWithHttpInfo
     *
     * Ecommerce provider pushes a Salesforce specific data for authorisation.
     *
     * @param  \RelayPay\Model\MerchantSalesforcePlugin $body (optional)
     *
     * @throws \RelayPay\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     */
    public function setEcommerceSalesforceWithHttpInfo($body = null)
    {
        $returnType = '';
        $request = $this->setEcommerceSalesforceRequest($body);
        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException("[{$e->getCode()}] {$e->getMessage()}", $e->getCode(), $e->getResponse() ? $e->getResponse()->getHeaders() : null, $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null);
            }
            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $request->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
            }
            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
            }
            throw $e;
        }
    }
    /**
     * Operation setEcommerceSalesforceAsync
     *
     * Ecommerce provider pushes a Salesforce specific data for authorisation.
     *
     * @param  \RelayPay\Model\MerchantSalesforcePlugin $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setEcommerceSalesforceAsync($body = null)
    {
        return $this->setEcommerceSalesforceAsyncWithHttpInfo($body)->then(function ($response) {
            return $response[0];
        });
    }
    /**
     * Operation setEcommerceSalesforceAsyncWithHttpInfo
     *
     * Ecommerce provider pushes a Salesforce specific data for authorisation.
     *
     * @param  \RelayPay\Model\MerchantSalesforcePlugin $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function setEcommerceSalesforceAsyncWithHttpInfo($body = null)
    {
        $returnType = '';
        $request = $this->setEcommerceSalesforceRequest($body);
        return $this->client->sendAsync($request, $this->createHttpClientOption())->then(function ($response) use($returnType) {
            return [null, $response->getStatusCode(), $response->getHeaders()];
        }, function ($exception) {
            $response = $exception->getResponse();
            $statusCode = $response->getStatusCode();
            throw new ApiException(\sprintf('[%d] Error connecting to the API (%s)', $statusCode, $exception->getRequest()->getUri()), $statusCode, $response->getHeaders(), $response->getBody());
        });
    }
    /**
     * Create request for operation 'setEcommerceSalesforce'
     *
     * @param  \RelayPay\Model\MerchantSalesforcePlugin $body (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function setEcommerceSalesforceRequest($body = null)
    {
        $resourcePath = '/api/v1/ecommerce/salesforce';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = \false;
        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }
        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart([]);
        } else {
            $headers = $this->headerSelector->selectHeaders([], ['application/json']);
        }
        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            $httpBody = $_tempBody;
            // \stdClass has no __toString(), so we should encode it manually
            if ($httpBody instanceof \stdClass && $headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($httpBody);
            }
        } elseif (\count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = ['name' => $formParamName, 'contents' => $formParamValue];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \RelayPayDeps\GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \RelayPayDeps\GuzzleHttp\Psr7\build_query($formParams);
            }
        }
        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Sign');
        if ($apiKey !== null) {
            $headers['Sign'] = $apiKey;
        }
        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        $headers = \array_merge($defaultHeaders, $headerParams, $headers);
        $query = \RelayPayDeps\GuzzleHttp\Psr7\build_query($queryParams);
        return new Request('POST', $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''), $headers, $httpBody);
    }
    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = \fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }
        return $options;
    }
}
