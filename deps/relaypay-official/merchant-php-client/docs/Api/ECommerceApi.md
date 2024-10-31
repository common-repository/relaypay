# RelayPay\ECommerceApi

All URIs are relative to *https://{environment}.relaypay.io*

Method | HTTP request | Description
------------- | ------------- | -------------
[**getMerchantTransaction**](ECommerceApi.md#getmerchanttransaction) | **GET** /api/v1/merchant/transaction | Get merchant transaction for a given merchantId by a specified orderId
[**getMerchantTxs**](ECommerceApi.md#getmerchanttxs) | **GET** /api/v1/merchant/transaction/history | Get all bill payment transactions for the merchant
[**setEcommerceRequest**](ECommerceApi.md#setecommercerequest) | **POST** /api/v1/ecommerce/request | Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.
[**setEcommerceSalesforce**](ECommerceApi.md#setecommercesalesforce) | **POST** /api/v1/ecommerce/salesforce | Ecommerce provider pushes a Salesforce specific data for authorisation.

# **getMerchantTransaction**
> \RelayPay\Model\EcommerceMerchantTransaction getMerchantTransaction($merchant_id, $order_id)

Get merchant transaction for a given merchantId by a specified orderId

Use this endpoint to retrieve merchant transaction by merchantId and orderId

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure API key authorization: authorization
$config = RelayPay\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RelayPay\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new RelayPay\Api\ECommerceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$merchant_id = "merchant_id_example"; // string | merchantID obtained from Relaypay
$order_id = "order_id_example"; // string | Your unique reference for this payment. i.e. id of the current shopping cart

try {
    $result = $apiInstance->getMerchantTransaction($merchant_id, $order_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ECommerceApi->getMerchantTransaction: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **merchant_id** | **string**| merchantID obtained from Relaypay |
 **order_id** | **string**| Your unique reference for this payment. i.e. id of the current shopping cart |

### Return type

[**\RelayPay\Model\EcommerceMerchantTransaction**](../Model/EcommerceMerchantTransaction.md)

### Authorization

[authorization](../../README.md#authorization)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMerchantTxs**
> \RelayPay\Model\PageEcommerceMerchantTransaction getMerchantTxs($merchant_id, $page, $size)

Get all bill payment transactions for the merchant

Use this endpoint to retrieve transaction history

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure API key authorization: authorization
$config = RelayPay\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RelayPay\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$apiInstance = new RelayPay\Api\ECommerceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$merchant_id = "merchant_id_example"; // string | merchantID obtained from Relaypay
$page = 56; // int | Starts from 0
$size = 56; // int | how many records to be returned

try {
    $result = $apiInstance->getMerchantTxs($merchant_id, $page, $size);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ECommerceApi->getMerchantTxs: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **merchant_id** | **string**| merchantID obtained from Relaypay |
 **page** | **int**| Starts from 0 |
 **size** | **int**| how many records to be returned |

### Return type

[**\RelayPay\Model\PageEcommerceMerchantTransaction**](../Model/PageEcommerceMerchantTransaction.md)

### Authorization

[authorization](../../README.md#authorization)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **setEcommerceRequest**
> \RelayPay\Model\EcommerceResponse setEcommerceRequest($body)

Ecommerce provider pushes a transaction request. The service returns a unique url to be used for redirection.

Use this endpoint to create a payment request

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure API key authorization: sign
$config = RelayPay\Configuration::getDefaultConfiguration()->setApiKey('Sign', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RelayPay\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Sign', 'Bearer');

$apiInstance = new RelayPay\Api\ECommerceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \RelayPay\Model\EcommerceIncomingRequest(); // \RelayPay\Model\EcommerceIncomingRequest | 

try {
    $result = $apiInstance->setEcommerceRequest($body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ECommerceApi->setEcommerceRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\RelayPay\Model\EcommerceIncomingRequest**](../Model/EcommerceIncomingRequest.md)|  | [optional]

### Return type

[**\RelayPay\Model\EcommerceResponse**](../Model/EcommerceResponse.md)

### Authorization

[sign](../../README.md#sign)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: */*

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **setEcommerceSalesforce**
> setEcommerceSalesforce($body)

Ecommerce provider pushes a Salesforce specific data for authorisation.

Use this endpoint to update Salesforce private key

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
// Configure API key authorization: sign
$config = RelayPay\Configuration::getDefaultConfiguration()->setApiKey('Sign', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = RelayPay\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Sign', 'Bearer');

$apiInstance = new RelayPay\Api\ECommerceApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$body = new \RelayPay\Model\MerchantSalesforcePlugin(); // \RelayPay\Model\MerchantSalesforcePlugin | 

try {
    $apiInstance->setEcommerceSalesforce($body);
} catch (Exception $e) {
    echo 'Exception when calling ECommerceApi->setEcommerceSalesforce: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**\RelayPay\Model\MerchantSalesforcePlugin**](../Model/MerchantSalesforcePlugin.md)|  | [optional]

### Return type

void (empty response body)

### Authorization

[sign](../../README.md#sign)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

