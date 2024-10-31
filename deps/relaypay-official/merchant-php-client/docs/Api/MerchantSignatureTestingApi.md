# RelayPay\MerchantSignatureTestingApi

All URIs are relative to *https://{environment}.relaypay.io*

Method | HTTP request | Description
------------- | ------------- | -------------
[**generateSign**](MerchantSignatureTestingApi.md#generatesign) | **POST** /api/v1/merchants/generate-sign/{privateKey} | Testing header signature generation. Not to be used in the actual merchant implementation. This method is a convenience for a developer to verify that his sign function generates the same header as we do.

# **generateSign**
> string generateSign($private_key, $body)

Testing header signature generation. Not to be used in the actual merchant implementation. This method is a convenience for a developer to verify that his sign function generates the same header as we do.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$apiInstance = new RelayPay\Api\MerchantSignatureTestingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client()
);
$private_key = "private_key_example"; // string | your private(secret) key from Relaypay
$body = "body_example"; // string | payload for the transaction

try {
    $result = $apiInstance->generateSign($private_key, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MerchantSignatureTestingApi->generateSign: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **private_key** | **string**| your private(secret) key from Relaypay |
 **body** | [**string**](../Model/string.md)| payload for the transaction | [optional]

### Return type

**string**

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: text/plain

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

