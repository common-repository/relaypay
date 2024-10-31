# EcommerceIncomingRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**amount** | **float** |  | [optional] 
**customer_name** | **string** |  | [optional] 
**customer_email** | **string** |  | [optional] 
**store_name** | **string** |  | [optional] 
**merchant_id** | **string** | merchantID obtained from Relaypay | [optional] 
**currency** | **string** | Currency corresponding to the amountt given. Must be the currency approved for this merchant. | [optional] 
**order_id** | **string** | Your unique reference for this payment. i.e. id of the current shopping cart | [optional] 
**callback_url_redirect** | **string** | Where to redirect once the payment is pending or cancelled. If this value is provided it&#x27;ll override the general settings. | 
**callback_cancel_url_redirect** | **string** | Where to redirect once the payment is cancelled. If this value is not provided callbackUrlRedirect will be used | [optional] 
**web_hook_url** | **string** | Where to post updates about a payment. These will be posted with every payment change. This callback is guaranteed to happen before we redirect the user back. If this value is provided it&#x27;ll override the general settings. If not provide at all - webhook will not send | [optional] 
**security_token** | **string** | This token will be sent back with the callback in Authorization header. (Authorization:  [type] [credentials]  (e.x Basic Rjc1234567890jdGMS67890U78...)) When creating the token, both &#x27;type&#x27; and &#x27;credentials&#x27; are required. | [optional] 

[[Back to Model list]](../../README.md#documentation-for-models) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to README]](../../README.md)

