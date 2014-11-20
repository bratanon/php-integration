---
layout: index
---
# Svea PHP Integration Package Documentation

## Version 2.2.5

(For the complete class reference, see the <a href="http://sveawebpay.github.io/php-integration/api/index.html" target="_blank">API documentation</a>.)

## Index <a name="index"></a>

* [I. Introduction](http://sveawebpay.github.io/php-integration#introduction)
* [1. Installing and configuration](http://sveawebpay.github.io/php-integration#i1)
* [2. "Hello World"](http://sveawebpay.github.io/php-integration#i2)
* [3. Building an order](http://sveawebpay.github.io/php-integration#i3)
    * [3.1 Order builder](http://sveawebpay.github.io/php-integration#i31)
    * [3.2 Order row items](http://sveawebpay.github.io/php-integration#i32)
    * [3.3 Customer identity](http://sveawebpay.github.io/php-integration#i33)
    * [3.4 Additional order attributes](http://sveawebpay.github.io/php-integration#i34)
    * [3.5 Payment method selection](http://sveawebpay.github.io/php-integration#i35)
    * [3.6 Recommended payment method usage](http://sveawebpay.github.io/php-integration#i36)
* [4. Payment method reference](http://sveawebpay.github.io/php-integration#i4)
    * [4.1 Svea Invoice payment](http://sveawebpay.github.io/php-integration#i41)
    * [4.2 Svea Payment plan payment](http://sveawebpay.github.io/php-integration#i42)
    * [4.3 Card payment](http://sveawebpay.github.io/php-integration#i43)
    * [4.4 Direct bank payment](http://sveawebpay.github.io/php-integration#i44)
    * [4.5 Using the Svea PayPage](http://sveawebpay.github.io/php-integration#i45)
    * [4.6 Examples](http://sveawebpay.github.io/php-integration#i46)
* [5. WebPayItem reference](http://sveawebpay.github.io/php-integration#i5)
    * [5.1 Specifying item price](http://sveawebpay.github.io/php-integration#i51)
    * [5.2 WebPayItem::orderRow()](http://sveawebpay.github.io/php-integration#i52)
    * [5.3 WebPayItem::shippingFee()](http://sveawebpay.github.io/php-integration#i53)
    * [5.4 WebPayItem::invoiceFee()](http://sveawebpay.github.io/php-integration#i54)
    * [5.5 WebPayItem::fixedDiscount()](http://sveawebpay.github.io/php-integration#i55)
    * [5.6 WebPayItem::relativeDiscount](http://sveawebpay.github.io/php-integration#i56)
    * [5.7 WebPayItem::individualCustomer()](http://sveawebpay.github.io/php-integration#i57)
    * [5.8 WebPayItem::companyCustomer()](http://sveawebpay.github.io/php-integration#i58)
    * [5.9 WebPayItem::numberedOrderRow()](http://sveawebpay.github.io/php-integration#i59)
* [6. WebPay entrypoint method reference](http://sveawebpay.github.io/php-integration#i6)
    * [6.1 WebPay::createOrder()](http://sveawebpay.github.io/php-integration#i61)
    * [6.2 WebPay::deliverOrder()](http://sveawebpay.github.io/php-integration#i62)
    * [6.3 WebPay::getAddresses()](http://sveawebpay.github.io/php-integration#i63)
    * [6.4 WebPay::getPaymentPlanParams()](http://sveawebpay.github.io/php-integration#i64)
    * [6.5 WebPay::paymentPlanPricePerMonth()](http://sveawebpay.github.io/php-integration#i65)
    * [6.6 WebPay::listPaymentMethods()](http://sveawebpay.github.io/php-integration#i66)
* [7. WebPayAdmin entrypoint method reference](http://sveawebpay.github.io/php-integration#i7)
    * [7.1 WebPayAdmin::cancelOrder()](http://sveawebpay.github.io/php-integration#i71)
    * [7.2 WebPayAdmin::queryOrder()](http://sveawebpay.github.io/php-integration#i72)
    * [7.3 WebPayAdmin::cancelOrderRows()](http://sveawebpay.github.io/php-integration#i73)
    * [7.4 WebPayAdmin::creditOrderRows()](http://sveawebpay.github.io/php-integration#i74)
    * [7.5 WebPayAdmin::addOrderRows()](http://sveawebpay.github.io/php-integration#i75)
    * [7.6 WebPayAdmin::updateOrderRows()](http://sveawebpay.github.io/php-integration#i76)
    * [7.7 WebPayAdmin::deliverOrderRows()](http://sveawebpay.github.io/php-integration#i77)
* [8. SveaResponse](http://sveawebpay.github.io/php-integration#i8)
    * [8.1. Parsing an asynchronous service response](http://sveawebpay.github.io/php-integration#i81)
    * [8.2. Response accepted and result code](http://sveawebpay.github.io/php-integration#i82)
* [9. Additional Developer Resources and notes](http://sveawebpay.github.io/php-integration#i9)
    * [9.1 Helper class methods](http://sveawebpay.github.io/php-integration#i91)
    * [9.2 Inspect prepareRequest(), validateOrder() methods](http://sveawebpay.github.io/php-integration#i92)
* [10. Frequently Asked Questions](http://sveawebpay.github.io/php-integration#i10)
    * [10.1 Supported currencies](http://sveawebpay.github.io/php-integration#i101)

* [APPENDIX](http://sveawebpay.github.io/php-integration#appendix)

## I. Introduction <a name="introduction"></a>

### Documentation format 
This file contains an overview and examples how to use the Svea API through the WebPay and WebPayAdmin entrypoint classes. The complete integration package is documented by generated documentation in the apidoc folder.

### Svea API
The WebPay and WebPayAdmin classes make up the Svea API. Together they provide unified entrypoints to the various Svea web services. The API also encompass the support classes ConfigurationProvider, SveaResponse and WebPayItem, as well as various constant container classes and support classes.

The WebPay class methods contains the functions needed to create orders and perform payment requests using Svea payment methods. It contains methods to define order contents, send order requests, as well as support methods needed to do this.

The WebPayAdmin class methods are used to administrate orders after they have been accepted by Svea. It includes functions to update, deliver, cancel and credit orders et.al.

### Package design philosophy
In general, a request using the Svea API starts out with you creating an instance of an order builder class, which is then built up with data using fluid method calls. At a certain point, a method is used to select which service the request will go against. This method then returns an instance of a service request class which handles the specifics of building the request, which in turn returns an instance of the corresponding service response class for inspection.

The WebPay API consists of the entrypoint methods in the WebPay and WebPayAdmin classes. These instantiate builder classes in the Svea namespace. Given i.e. an order builder instance, you then use method calls to populate it with order rows and customer identifiction data. You then choose the payment method and get a request class in return. You then send the request and get a service response from Svea in return. In general, the request classes will validate that all required builder class attributes are present, and if not will throw an exception stating what methods are missing for the request in question. 

### Synchronous and asynchronous requests
Most service requests are synchronous and return a response immediately. For asynchronous hosted service payment requests, the customer will be redirected to i.e. the selected card payment provider or bank, and you will get a callback to a return url, where where you receive and parse the response.

### Namespaces
The package makes use of PHP namespaces, grouping most classes under the namespace Svea. The entrypoint classes WebPay, WebPayAdmin and associated support classes are excluded from the Svea namespace. The underlying internal services and methods are contained in the Svea sub-namespaces WebService, HostedService and AdminService. 

See the PHP documentation for more information on [namespaces in PHP](http://php.net/manual/en/language.namespaces.php).

### Fluid API 
The package is built as a fluent API so you can use method chaining when utilising the WebPay and WebPayAdmin entrypoint classes. Available methods should show up in the IDE along with their associated docblock, including information on which methods are required for the various payment methods. We recommend making sure that your IDE code completion is enabled to make full use of this feature. 

### Development environment
The Svea WebPay PHP integration package is developed and tested using NetBeans IDE 7.3.1 with the phpunit 3.7.24 plugin.

<!---
the above section 1.x text is taken from the WebPay/WebPayAdmin class docblock
 -->

[To index](http://sveawebpay.github.io/php-integration#index)

## 1. Installing and configuration <a name="i1"></a>

### 1.1 Requirements
The integration package requires PHP 5.3 or higher to use. You also need to have soap support enabled.

To run the package test suite, phpunit 3.7 is needed. To regenerate the apidoc documentation, phpdocumentor 2.7 or higher is needed.

### 1.2 Package installation
The integration package files are located under the src/ folder. Copy the contents of the src/ folder to a folder in your project, we suggest the name "svea". Then include the package file *Includes.php* in your integration. You should now be able to access the package classes.

### 1.3 Configuration
In order to make use of the Svea services you need to supply your account credentials to authorize yourself against the Svea services. For the Invoice and Payment Plan payment methods, the credentials consist of a set of Username, Password and Client number (one set for each country and service type). For Card and Direct Bank payment methods, the credentials consist of a (single) set of Merchant id and Secret Word.

You should have received the above credentials from Svea when creating a service account. If not, please contact your Svea account manager.

### 1.4 Using your account credentials with the package
The WebPay and WebPayAdmin entrypoint methods all require a config object when called. The easiest way to get such an object is to use the SveaConfig::getDefaultConfig() method. Per default, it returns a config object with the Svea test account credentials as used by the integration package test suite.

In order to use your own account credentials, either edit the SveaConfig.php file with your actual account credentials, or implement the ConfigurationProvider interface in a class of your own -- your implementation could for instance fetch the needed credentials from a database in place of the SveaConfig.php file.

See the provided example of how to customise the SveaConfig.php in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/config_getaddresses/" target="_blank">example/config_getaddresses/</a> folder.

See further the <a href="http://sveawebpay.github.io/php-integration/api/classes/ConfigurationProvider.html" target="_blank">ConfigurationProvider</a> interface and the provided <a href="http://github.com/sveawebpay/php-integration/blob/master/src/Config/SveaConfig.php" target="_blank">SveaConfig.php example file</a>.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 2. "Hello World" <a name="i2"></a>
An example of the WebPay API workflow is the following invoice payment, where we wish to perform an invoice order. Assume that we have already collected all needed order data, and will now build an order containing the ordered items (with price, article number info, et al) and customer information (name, address, et al), select a payment method, and send the payment request to Svea.

### 2.1 A complete invoice order
The following is a complete example of how to place an order using the invoice payment method:

```php
<?php
// include the Svea PHP integration package files
require( "Includes.php" );

// get configuration object holding the Svea service login credentials
$myConfig = Svea\SveaConfig::getTestConfig();

// We assume that you've collected the following information about the order in your shop:
// The shop cart contains one item "Billy" which cost 700,99 kr excluding vat (25%).
// When selecting to pay using the invoice payment method, the customer has also provided their social security number, which is required for invoice orders.

// Begin the order creation process by creating an order builder object using the WebPay::createOrder() method:
$myOrder = WebPay::createOrder( $myConfig );

// We then add information to the order object by using the various methods in the Svea\CreateOrderBuilder class.

// We begin by adding any additional information required by the payment method, which for an invoice order means:
$myOrder->setCountryCode("SE");
$myOrder->setOrderDate( date('c') );

// To add the cart contents to the order we first create and specify a new orderRow item using methods from the Svea\OrderRow class:
$boughtItem = WebPayItem::orderRow();
$boughtItem->setDescription( "Billy" );
$boughtItem->setAmountExVat( 700.99 );
$boughtItem->setVatPercent( 25 );
$boughtItem->setQuantity( 1 );

// Add the order rows to the order:
$myOrder->addOrderRow( $boughtItem );

// Next, we create a customer identity object, for invoice orders Svea will look up the customer address et al based on the social security number
$customerInformation = WebPayItem::individualCustomer();
$customerInformation->setNationalIdNumber("194605092222");

// Add the customer to the order:
$myOrder->addCustomerDetails( $myCustomerInformation );

// We have now completed specifying the order, and wish to send the payment request to Svea. To do so, we first select the invoice payment method:
$myInvoiceOrderRequest = $myOrder->useInvoicePayment();

// Then send the request to Svea using the doRequest method, and immediately receive the service response object
$myResponse = $myInvoiceOrderRequest->doRequest();

// If the response attribute accepted is true, the payment succeeded.
if( $myResponse->accepted == true ) { echo "invoice payment succeeded"; };

// The response also contains a customerIdentity object containing the invoice address of the customer, which should match the order shipping address.
print_r( $myResponse->customerIdentity );
?>
```

The above example can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/firstorder/" target="_blank">example/firstorder</a> folder.

### 2.2 What just happened?
Above, we start out by calling the API method WebPay::createOrder(), which returns an instance of the CreateOrderBuilder class.

Then, the class methods addOrderRow(), addCustomerDetails(), setOrderDate(), setCountryCode(), setCustomerReference(), and setClientOrderNumber() are used to populate the orderbuilder object with all required order information needed for an invoice order.

Then, the useInvoicePayment() method is called, returning an instance of the WebService\InvoicePayment class. We then call the doRequest() method, which validates the provided order information, and makes the request to Svea, returning an instance of the WebService\CreateOrderResponse class.

To determine the outcome of the payment request, we can then inspect the response attributes, i.e. check if $response->accepted == true.

### 2.3 Oh, that's cool, but how to use the services directly?
The package structure enables the WebPay and WebPayAdmin entrypoint methods to confine themselves to the order domain, and pushes the various service request details lower into the package stack, away from the immediate viewpoint of the integrator. Thus all payment methods and services are accessed in a uniform way, with the package doing the main work of massaging the order data to fit the selected payment method or service request.

This also provides future compatibility, as the main WebPay and WebPayAdmin entrypoint methods stay stable whereas the details of how the services are being called by the package may change in the future.

That being said, there are no additional prohibitions on using the various service call wrapper classes to access the Svea services directly, while still not having to worry about the details on how to i.e. build the various SOAP calls or format the XML data structures. 

It is possible to instantiate the service request classes directly, making sure to set all relevant attributes before performing service request. In general you need to set attributes in the internal request classes directly, as no setter methods are provided.

See further the package WebService, AdminService and HostedService namespaces for further information. All package classes are documented in the package <a href="http://sveawebpay.github.io/php-integration/api/index.html" target="_blank">API documentation</a>.

Now continue reading, and we'll work through the recommended WebPay order building procedure using the WebPay and WebPayAdmin entrypoint methods.

[< To index](http://sveawebpay.github.io/php-integration#index)

## 3. Building an order <a name="i3"></a>
We show how to specify an order, working through the various steps and options along the way:

### 3.1 Order builder <a name="i31"></a>
Start by creating an order using the WebPay::createOrder method. Pass in your configuration and get an instance of OrderBuilder in return.

```php
<?php
...
$myOrder = WebPay::createOrder($myConfig);
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CreateOrderBuilder.html" target="_blank">CreateOrderBuilder</a> for methods used to add row items to an order.

### 3.2 Order row items <a name="i32"></a>
Order row, fee and discount items can be added to the order. Together the row items amount add up to the order total to pay.

```php
<?php
...
$myOrderRow = WebPayItem::orderRow();       // create the order row object

$myOrderRow->setQuantity(1);                // required
$myOrderRow->setAmountExVat(10.00)          // recommended to specify price using AmountExVat & VatPercent
$myOrderRow->setVatPercent(12)              // recommended to specify price using AmountExVat & VatPercent

$myOrder->addOrderRow( $myOrderRow );       // add order row to the order
...

/* the same code expressed in a more compact, fluent style:
$myOrder->addOrderRow( WebPayItem::orderRow()->setQuantity(1)->setAmountExVat(10.00)->setVatPercent(12) );
*/
```
See <a href="http://sveawebpay.github.io/php-integration/api/classes/WebPayItem.html" target="_blank">WebPayItem</a> class for methods used to build order row item objects.

See [5.2](http://sveawebpay.github.io/php-integration#52) to 5.6 in the WebPayItem class documentation below for more information.

### 3.3 Customer identity <a name="i33"></a>
Create a customer identity object using the WebPayItem::individualCustomer() or WebPayItem::companyCustomer() methods. Use the addCustomerDetails() method to add the customer information to the order.

Customer identity is required for Invoice and Payment plan orders. For Card and Direct bank orders it is optional but recommended.

####3.3.1 Options for individual customers
```php
<?php
...
$order->
    ...
    addCustomerDetails(
        WebPayItem::individualCustomer()
        ->setNationalIdNumber(194605092222)
        ->setName("Tess", "Testson")
        ->setStreetAddress("Gatan", 23)
        ->setZipCode(9999)
        ->setLocality("Stan")
        ...
    )
;
...
```

See [5.7](http://sveawebpay.github.io/php-integration#57) and 5.8 in the WebPayItem class documentation below for more information on how to specify customer identity items.

### 3.4 Additional order attributes <a name="i34"></a>
Set any additional attributes needed to complete the order using the OrderBuilder methods.

```php
<?php
...
$order
    ...
    ->setCountryCode("SE")                  // required
    ->setCurrency("SEK")                    // required for card payment, direct bank & PayPage payments. Ignored for invoice and payment plan.
    ->setClientOrderNumber("A123456")       // required for card payment, direct payment, PaymentMethod & PayPage payments, max length 30 chars.
    ->setCustomerReference("att: kgm")      // optional, ignored for card & direct bank orders, max length 30 chars.
    ->setOrderDate("2012-12-12")            // required for invoice and payment plan payments
;
...
```

### 3.5 Payment method selection <a name="i35"></a>
Finish the order specification process by choosing a payment method with the order builder useXX() methods.

#### 3.5.1 Synchronous payments
Invoice and Payment plan payment methods will perform a synchronous request to Svea and return a response object which you can then inspect.

#### 3.5.2 Asynchronous payments
Hosted payment methods, like Card, Direct Bank and any payment methods accessed via the PayPage, are asynchronous.

After selecting an asynchronous payment method you generally use a request class method to get a payment form object in return. The form is then posted to Svea, where the customer is redirected to the card payment provider service or bank. After the customer completes the payment, a response is sent back to your provided return url, where it can be processed and inspected.

#### 3.5.3 Response URL:s
For asynchronous payment methods, you must specify where to receive the request response. Use the following methods:

`->setReturnUrl()` (required) When a hosted payment transaction completes the payment service will answer with a response xml message sent to the return url. This is also the return url used if the user cancels at i.e. the Certitrade card payment page.

`->setCallbackUrl()` (optional) In case the hosted payment transaction completes, but the service is unable to return a response to the return url, Svea will retry several times using the callback url as a fallback, if specified. This may happen if i.e. the user closes the browser before the payment service redirects back to the shop, or if the transaction times out in lieu of user input. In the latter case, Svea will fail the transaction after at most 30 minutes, and will try to redirect to the callback url.

`->setCancelUrl()` (optional, paypage only) Presents a cancel button on the PayPage. In case the payment method selection is cancelled by the user, Svea will redirect back to the cancel url. Unless a cancel url is specified, no cancel button will be presented at the PayPage.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.HostedPayment.html" target="_blank">HostedPayment</a> class for response url details.

The service response received is sent as an XML message, use the SveaResponse response handler to get a response object. For details, see [SveaResponse](http://sveawebpay.github.io/php-integration#8-svearesponse) below.

### 3.6 Recommended payment method usage <a name="i36"></a>
*I am using the invoice and/or payment plan payment methods in my integration.*

>The best way is to use `->useInvoicePayment()` and `->usePaymentPlanPayment()`. These payment methods are synchronous and will give you an instant response.

*I am using the card and/or direct bank payment methods in my integration.*

>The best way if you know what specific payment you want to use, is to go direct to that specific payment, bypassing the PayPage step, by using
`->usePaymentMethod`. You can check the optional payment methods configured on your account using the `WebPay::getPaymentMethods()` method.
>
>You can also use the PayPage with `->usePayPageCardOnly()` and `->usePayPageDirectBankOnly()`.

*I am using all payment methods in my integration, and wish to let the customer select which to use.*

>The most effective way is to use `->useInvoicePayment()` and `->usePaymentPlanPayment()` for the synchronous payments, and use the `->usePaymentMethod()` for the asynchronous requests. First use `WebPay::getPaymentMethods()` to fetch the different payment methods configured on you account.
>
>Alternatively you can go by *PayPage* for the asynchronous requests by using `->usePayPageCardOnly()` and `->usePayPageDirectBankOnly()`.

*I am using more than one payment and want them gathered on on place.*

>You can go by *PayPage* and choose to show all your payments here, or modify to exclude or include one or more payments. Use `->usePayPage()` where you can custom your own *PayPage*. This introduces an additional step in the customer checkout flow, though. Note also that Invoice and Payment plan payments will return an asynchronous when used from PayPage.

*I wish to prepare an order and receive a link that I can mail to a customer, who then will complete the order payment using their card.*

>Create and build the order, then select the card payment method with the `->usePaymentMethod()`, but instead of getting a form with `->getPaymentForm()`, use `->getPaymentUrl()` to get an url to present to the user.

*I wish to set up a subscription using recurring card payments, which will renew each month without further end user interaction.*

>For recurring payments, first create an order and select a card payment method with `->usePaymentMethod()`. Use the `setSubscriptionType()` method on the resulting payment request object. When the end user completes the transaction, you will receive a subscription id in the response.

For the monthly subscription payments, you build the order and again select the card payment method with `->usePaymentMethod()`. Then use `setSubscriptionId()` with the above subscription id and finally send the recur payment request using the `->doRecur()` method.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 4. Payment method reference <a name="i4"></a>
Select payment method to use with the CreateOrderBuilder class useXX() methods, which return an instance of the appropriate payment request class.

### 4.1 Svea Invoice payment <a name="i41"></a>
Select ->useInvoicePayment() to perform an invoice payment.

```php
<?php
...
$order = WebPay::createOrder($config);
$order
    ->addOrderRow( ...                      // required, one or more
    ->addCustomerDetails( ...               // required, individualCustomer or companyCustomer
    ->setCountryCode("SE")                  // required
    ->setOrderDate("2012-12-12")            // required
;
$request = $order->useInvoicePayment();     // requires the above attributes in the order
$response = $request->doRequest();
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CreateOrderBuilder.html" target="_blank">CreateOrderBuilder</a> class for methods used to build the order object and select the payment method type to use.

Another complete, runnable example of an invoice order can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/invoiceorder/" target="_blank">example/invoiceorder</a> folder.

### 4.2 Svea Payment plan payment <a name="i42"></a>
Select ->usePaymentPlanPayment() to perform an invoice payment.

The Payment plan payment method is restricted to individual customers and can not be used by legal entities, i.e. companies or organisations.

First use WebPay::getPaymentPlanParams() to get the various campaigns. Then chose a campaign to pass as parameter to the usePaymentPlanPayment() method.

```php
<?php
...
// fetch all available campaigns from Svea
$campaignsRequest = WebPay::getPaymentPlanParams($config);
$campaignsRequest->setCountryCode("SE");
$campaignsResponse = $campaignsRequest->doRequest();

// we pick the first available campaign from the response
$campaign = $campaignsResponse->campaignCodes[0]->campaignCode;

// create the order
$order = WebPay::createOrder($config);
$order
    ->addOrderRow( ...
    ->addCustomerDetails( ...
    ->setCountryCode("SE")
    ->setOrderDate("2012-12-12")
;

// send the request, using the first available campaign with the payment plan payment method
$request = $order->usePaymentPlanPayment($campaign)
$response = $request->doRequest();
...
```

### 4.3 Card payment <a name="i43"></a>
Select i.e. ->usePaymentMethod(PaymentMethod::KORTCERT) to perform a card payment via the Certitrade card payment provider.

#### 4.3.1 ->getPaymentForm()
Get a html form containing the request XML data. The form is an instance of PaymentForm, and also contains the complete html form as a string along with the form elements in an array.

```php
<?php
...
$form = $order
    ->usePaymentMethod(PaymentMethod::KORTCERT)             // Card payment, get available providers using WebPay::listPaymentMethods()
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->setCardPageLanguage("se")                         // Optional, languageCode As ISO639, eg. "en", default english
        ->getPaymentForm();
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.PaymentForm.html" target="_blank">PaymentForm</a> class for for form methods and attributes.

#### 4.3.2 ->getPaymentUrl()
Get an url containing a link to the prepared payment. To get a payment url you need to supply the customer ip address and language in the order request.

```php
<?php
...
$form = $order

    ->addCustomerDetails(
        ...
        ->setIpAddress()                                    // Required
        ...
    ->usePaymentMethod(PaymentMethod::KORTCERT)             // Card payment, get available providers using WebPay::listPaymentMethods()
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->setCardPageLanguage("se")                         // Required, languageCode As ISO639, eg. "en", default english
        ->getPaymentUrl();
...
```

#### 4.3.3 Recurring card payments
Recurring card payments are set up in two steps. First a card payment including the subscription request, where the customer enters their credentials, and then any subsequent recur payment requests, where the subscription id is used in lieu of customer interaction.

For recurring payments, first create an order and select a card payment method with `->usePaymentMethod()`. Use the `setSubscriptionType()` method on the resulting payment request object. When the end user completes the transaction, you will receive a subscription id in the response.

For the monthly subscription payments, you build the order and again select the card payment method with `->usePaymentMethod()`. Then use `setSubscriptionId()` with the above subscription id and finally send the recur payment request using the `->doRecur()` method.

An example of an recurring card order, both the setup transaction and a recurring payment, can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/cardorder_recur/" target="_blank">example/cardorder_recur</a> folder.

### 4.4 Direct bank payment <a name="i44"></a>
Select i.e. ->usePaymentMethod(PaymentMethod::NORDEA_SE) to perform a direct bank transfer payment using the Swedish bank Nordea.

```php
<?php
...
$form = $order
    ->usePaymentMethod(PaymentMethod::NORDEA_SE)            // Direct bank payment, get available banks using WebPay::listPaymentMethods()
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->setCardPageLanguage("se")                         // Optional, languageCode As ISO639, eg. "en", default english
        ->getPaymentForm();
...
```

### 4.5 Using the Svea PayPage <a name="i45"></a>

#### 4.5.1 Bypassing payment method selection
Go direct to specified payment method, bypassing the *PayPage* completely. By specifying payment method you eliminate one step in the payment process.

You can use `WebPay::listPaymentMethods()` to get the various payment methods available.

```php
<?php
...
$form = $order
    ->usePaymentMethod(PaymentMethod::KORTCERT)             // Use WebPay::listPaymentMethods() to get available payment methods
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->setCardPageLanguage("se")                         // Optional, languageCode As ISO639, eg. "en", default english
        ->getPaymentForm();
...
```

#### 4.5.2 Select a card payment method
Send user to *PayPage* to select from available cards (only), and then perform a card payment at the card payment page.

```php
<?php
...
$form = $order
    ->usePayPageCardOnly()
        ->setPayPageLanguage("sv")                          // Optional, default english
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCallbackUrl("http://myurl.se")                 // Optional
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->setCall("http://myurl.se")                        // Optional
        ->getPaymentForm();
...
```

A complete, runnable example of a card order using PaymentMethodPayment can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/cardorder/" target="_blank">example/cardorder</a> folder.

#### 4.5.3 Select a direct bank payment method
Send user to *PayPage* to select from available banks (only), and then perform a direct bank payment at the chosen bank

```php
<?php
...
$form = $order
    ->usePayPageDirectBankOnly()
        ->setPayPageLanguage("sv")                          // Optional, default english
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->getPaymentForm()
;
...
```

#### 4.5.4 Specifying from available payment methods
Send user to *PayPage* to select from the available payment methods.

```php
<?php
...
$form = $order
    ->usePayPage()
        ->setPayPageLanguage("sv")                          // Optional, defaults to english
        ->setReturnUrl("http://myurl.se")                   // Required
        ->setCancelUrl("http://myurl.se")                   // Optional
        ->getPaymentForm()
;
...
```

You can customise which payment methods to display, using the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.PayPagePayment.html" target="_blank">PayPagePayment</a> methods `includePaymentMethods()`, `excludePaymentMethods()`, `excludeCardPaymentMethods()` and `excludeDirectPaymentMethods()`.

Available payment methods are listed in the PaymentMethod class and the [Appendix](http://sveawebpay.github.io/php-integration#appendix).

### 4.6 Examples <a name="i46"></a>

#### 4.6.1 Svea invoice order
An example of a synchronous (invoice) order can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/invoiceorder/" target="_blank">example/invoiceorder</a> folder.

#### 4.6.2 Card order
An example of an asynchronous card order can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/cardorder/" target="_blank">example/cardorder</a> folder.

#### 4.6.3 Recurring card order
An example of an recurring card order, both the setup transaction and a recurring payment, can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/cardorder_recur/" target="_blank">example/cardorder_recur</a> folder.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 5. WebPayItem reference <a name="i5"></a>
The WebPayItem class provides entrypoint methods to the different row items that make up an order, as well as the customer identity information items.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/WebPayItem.html" target="_blank">WebPayItem</a> class for available order row items.

### 5.1 Specifying item price <a name="i51"></a>
Specify item price using precisely two of these methods in order to specify the item price and tax rate: `setAmountExVat()`, `setAmountIncVat()` and `setVatPercent()`.

If you use `setAmountIncVat()`, note that this may introduce a cumulative rounding error when ordering large quantities of an item, as the package bases the total order sum on a calculated price excluding vat.

### 5.2 WebPayItem::orderRow() <a name="i52"></a>
<!-- WebPayItem::orderRow() docbloc below, replace @see with apidoc links -->
The WebPayItem::orderRow() entrypoint method is used to specify order items like products and services. 
It is required to have a minimum of one order row in an order.

Specify the item price using precisely two of these methods in order to specify the item price and tax rate: 
setAmountExVat(), setAmountIncVat() and setVatPercent(). We recommend using setAmountExVat() and setVatPercentage().

If you use setAmountIncVat(), note that this may introduce a cumulative rounding error when ordering large
quantities of an item, as the package bases the total order sum on a calculated price ex. vat.

```php
<?php
... 
     $orderrow = WebPayItem::orderRow()
         ->setAmountExVat(100.00)        // optional, recommended, use precisely two of the price specification methods
         ->setVatPercent(25)             // optional, recommended, use precisely two of the price specification methods
         ->setAmountIncVat(125.00)       // optional, use precisely two of the price specification methods
         ->setQuantity(2)                // required
         ->setUnit("pcs.")               // optional
         ->setName('name')               // optional, invoice & payment plan orders will merge "name" with "description" 
         ->setDescription("description") // optional, invoice & payment plan orders will merge "name" with "description" 
         ->setArticleNumber("1")         // optional
         ->setDiscountPercent(0)         // optional
     );
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.OrderRow.html" target="_blank">OrderRow</a> class methods for details.

### 5.3 WebPayItem::shippingFee() <a name="i53"></a>
<!-- WebPayItem::shippingFee() docbloc below, replace @see with apidoc links -->

The WebPayItem::shippingFee() entrypoint method is used to specify order shipping fee rows.
It is not required to have a shipping fee row in an order.

Specify the item price using precisely two of these methods in order to specify the item price and tax rate: 
setAmountExVat(), setAmountIncVat() and setVatPercent(). We recommend using setAmountExVat() and setVatPercentage().

```php
<?php
...
     $shippingFee = WebPayItem::shippingFee()
         ->setAmountExVat(100.00)        // optional, recommended, use precisely two of the price specification methods
         ->setVatPercent(25)             // optional, recommended, use precisely two of the price specification methods
         ->setAmountIncVat(125.00)       // optional, use precisely two of the price specification methods
         ->setUnit("pcs.")               // optional
         ->setName('name')               // optional
         ->setDescription("description") // optional
         ->setShippingId('33')           // optional
         ->setDiscountPercent(0)         // optional
     );
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.ShippingFee.html" target="_blank">ShippingFee</a> class methods for details.

### 5.4 WebPayItem::invoiceFee() <a name="i54"></a>
<!-- WebPayItem::invoiceFee() docbloc below, replace @see with apidoc links -->

The WebPayItem::invoiceFee() entrypoint method is used to specify fees associated with a payment method (i.e. invoice fee).
It is not required to have an invoice fee row in an order.

Specify the item price using precisely two of these methods in order to specify the item price and tax rate: 
setAmountExVat(), setAmountIncVat() and setVatPercent(). We recommend using setAmountExVat() and setVatPercentage().

```php
<?php
...
     $invoiceFee = WebPayItem::invoiceFee()
         ->setAmountExVat(100.00)        // optional, recommended, use precisely two of the price specification methods
         ->setVatPercent(25)             // optional, recommended, use precisely two of the price specification methods
         ->setAmountIncVat(125.00)       // optional, use precisely two of the price specification methods
         ->setUnit("pcs.")               // optional
         ->setName('name')               // optional
         ->setDescription("description") // optional
         ->setDiscountPercent(0)         // optional
     );
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.InvoiceFee.html" target="_blank">InvoiceFee</a> class methods for details.

### 5.5 WebPayItem::fixedDiscount() <a name="i55"></a>
Use WebPayItem::fixedDiscount() when the discount or coupon is expressed as a fixed discount amount. 

If no vat rate is given, we calculate the discount split across the order row vat rates present in the order. 
This will ensure that the correct discount vat is applied to the order.

If there are several vat rates present in the order, the discount will be split proportionally across the order row vat 
rates. For examples, including the resulting discount rows, see the test suite file UnitTest/InvoicePaymentTest.php.

Otherwise, it is required to use at least two of the functions setAmountExVat(), setAmountIncVat() and setVatPercent().
If two of these three attributes are specified, we honour the amount indicated and the given discount tax rate.

```php
<?php
...
     $fixedDiscount = WebPayItem::fixedDiscount()
         ->setAmountIncVat(100.00)               // recommended, see info above
         ->setAmountExVat(1.0)                   // optional, see info above
         ->setVatPercent(25)                     // optional, see info above
         ->setDiscountId("1")                    // optional
         ->setUnit("st")                         // optional
         ->setName("Fixed")                      // optional
         ->setDescription("FixedDiscount")       // optional
     );
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.FixedDiscount.html" target="_blank">FixedDiscount</a> class methods for details on how to specify the item.

### 5.6 WebPayItem::relativeDiscount() <a name="i56"></a>
Use WebPayItem::relativeDiscount() when the discount or coupon is expressed as a percentage of the total product amount.

The discount will be calculated based on the total sum of all order rows specified using addOrderRow(), it does not 
apply to invoice or shipping fees. 

If there are several vat rates present in the order, the discount will be split proportionally across the order row vat 
rates. For examples, including the resulting discount rows, see the test suite file UnitTest/InvoicePaymentTest.php.

Specify the discount using RelativeDiscount methods:

```php
<?php
...
    $relativeDiscount = WebPayItem::relativeDiscount()
        ->setDiscountPercent(10.0)          // required
        ->setDiscountId("1")                // optional
        ->setUnit("st.")                    // optional
        ->setName("DiscountName")           // optional
        ->setDescription("DiscountDesc.")   // optional
    );
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.RelativeDiscount.html" target="_blank">RelativeDiscount</a> class methods for details on how to specify the item.

### 5.7 WebPayItem::individualCustomer() <a name="i57"></a>
Read "required" below as a requirement only when the IndividualCustomer is used to identify the customer when using the invoice or payment plan payment methods. (For card and direct bank orders, adding customer information to the order is optional.)

```php
<?php
...
$order->
    addCustomerDetails(
        WebPayItem::individualCustomer()
            ->setNationalIdNumber(194605092222) // required for individual customers in SE, NO, DK, FI
            ->setInitials("SB")                 // required for individual customers in NL
            ->setBirthDate(1923, 12, 20)        // required for individual customers in NL and DE
            ->setName("Tess", "Testson")        // required for individual customers in NL and DE
            ->setStreetAddress("Gatan", 23)     // required in NL and DE
            ->setZipCode(9999)                  // required in NL and DE
            ->setLocality("Stan")               // required in NL and DE
            ->setEmail("test@svea.com")         // optional but desirable
            ->setIpAddress("123.123.123")       // optional but desirable
            ->setCoAddress("c/o Eriksson")      // optional
            ->setPhoneNumber(999999)            // optional
    )
;
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.IndividualCustomer.html" target="_blank">IndividualCustomer</a> class methods for details on how to specify the item, including all *required* methods.

### 5.8 WebPayItem::companyCustomer() <a name="i58"></a>
Read "required" below as a requirement only when the CompanyCustomer is used to identify the customer when using the invoice or payment plan payment methods. (For card and direct bank orders, adding customer information to the order is optional.)

```php
<?php
...
$order->
    addCustomerDetails(
        WebPayItem::companyCustomer()
            ->setNationalIdNumber(2345234)      // required in SE, NO, DK, FI
            ->setVatNumber("NL2345234")         // required in NL and DE
            ->setCompanyName("TestCompagniet")  // required in NL and DE
            ->setStreetAddress("Gatan", 23)     // required in NL and DE
            ->setZipCode(9999)                  // required in NL and DE
            ->setLocality("Stan")               // required in NL and DE
            ->setEmail("test@svea.com")         // optional but desirable
            ->setIpAddress("123.123.123")       // optional but desirable
            ->setCoAddress("c/o Eriksson")      // optional
            ->setPhoneNumber(999999)            // optional
            ->setAddressSelector("7fd7768")     // optional, string recieved from WebPay::getAddress() request
    )
;
...
```

### 5.9 WebPayItem::numberedOrderRow() <a name="i59"></a>
This is an extension of the orderRow class, used in the WebPayAdmin::queryOrder() response and methods that adminster individual order rows.

#### 5.9.1 Usage
```php
<?php
...
$myNumberedOrderRow =
    WebPayItem::numberedOrderRow()

        //inherited from OrderRow
        ->setAmountExVat(100.00)                // recommended to specify price using AmountExVat & VatPercent
        ->setVatPercent(25)                     // recommended to specify price using AmountExVat & VatPercent
        ->setAmountIncVat(125.00)               // optional, need to use two out of three of the price specification methods
        ->setQuantity(2)                        // required
        ->setUnit("st")                         // optional
        ->setName('Prod')                       // optional
        ->setDescription("Specification")       // optional
        ->setArticleNumber("1")                 // optional
        ->setDiscountPercent(0)                 // optional

        //numberedOrderRow
        ->setCreditInvoiceId($creditInvoiceIdAsNumeric)         //optional
        ->setInvoiceId($invoiceIdAsNumeric)                     //optional
        ->setRowNumber($rowNumberAsNumeric)                     //optional
        ->setStatus(NumberedOrderRow::ORDERROWSTATUS_DELIVERED) //optional, one of _DELIVERED, _NOTDELIVERED, _CANCELLED
;
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.NumberedOrderRow.html" target="_blank">NumberedOrderRow</a> class methods for details.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CompanyCustomer.html" target="_blank">CompanyCustomer</a> class methods for details on how to specify the item, including all *required* methods.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 6. WebPay entrypoint method reference <a name="i6"></a>
The WebPay class methods contains the functions needed to create orders and perform payment requests using Svea payment methods. It contains entrypoint methods used to define order contents, send order requests, as well as various support methods needed to do this.

* [6.1 WebPay::createOrder()](http://sveawebpay.github.io/php-integration#i61)
* [6.2 WebPay::deliverOrder()](http://sveawebpay.github.io/php-integration#i62)
* [6.3 WebPay::getAddresses()](http://sveawebpay.github.io/php-integration#i63)
* [6.4 WebPay::getPaymentPlanParams()](http://sveawebpay.github.io/php-integration#i64)
* [6.5 WebPay::paymentPlanPricePerMonth()](http://sveawebpay.github.io/php-integration#i65)
* [6.6 WebPay::listPaymentMethods()](http://sveawebpay.github.io/php-integration#i66)

### 6.1 WebPay::createOrder() <a name="i61"></a>
<!-- WebPay::createOrder() docblock below, replace @see with apidoc links -->

Use WebPay::createOrder() to create an order using invoice, payment plan, card, or direct bank payment methods.

See the CreateOrderBuilder class for more info on methods used to specify the order builder contents
and chosing a payment method to use, followed by sending the request to Svea and parsing the response.

See the CreateOrderBuilder class for more info on methods used to specify the order builder contents
and chosing a payment method to use, followed by sending the request to Svea and parsing the response.

Invoice and Payment plan orders will perform a synchronous payment on doRequest(), and will return a response 
object immediately.

Card, Direct bank, and other hosted methods accessed via PayPage are asynchronous. They provide an html form 
containing a formatted message to send to Svea, which in turn will send a request response to a given return url,
where the response can be parsed using the SveaResponse class.

```php
<?php
...
     $order = WebPay::createOrder($config)
        ->addOrderRow( $orderrow )          // required, see WebPayItem::orderRow
        ->addFee( $shippingfee )            // optional, see WebPayItem for invoice, shipping fee
        ->addDiscount( $discount )          // optional, see WebPayItem for fixed, relative discount
        ->addCustomerDetails( $customer )   // required for invoice and payment plan payments, see WebPayItem for individual, company id.
        ->setCountryCode("SE")              // required
        ->setOrderDate(date('c'))           // required for invoice and payment plan payments
        ->setCurrency("SEK")                // required for card payment, direct bank & PayPage payments. Ignored for invoice and payment plan.
        ->setClientOrderNumber("A123456")   // required for card payment, direct payment, PaymentMethod & PayPage payments, max length 30 chars.
        ->setCustomerReference("att: kgm")  // optional, ignored for card & direct bank orders, max length 30 chars.
     ;
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/WebPayItem.html" target="_blank">WebPayItem</a> class for entrypoint methods used to build order row item and customer identity objects.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CreateOrderBuilder.html" target="_blank">CreateOrderBuilder</a> class for methods used to specify various order attributes and select payment method to use.

### 6.2 WebPay::deliverOrder() <a name="i62"></a>
<!-- WebPay::deliverOrder() docblock below, replace @see with apidoc links -->

Use the WebPay::deliverOrder() entrypoint when you deliver an order to the customer. 
Supports Invoice, Payment Plan and Card orders. (Direct Bank orders are not supported.)

The deliver order request should generally be sent to Svea once the ordered 
items have been sent out, or otherwise delivered, to the customer. 

For invoice and partpayment orders, the deliver order request triggers the 
invoice being sent out to the customer by Svea. (This assumes that your account
has auto-approval of invoices turned on, please contact Svea if unsure). 

For card orders, the deliver order request confirms the card transaction, 
which in turn allows nightly batch processing of the transaction by Svea.  
(Delivering card orders is only needed if your account has auto-confirm
turned off, please contact Svea if unsure.)

To deliver an invoice, partpayment or card order in full, you do not need to 
specify order rows. To partially deliver an order, the recommended way is to
use WebPayAdmin::deliverOrderRows().

For more information on using deliverOrder to partially deliver and/or credit
an order, see 6.2.3 below.
 
Get an order builder instance using the WebPay::deliverOrder entrypoint, then
provide more information about the transaction using DeliverOrderBuilder methods: 

```php
<?php
...
     $request = WebPay::deliverOrder($config)
         ->setOrderId()                  // invoice or payment plan only, required
         ->setTransactionId()            // card only, optional -- you can also use setOrderId
         ->setCountryCode()              // required
         ->setInvoiceDistributionType()  // invoice only, required
         ->setNumberOfCreditDays()       // invoice only, optional
         ->setCaptureDate()              // card only, optional
         ->addOrderRow()                 // deprecated, optional -- use WebPayAdmin::deliverOrderRows instead
         ->setCreditInvoice()            // deprecated, optional -- use WebPayAdmin::creditOrderRows instead
     ;
     // then select the corresponding request class and send request
     $response = $request->deliverInvoiceOrder()->doRequest();       // returns DeliverOrderResult
     $response = $request->deliverPaymentPlanOrder()->doRequest();   // returns DeliverOrderResult
     $response = $request->deliverCardOrder()->doRequest();          // returns ConfirmTransactionResponse
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.DeliverOrderBuilder.html" target="_blank">DeliverOrderBuilder</a> class for methods used to build the order object and select the order type to deliver.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.DeliverOrderResult.html" target="_blank">DeliverOrderResult</a> for invoice and payment plan orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.ConfirmTransactionResponse.html" target="_blank">ConfirmTransactionResponse</a> for card orders response.

#### 6.2.1 Usage
<!-- DeliverOrderBuilder docblock below -->
DeliverOrderBuilder collects and prepares order data for use in a deliver order request to Svea.

Use setOrderId() to specify the Svea order id, this is the order id returned with the original create order request response. For card orders, you can optionally use setTransactionId() instead.

Use setCountryCode() to specify the country code matching the original create order request.

Use setInvoiceDistributionType() with the DistributionType matching how your account is configured to send out invoices. (Please contact Svea if unsure.) 

Use setNumberOfCreditDays() to specify the number of credit days for an invoice.

(Deprecated -- to partially deliver an invoice order, you can specify order rows to deliver using the addOrderRows() method. Use the WebPayAdmin::deliverOrderRows entrypoint instead.)

(Deprecated -- to issue a credit invoice, you can specify credit order rows to deliver using setCreditInvoice() and addOrderRows(). Use the WebPayAdmin::creditOrderRow entrypoint instead.)

To deliver an invoice, partpayment or card order in full, use the WebPay::deliverOrder entrypoint without specifying order rows.

When specifying orderrows, WebPay::deliverOrder is used in a similar way to WebPay::createOrder and makes use of the same order item information. Add order rows that you want delivered and send the request, specified rows will automatically be matched to the rows sent when creating the order. 

We recommend storing the createOrder orderRow objects to ensure that deliverOrder order rows match. If an order row that was present in the createOrder request is not present in from the deliverOrder request, the order will be partially delivered, and any left out items will not be invoiced by Svea. You cannot partially deliver payment plan orders, where all un-cancelled order rows will be delivered.

#### 6.2.2 Example
The following is a minimal example of how to deliver in its entirety an invoice order:

```php
<?php
// Include Svea PHP integration package.
require( "Includes.php" );

// get configuration object holding the Svea service login credentials
$myConfig = Svea\SveaConfig::getTestConfig();

// We assume that you've previously run the firstorder.php file and successfully made a createOrder request to Svea using the invoice payment method.
$mySveaOrderId = "123456";

// Begin the order creation process by creating an order builder object using the WebPay::createOrder() method:
$myOrder = WebPay::deliverOrder( $myConfig );

// We then add information to the order object by using the various methods in the Svea\DeliverOrderBuilder class.

// We begin by adding any additional information required by the payment method, which for an invoice order means:
$myOrder->setCountryCode("SE");
$myOrder->setOrderId( $mySveaOrderId );
$myOrder->setInvoiceDistributionType(\DistributionType::POST);

// We have now completed specifying the order, and wish to send the payment request to Svea. To do so, we first select the invoice payment method:
$myDeliverOrderRequest = $myOrder->deliverInvoiceOrder();

// Then send the request to Svea using the doRequest method, and immediately receive the service response object
$myResponse = $myDeliverOrderRequest->doRequest();
?>
```
The above example can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/firstdeliver/" target="_blank">example/firstdeliver</a> folder.

6.2.3 On using WebPay::deliverOrder with order rows
WebPay::deliverOrder may be used to partially deliver, amend or credit an order, by specifying order rows using the DeliverOrderBuilder addOrderRow() method. We recommend using WebPayAdmin::deliverOrderRows to partially deliver an order and WebPayAdmin::creditOrderRows to credit an order.

6.2.3.1 Partial delivery using WebPay::deliverOrder
When using WebPay::deliverOrder to partially deliver an order, care must be taken that the order rows to deliver precisely match the order row specification used in the original WebPay::createOrder request. Unless all order rows in the deliverOrder request exactly match rows in the original createOrder request, unmatched order rows in the original order will be cancelled. See also x.x.2 Amending an order.

If on the other hand all deliver order rows match with original order rows, then the original order rows matched by the deliver order rows will be invoiced, with the invoice id being returned in the DeliverOrderResponse. The remaining original order rows will remain undelivered and may be delivered in a subsequent deliverOrder request.

```
Example:
1. cResponse = WebPay::createOrder()->addOrderRows(A)->addOrderRows(B)->addOrderRows(C)->...->doRequest();
2. dResponse = WebPay::deliverOrder()->addOrderRows(A)->...->doRequest(); // A matches A
Will result in the order having status
A: delivered	// found on invoice # dResponse->getInvoiceId()
B: undelivered  // may be delivered later
C: undelivered  // may be delivered later
```

6.2.3.2 Amending an order using WebPay::deliverOrder
If you wish to add an order row to an existing order, any original order rows still undelivered will be cancelled to make room for the added order rows within the original order total amount (you may deliver order rows in the same request by adding order rows that exactly match the original order rows).

The exact behaviour is that if there are order rows in the deliver order request that does not match any undelivered original order row, all unmatched and undelivered original order rows are cancelled, and the unmatched deliver order rows are added to the original order as new delivered order rows, given that as the total of all existing delivered rows and the newly added order rows does not exceed the total original order row total amount. This means that the sum of the unmatched (i.e. added) deliver order rows cannot exceed the sum of the cancelled original order rows.

When there are delivered order rows to an amount equal to the original order total amount the order will be closed, preventing further modification. Delivered order rows can only be credited, see x.x.3 below.

```
Example (cont. from x.x.1):
3. dResponse2 = WebPay::deliverOrder()->addOrderRows(D)->...->doRequest(); // D does not match any rows
Will result in the order having status
A: delivered	// found on invoice1; dResponse->getInvoiceId()
B: cancelled  
C: cancelled  
D: delivered	// found on invoice2; dResponse2->getInvoiceId()
```

6.2.3.3 Crediting a (partially) delivered order using WebPay::deliverOrder
To credit an order use the setCreditInvoice(invoiceId) method when delivering an order. Add an order row made out to the amount to be credited to the deliver order request. A credit invoice with the order rows specified will be issued to the customer. 

When crediting a delivered order, you are really crediting an invoice. This means that if you i.e. partially delivered an order, and then need to credit the entire order, you will need to make several crerequests, as a credit invoice amount can't exceed the individual invoice total amount.

The invoice id received will point to the new credit invoice itself, and the original invoice will be be credited at Svea by the specified amount. Note that the original order row status will not change, the as the request operates on the invoice, not the order in itself.

```
Example (cont. from x.x.2):
4. dResponse3 = WebPay::deliverOrder()->addOrderRows(E)->setCreditInvoice(invoice1)...->doRequest(); 
//To credit i.e. 50% of the price for order row A we created a new order row E with half the price of A.
//The credit invoice id is returned in dResponse3->getInvoiceId()
```

### 6.3 WebPay::getAddresses() <a name="i63"></a>
<!-- WebPay::getAddresses() docblock below, replace @see with apidoc links -->
The WebPay::getAddresses() entrypoint is used to fetch validated addresses associated with a given customer identity. Only applicable for SE, NO and DK customers. Note that in Norway, company customers only are supported.

Use getAddresses() to fetch a list of validated addresses associated with a given customer identity. This list can in turn be used to i.e. verify that an order delivery address matches the invoice address used by Svea for invoice and payment plan orders.

Get an request class instance using the WebPay::getAddresses entrypoint, then provide more information about the transaction and send the request using the request class methods:

```php
<?php
...
->setCountryCode()           (required -- supply the country code that corresponds to the account credentials used for the address lookup) 
->setIdentifier()            (required -- i.e. the social security number, company vat number et al for the country in question)

The following methods are deprecated starting with 2.2 of the package
->setIndividual()            (deprecated, -- lookup the address of a private individual, set to i.e. social security number)
->setCompany()               (deprecated -- lookup the addresses associated with a legal entity (i.e. company)
->setOrderTypeInvoice()      (deprecated -- supply the method that corresponds to the account credentials used for the address lookup)
->setOrderTypePaymentPlan()  (deprecated -- supply the method that corresponds to the account credentials used for the address lookup)

Finish by selecting the correct customer type and perform the request:
->getIndividualAddresses() // or getCompanyAddresses()
  ->doRequest()
...
```

The final doRequest() returns a GetAddressesResponse.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.GetAddresses.html" target="_blank">GetAddresses</a> class.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.GetAddressesResponse.html" target="_blank">GetAddressesResponse</a> class.

#### 6.3.1 getAddresses response format
<!-- GetAddresses class docblock below -->
Returns an array of all the associated addresses for a given customer identity. Each address has an AddressSelector attribute that uniquely identifies the address.

The GetAddresses service is only applicable for SE, NO and DK customers and accounts. In Norway, GetAddresses may only be performed on company customers.

Use setCountryCode() to supply the country code that corresponds to the account credentials used for the address lookup. Note that this means that you cannot look up a user in a foreign country, this is a consequence of the fact that the invoice and partpayment methods don't support foreign orders.

Use setCustomerIdentifier() to provide the exact credentials needed to identify the customer according to country:
* SE: Personnummer (private individual) or Organisationsnummer (company or other legal entity)
* NO: Organisasjonsnummer (company or other legal entity)
* DK: Cpr.nr (private individual) or CVR-nummer (company or other legal entity)

Then use either getIndividualAddresses() or getCompanyAddresses() depending on what kind of customer you want to look up.
 
The final doRequest() will send the getAddresses request to Svea and return the result. 

The following methods are deprecated starting with 2.2 of the package:

```php
<?php
...
->setIndividual()                    (deprecated, -- lookup the address of a private individual, set to i.e. social security number)
->setCompany()                       (deprecated -- lookup the addresses associated with a legal entity (i.e. company)
->setOrderTypeInvoice()              (deprecated -- supply the method that corresponds to the account credentials used for the address lookup)
->setOrderTypePaymentPlan()          (deprecated -- supply the method that corresponds to the account credentials used for the address lookup)
...
```

#### 6.3.2 getAddresses request example (new style)
```php
<?php
$response = WebPay::getAddresses( $config )
    ->setCountryCode("SE")                  // Required -- supply the country code that corresponds to the account credentials used
    ->setCustomerIdentifier("194605092222") // Required -- SE individual requires a "personnummer"
    ->getIndividualAddresses()              // Required -- lookup the address of a private individual 
       ->doRequest();                       // Will make a best effort to use whichever is available of invoice or partpayment credentials
;
```

#### 6.3.3 getAddresses request example (old style, deprecated)
```php
<?php
$response = WebPay::getAddresses( $config )
    ->setCountryCode("SE")                  // Required -- supply the country code that corresponds to the account credentials used
    ->setOrderTypeInvoice()                 // Required -- use invoice account credentials for getAddresses lookup
    ->setIndividual("194605092222")         // Required -- lookup the address of a private individual
       ->doRequest();
;
```

An complete usage example can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/config_getaddresses/" target="_blank">example/config_getaddresses</a> folder.

### 6.4 WebPay::getPaymentPlanParams() <a name="i64"></a>
Use getPaymentPlanParams() to fetch all campaigns associated with a given client number before creating the payment plan payment.

```php
<?php
...
$response =
    WebPay::getPaymentPlanParams($config)
        ->setCountryCode("SE")                  // Required
        ->doRequest();
...
```

The response is an instance of WebService\PaymentPlanParamsResponse, with the available campaigns in the array campaignCodes:

```php
<?php
...
    $response->accepted                 // true iff request was accepted by the service
    $response->errormessage             // may be set iff accepted above is false
    $response->resultcode               // 27xxx, reason
    $response->campaignCodes[]          // array of all available campaign payment plans in an array
       ->campaignCode                      // numeric campaign code identifier
       ->description                       // localised description string
       ->paymentPlanType                   // human readable identifier (not guaranteed unique)
       ->contractLengthInMonths
       ->monthlyAnnuityFactor              // pricePerMonth = price * monthlyAnnuityFactor + notificationFee
       ->initialFee
       ->notificationFee
       ->interestRatePercent
       ->numberOfInterestFreeMonths
       ->numberOfPaymentFreeMonths
       ->fromAmount                        // amount lower limit for plan availability
       ->toAmount                          // amount upper limit for plan availability
...
```

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.GetPaymentPlanParams.html" target="_blank">GetPaymentPlanParams</a> and <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.PaymentPlanParamsResponse.html" target="_blank">PaymentPlanParamsResponse</a> classes.


### 6.5 WebPay::paymentPlanPricePerMonth() <a name="i65"></a>
This is a helper function provided to calculate the monthly price for the different payment plan options for a given sum. This information may be used when displaying i.e. payment options to the customer by checkout, or to display the lowest amount due per month to display on a product level.

The returned instance of PaymentPlanPricePerMonth contains an array "values", where each element in turn contains an array of campaign code, description and price per month.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/WebPay.html#method_paymentPlanPricePerMonth" target="_blank">WebPay::paymentPlanPricePerMonth()</a> and the <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.PaymentPlanPricePerMonth.html" target="_blank">PaymentPlanPricePerMonth</a> class.

### 6.6 WebPay::listPaymentMethods() <a name="i66"></a>
The WebPay::listPaymentMethods method is used to fetch all available paymentmethods configured for a given country.

#### 6.6.1
Use the WebPay::listPaymentMethods() entrypoint to get an instance of ListPaymentMethods. Then provide more information about the transaction and
send the request using ListPaymentMethod methods.

```php
<?php
...
   $methods = WebPay::listPaymentMethods( $config )
      ->setCountryCode("SE")      // required
      ->doRequest()
   ;
...
```
Following the ->doRequest call you receive an instance of ListPaymentMethodsResponse.

See the <a href="http://sveawebpay.github.io/php-integration/api/classes/WebPay.html#method_listPaymentMethods" target="_blank">WebPay::listPaymentMethods()</a> and <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.ListPaymentMethodsResponse.html" target="_blank">ListPaymentMethodsResponse</a> classes.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 7. WebPayAdmin entrypoint method reference <a name="i7"></a>
The WebPayAdmin class methods are used to administrate orders after they have been accepted by Svea. It includes functions to update, deliver, cancel and credit orders et.al.

* [7.1 WebPayAdmin::cancelOrder()](http://sveawebpay.github.io/php-integration#i71)
* [7.2 WebPayAdmin::queryOrder()](http://sveawebpay.github.io/php-integration#i72)
* [7.3 WebPayAdmin::cancelOrderRows()](http://sveawebpay.github.io/php-integration#i73)
* [7.4 WebPayAdmin::creditOrderRows()](http://sveawebpay.github.io/php-integration#i74)
* [7.5 WebPayAdmin::addOrderRows()](http://sveawebpay.github.io/php-integration#i75)
* [7.6 WebPayAdmin::updateOrderRows()](http://sveawebpay.github.io/php-integration#i76)
* [7.7 WebPayAdmin::deliverOrderRows()](http://sveawebpay.github.io/php-integration#i77)

### 7.1 WebPayAdmin::cancelOrder() <a name="i71"></a>
The WebPayAdmin::cancelOrder method is used to cancel an order with Svea, that has not yet been delivered (invoice, payment plan) or confirmed (card).

Direct bank orders are not supported, see WebPayAdmin::creditOrder.

CancelOrderBuilder is the class used to cancel an order with Svea, that has
not yet been delivered (invoice, payment plan) or been confirmed (card).

Supports Invoice, Payment Plan and Card orders. For Direct Bank orders, @see
CreditOrderBuilder instead.

Use setOrderId() to specify the Svea order id, this is the order id returned 
with the original create order request response.

Use setCountryCode() to specify the country code matching the original create
order request.

Use either cancelInvoiceOrder(), cancelPaymentPlanOrder or cancelCardOrder,
which ever matches the payment method used in the original order request.
 
The final doRequest() will send the cancelOrder request to Svea, and the 
resulting response object contents holds outcome of the request. 

```php
<?php
...     
    $response = WebPay::cancelOrder($config)
        ->setCountryCode("SE")          // Required. Use same country code as in createOrder request.
        ->setOrderId($orderId)          // Required. Use SveaOrderId received with createOrder response
        ->cancelInvoiceOrder()          // Use the method corresponding to the original createOrder payment method.
        //->cancelPaymentPlanOrder()     
        //->cancelCardOrder()           
             ->doRequest()
    ; 
...
```

#### 7.1.1 Usage
Cancel an undelivered/unconfirmed order. Supports Invoice, PaymentPlan and Card orders. (For Direct Bank orders, see CreditOrder instead.)

The final doRequest() returns either a CloseOrderResult or an AnnulTransactionResponse:

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CancelOrderBuilder.html" target="_blank">CancelOrderBuilder</a> class for methods used to build the order object and select the order type to cancel.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.WebService.CloseOrderResult.html" target="_blank">CloseOrderResult</a> for invoice and payment plan orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.AnnulTransactionResponse.html" target="_blank">AnnulTransactionResponse</a> for card orders response.

#### 7.1.2 Example
```php
<?php
...
    $request =
        WebPay::cancelOrder($config)
            ->setCountryCode("SE")          // Required. Use same country code as in createOrder request.
            ->setOrderId($orderId)          // Required. Use SveaOrderId recieved with createOrder response
            ->cancelInvoiceOrder()          // Use the method corresponding to the original createOrder payment method.
            //->cancelPaymentPlanOrder()
            //->cancelCardOrder()
    ;
    $response = $request->doRequest();      // send request and receive either WebService\CloseOrderResponse or HostedService\AnnulTransactionResponse
...
```

### 7.2 WebPayAdmin::queryOrder() <a name="i72"></a>
The WebPayAdmin::queryOrder entrypoint method is used to get information about an order.

Note that for invoice and payment plan orders, the order rows name and description is merged
into the description field in the query response.

Get an query builder instance using the WebPayAdmin::queryOrder entrypoint, then provide 
more information about the order and send the request using the queryOrderBuilder methods:  

```php
<?php
...
    $request = WebPay::queryOrder($config)
         ->setOrderId()          // required
         ->setCountryCode()      // required      
         ->queryInvoiceOrder()   // select request class and
             ->doRequest()       // perform the request, returns GetOrdersResponse
         
         //->queryPaymentPlanOrder()->doRequest() // returns GetOrdersResponse
         //->queryCardOrder()->doRequest()        // returns QueryTransactionResponse
         //->queryDirectBankOrder()->doRequest()  // returns QueryTransactionResponse
    ;
...
```

The final doRequest() returns either a GetOrdersResponse or an QueryTransactionResponse.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.QueryOrderBuilder.html" target="_blank">QueryOrderBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.GetOrdersResponse.html" target="_blank">GetOrdersResponse</a> for invoice and payment plan orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.QueryTransactionResponse.html" target="_blank">QueryTransactionResponse</a> for card and direct bank orders response.

#### 7.2.1 Usage
QueryOrderBuilder is the class used to query information about an order from Svea.

Use setOrderId() to specify the Svea order id, this is the order id returned 
with the original create order request response as either sveaOrderId or transactionId.

Use setCountryCode() to specify the country code matching the original create
order request.

Then get a request object using either queryInvoiceOrder(), queryPaymentPlanOrder(), 
queryCardOrder(), or queryDirectBankOrder(), which ever matches the payment method 
used in the original order request, and send the query request to svea using the 
request object doRequest() method.

The final doRequest() will send the queryOrder request to Svea, and the 
resulting response code specifies the outcome of the request. 

#### 7.2.2 Example

Example of an order with an order row specified using setName() and setDescription():

```php
<?php
...
$orderRow = WebPayItem::orderRow()
    ...
    ->setName("orderrow 1")                 // optional
    ->setDescription("description 1")       // optional
;   
$order->addOrderRow($orderRow)->useInvoicePayment()->doRequest;
...
```

Querying the above order will result in a response having order rows with the following name and description:

```php 
<?php
...
$queryBuilder = WebPayAdmin::queryOrder($config)
    ->setOrderId($invoiceOrderIdToQuery)
    ->setCountryCode($country)
;
$queryInvoiceOrderResponse = $queryBuilder->queryInvoiceOrder()->doRequest();

$queryInvoiceOrderResponse->name;          // contains null
$queryInvoiceOrderResponse->description;   // contains "orderrad 1: beskrivning 1"
```

whereas a card or direct bank order specified in the same way will have

```php
<?php
...
$queryCardOrderResponse->name;             // contains "orderrad 1"
$queryCardOrderResponse->description;      // contains "beskrivning 1"
```

As you can see, the order row name field is present but always null in the GetOrdersResponse class. This is correct and due to reuse of the existing NumberOrderRow class for the response. The QueryTransactionResponse class has the original name and description in the respective fields.

### 7.3 WebPayAdmin::cancelOrderRows() <a name="i73"></a>
<!-- WebPayAdmin::cancelOrderRows() docblock below, replace @see with apidoc links -->
The WebPayAdmin::cancelOrderRows entrypoint method is used to cancel rows in an order before it has been delivered. Supports Invoice, Payment Plan and Card orders. (Direct Bank orders are not supported, see CreditOrderRows instead.)

Get an order builder instance using the WebPayAdmin::cancelOrderRows entrypoint, then provide more information about the transaction and send the request using the cancelOrderRowsBuilder methods:

```php
<?php
...
->setOrderId()           (required)
->setCountryCode()       (required)
->setRowToCancel()       (required, index of one of the original order row you wish to cancel)
->setRowsToCancel()      (optional)
->addNumberedOrderRow()  (card only, one or more)
->addNumberedOrderRows() (card only, optional)

Finish by selecting the correct ordertype and perform the request:
->cancelInvoiceOrderRows() // or cancelPaymentPlanOrderRows() or cancelCardOrderRows()
  ->doRequest()
...
```

The final doRequest() returns either a CancelOrderRowsResponse or a LowerTransactionResponse.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CancelOrderRowsBuilder.html" target="_blank">CancelOrderRowsBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.CancelOrderRowsResponse.html" target="_blank">CancelOrderRowsResponse</a> for invoice and payment plan orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.LowerTransactionResponse.html" target="_blank">LowerTransactionResponse</a> for card orders response.

#### 7.3.1 Usage
<!-- CancelOrderRowsBuilder class docblock below -->
CancelOrderRowsBuilder is used to cancel individual order rows in a unified manner.

For Invoice and Payment Plan orders, the order row status of the order is updated to reflect the new status of the order rows.

For Card orders, individual order rows will still reflect the status they got in order creation, even if orders have since been cancelled, and the order amount to be charged is simply lowered by sum of the order rows' amount.

Use setOrderId() to specify the Svea order id, this is the order id returned with the original create order request response.

Use setCountryCode() to specify the country code matching the original create order request.

Use setRowToCancel or setRowsToCancel() to specify the order row(s) to cancel. The order numbers should correspond to those returned by i.e. WebPayAdmin::queryOrder;

For card orders, use addNumberedOrderRow() or addNumberedOrderRows() to pass in numbered order rows (from i.e. queryOrder) that will be matched with set rows to cancel.

(You can use the WebPayAdmin::queryOrder() entrypoint to get information about the order, the queryOrder response attribute numberedOrderRows contains the serverside order rows w/numbers. Note: if card order rows has been changed (i.e. credited, cancelled) after initial creation, the returned rows may not be accurate.)

Then use either cancelInvoiceOrderRows(), cancelPaymentPlanOrderRows or cancelCardOrderRows, which ever matches the payment method used in the original order request.
 
The final doRequest() will send the queryOrder request to Svea, and the resulting response code specifies the outcome of the request. 

#### 7.3.2 Example
*example to come later*

### 7.4 WebPayAdmin::creditOrderRows() <a name="i74"></a>
<!-- WebPayAdmin::creditOrderRows() docblock below, replace @see with apidoc links -->
The WebPayAdmin::creditOrderRows entrypoint method is used to credit rows in an order after it has been delivered.
Supports invoice, card and direct bank orders. (To credit a payment plan order, please contact Svea customer service.)

If you wish to credit an amount not present in the original order, use addCreditOrderRow() or addCreditOrderRows() 
and supply a new order row for the amount to credit. This is the recommended way to credit a card or direct bank order.

If you wish to credit an invoice order row in full, you can specify the index of the order row to credit using setRowToCredit(). 
The corresponding order row at Svea will then be credited. (For card or direct bank orders you need to first query and then 
supply the corresponding numbered order rows using the addNumberedOrderRows() method.)

Following the request Svea will issue a credit invoice including the original order rows specified using setRowToCredit(), 
as well as any new credit order rows specified using addCreditOrderRow(). For card or direct bank orders, the order row amount
will be credited to the customer. 

Note: when using addCreditOrderRows, you may only use WebPayItem::orderRow with price specified as amountExVat and vatPercent.

Get an order builder instance using the WebPayAdmin::creditOrderRows entrypoint, then provide more information about the 
transaction and send the request using the creditOrderRowsBuilder methods:

```php
<?php
...
    $request = WebPay::creditOrder($config)
        ->setInvoiceId()                // invoice only, required
        ->setInvoiceDistributionType()  // invoice only, required
        ->setOrderId()                  // card and direct bank only, required
        ->setCountryCode()              // required
        ->addCreditOrderRow()           // optional, use to specify a new credit row, i.e. for amounts not present in the original order
        ->addCreditOrderRows()          // optional
        ->setRowToCredit()              // optional, index of one of the original order row you wish to credit
        ->setRowsToCredit()             // optional
        ->addNumberedOrderRow()         // card and direct bank only, required with setRowToCredit(), recommended to use addCreditOrderRow()
        ->addNumberedOrderRows()        // card and direct bank only, optional
    ;
    // then select the corresponding request class and send request
    $response = $request->creditInvoiceOrderRows()->doRequest();    // returns CreditInvoiceRowsResponse
    $response = $request->creditCardOrderRows()->doRequest();       // returns CreditTransactionResponse
    $response = $request->creditDirectBankOrderRows()->doRequest(); // returns CreditTransactionResponse
...
```

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.CreditOrderRowsBuilder.html" target="_blank">CreditOrderRowsBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.CreditInvoiceRowsResponse.html" target="_blank">CreditInvoiceRowsResponse</a> for invoice orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.CreditTransactionResponse.html" target="_blank">CreditTransactionResponse</a> for card and direct bank orders response.

#### 7.4.1 Usage
<!-- CreditOrderRowsBuilder class docblock below -->
The WebPayAdmin::creditOrderRows entrypoint method is used to credit rows in an order after it has been delivered.
Supports Invoice, Card and Direct Bank orders. (To credit a Payment Plan order, contact Svea customer service.)
 
To credit an order row in full, you specify the index of the order row to 
credit (and for card orders, supply the numbered order row data itself).

If you wish to credit an amount not present in the original order, you need 
to supply new order row(s) for the credited amount using addCreditOrderRow() 
or addCreditOrderRows(). These rows will then be credited in addition to any 
rows specified using setRow(s)ToCredit below.
 
Use setInvoiceId() to specify the invoice (delivered order) to credit. 

Use setOrderId() to specify the card or direct bank transaction (delivered order) to credit.

Use setCountryCode() to specify the country code matching the original create
order request.

Use setRowToCredit() or setRowsToCredit() to specify order rows to credit. 
The given row numbers must correspond with the the serverside row number. 

For card or direct bank orders, it is required to use addNumberedOrderRow() 
or addNumberedOrderRows() to pass in a copy of the serverside order row data.

You can use the WebPayAdmin::queryOrder() entrypoint to get information about the order,
the queryOrder response numberedOrderRows attribute contains the order rows with numbers.
For invoice orders, the serverside order rows is updated after a creditOrderRows request. 
Note that for Card and Direct bank orders the serverside order rows will not be updated.
 
Then use either creditInvoiceOrderRows(), creditCardOrderRows() or 
creditDirectBankOrderRows() to get a request object, which ever matches the 
payment method used in the original order.

Calling doRequest() on the request object will send the request to Svea and 
return either a CreditOrderRowsResponse or a CreditTransactionResponse.

#### 7.4.2 Example
See example/creditorderrows_card folder for an example of how to credit a card order.

### 7.5 WebPayAdmin::addOrderRows() <a name="i75"></a>
The WebPayAdmin::addOrderRows method is used to add individual order rows to non-delivered invoice and payment plan orders.

#### 7.5.1 Usage
Add order rows to an order. Supports Invoice and Payment Plan orders. (Card and Direct Bank orders are not supported.)

Provide information about the new order rows and send the request using addOrderRowsBuilder methods:

```php
<?php
...
->setOrderId()
->setCountryCode()
->addOrderRow() (one or more)
->addOrderRows() (optional)

Finish by selecting the correct ordertype and perform the request:
->addInvoiceOrderRows() | addPaymentPlanOrderRows()
  ->doRequest()
...
```

The final doRequest() returns an AddOrderRowsResponse.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AddOrderRowsBuilder.html" target="_blank">AddOrderRowsBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.AddOrderRowsResponse.html" target="_blank">AddOrderRowsResponse</a> for invoice and payment plan orders response.

#### 7.5.2 Example
*example to come later*

### 7.6 WebPayAdmin::updateOrderRows() <a name="i76"></a>
The `WebPayAdmin::updateOrderRows()` method is used to update individual order rows in non-delivered invoice and payment plan orders.

For Invoice and Payment Plan orders, the order row status of the order is updated to reflect the added order rows. If the updated rows order total exceeds the original order total, an error is returned by the service. 

Use setCountryCode() to specify the country code matching the original create order request.

Use updateOrderRow() or updateOrderRows() to specify the order row(s) to update in the order. The supplied order row numbers must match order rows from the original createOrder request. 

Then use either updateInvoiceOrderRows() or updatePaymentPlanOrderRows(), which ever matches the payment method used in the original order request.

The final doRequest() will send the updateOrderRows request to Svea, and the resulting response code specifies the outcome of the request. 

#### 7.6.1 Usage
Update order rows in a non-delivered invoice or payment plan order. (Card and Direct Bank orders are not supported.)

Provide information about the updated order rows and send the request using updateOrderRowsBuilder methods:

```php
<?php
...
->setOrderId()
->setCountryCode()
->updateOrderRow() (one or more)
->updateOrderRows() (optional)

Finish by selecting the correct ordertype and perform the request:
->updateInvoiceOrderRows() | updatePaymentPlanOrderRows()
  ->doRequest()
...
```

The final doRequest() returns an UpdateOrderRowsResponse.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.UpdateOrderRowsBuilder.html" target="_blank">UpdateOrderRowsBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.UpdateOrderRowsResponse.html" target="_blank">UpdateOrderRowsResponse</a> for invoice and payment plan orders response.

#### 7.6.2 Example
*example to come later*

### 7.7 WebPayAdmin::deliverOrderRows() <a name="i77"></a>
<!-- WebPayAdmin::deliverOrderRows() docblock below, replace @see with apidoc links -->
The WebPayAdmin::deliverOrderRows entrypoint method is used to deliver individual order rows. Supports invoice and card orders. (To partially deliver PaymentPlan or Direct Bank orders, please contact Svea.)

Get an order builder instance using the WebPayAdmin::deliverOrderRows entrypoint, then provide more information about the transaction and send the request using the deliverOrderRowsBuilder methods:

```php
<?php
... 
->setOrderId()           (invoice, card only, required)
->setCountryCode()       (invoice only, required)
->setRowToDeliver()      (required, index of one of the original order row you wish to cancel)
->setRowsToDeliver()     (optional)
->addNumberedOrderRow()  (card only, one or more, required with setRow(s)ToDeliver)
->addNumberedOrderRows() (card only, optional)

Finish by selecting the correct ordertype and perform the request:
->deliverInvoiceOrderRows() // or ->deliverCardOrderRows()
  ->doRequest()
... 
```

The final doRequest() returns a DeliverOrderRowsResponse or ConfirmTransactionResponse.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.DeliverOrderRowsBuilder.html" target="_blank">CreditOrderRowsBuilder</a> method details.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.HostedService.ConfirmTransactionResponse.html" target="_blank">ConfirmTransactionResponse</a> for card orders response.

See <a href="http://sveawebpay.github.io/php-integration/api/classes/Svea.AdminService.DeliverOrderRowsResponse.html" target="_blank">DeliverOrderRowsResponse</a> for invoice orders response.

#### 7.7.1 Usage
<!-- DeliverOrderRowsBuilder class docblock below -->
The WebPayAdmin::deliverOrderRows entrypoint method is used to partially deliver an order. Supports Invoice and Card orders. (To partially deliver a Payment Plan or Direct Bank order, contact Svea customer service.)

To deliver an order row in full, you specify the index of the order row to credit (and for card orders, supply the numbered order row data itself).
 
Use setOrderId() to specify the card or direct bank transaction (delivered order) to credit.

Use setCountryCode() to specify the country code matching the original create order request.

Use setRowToDeliver() or setRowsToDeliver() to specify order rows to deliver. The given row numbers must correspond with the serverside row numbers. 

For card orders, the rows must match order rows specified using addNumberedOrderRow() or addNumberedOrderRows().

For invoice orders, the serverside order rows is updated after a deliverOrderRows request. Note that for Card and  orders the serverside order rows will not be updated.

For card orders, it is required to use addNumberedOrderRow() or addNumberedOrderRows() to pass in a copy of the serverside order row data. All order rows must be supplied.

You can use the WebPayAdmin::queryOrder() entrypoint to get information about the order, the QueryOrderResponse->numberedOrderRows attribute contains the order rows, but note that if the order has been modified after creation these may not be accurate.

Then use deliverInvoiceOrderRows() or deliver CardOrderRows to get a request object, which ever matches the payment method used in the original order. deliverCardOrderRows Calculates the correct amount to deliver from supplied order rows and when followed by a a ->doRequest() call performs a LowerTransaction followed by a ConfirmTransaction. Note that the card transaction must have status AUTHORIZED at Svea in order to be delivered.

Calling doRequest() on the request object will send the request to Svea and return either a CreditOrderRowsResponse or a CreditTransactionResponse.

#### 7.7.2 Example
*example to come later*

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 8. SveaResponse and response classes <a name="i8"></a>

### 8.1. Parsing an asynchronous service response <a name="i81"></a>
All synchronous service request responses are parsed by *SveaResponse* and structured into response objects by the request method itself. You do not need to invoke the SveaResponse object to for synchronous service requests.

Asynchronous payment request responses (i.e. card and direct bank payments) need to be processed from the page listening to posts on the specified request return url. The response contains the parameters: *response*, *merchantid*, and *mac*, where the response is a Base64 encoded message. Use an instance of the SveaResponse class to instead get a structured object similar to the synchronous service responses.

#### 8.1.1
First, create an instance of SveaResponse, pass it the resulting xml response as part of the $_REQUEST response along with the a ConfigurationProvider and countryCode, then receive a HostedResponse instance by calling the getResponse() method, passing in the message sent to the return url, the request countrycode and configuration. An example of how to process the response received in the $_REQUEST superglobal:

```php
<?php
...
  $response = (new SveaResponse($_REQUEST,$countryCode,$config))->getResponse();
...
```

#### 8.1.2
An example of an asynchronous (card) order can be found in the <a href="http://github.com/sveawebpay/php-integration/blob/master/example/cardorder/" target="_blank">example/cardorder</a> folder.

### 8.2 Response accepted and result code <a name="i82"></a>
In the integration package all service response objects implement the following attributes, that may be checked to determine the outcome of a request:

* `accepted`      -- if set to logical true if the request was accepted by Svea
* `resultcode`    -- if set to a value >0, indicates a problem with the service request
* `errormessage`  -- a human readable version of the resultcode, only set if resultcode >0

As the request responses from the various Svea webservices varies in implementation, we strongly suggest i.e. checking the "accepted" attribute for logical truth instead of checking if it holds a particular value or type. I.e. use: "if( $response->accepted == true )" instead of ~~"if( $response->accepted === 1)"~~ or ~~"if( $response->accepted > 0)"~~ etc.

See the respective response classes for further information on response attributes, possible resultcodes etc.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 9. Additional Developer Resources and notes <a name="i9"></a>

### 9.1 Helper class methods <a name="i91"></a>
In the Helper class we make available helper functions for i.e. bankers rounding, splitting a sum with an arbitrary tax rate over two fixed tax rates, as well as splitting street addresses into streetname and housenumber. See the Helper class definition for further information.

### 9.2 Inspect prepareRequest(), validateOrder() methods <a name="i92"></a>
During module development or debugging, the `prepareRequest()` method may be of use as an alternative to `doRequest()` as the final step in the createOrder process.

`prepareRequest()` will do everything `doRequest()` does, but does not send the SOAP request to Svea. Call `prepareRequest()` and then inspect the contents of the request to be sent to Svea. The

`validateOrder()` validates that all required attributes are present in an order object, give the specific combination of country and payment method. It returns an array containing any discovered errors.

[<< To index](http://sveawebpay.github.io/php-integration#index)

## 10. Frequently Asked Questions <a name="i10"></a>

### 10.1 Supported currencies <a name="i101"></a>
**Q**: What currencies does each payment method support?

**A**:
*Invoice and part payment*
For invoice and direct bank payment methods, the assumed currency is tied to the merchant account (client id), where each account in turn is tied to a specific country. This is why you as the merchant need to specify a country code in the order, and must supply the amount in the corresponding currency (i.e. an invoice order with setCountryCode('SE') is always assumed to be made out in SEK).

*Credit card and direct bank transfer*
For credit card orders, Svea accepts any currency when specifying the order, and pass the currency and amount on the card Acquirer (Svea uses Certitrade) where the end user enters their account credentials.

The acquirer in turn asks (via the credit card company) the end user's Issuing bank (i.e. the bank that provides the end user their card) if the transaction is accepted. If so this information is passed on to the merchant via the Acquirer and Svea, and this is the end of the story as far as the end user is concerned.

The merchant, i.e. your web shop, then receives money from their Acquiring bank. This is usually done nightly, when the acquiring bank (via the credit card company) receives a list of confirmed card transactions for the merchant in question, and pays the merchant accordingly.

*Acquiring bank support*
The key point is that the merchant must have an agreement with their acquiring bank as to which currencies they accept. Svea has no way of knowing this, so it is up to the merchant to supply the correct currency in the original request.

*tl;dr*
For invoice and part payment, the order amount is assumed to be made out in the country currency. For credit card and direct bank transfer, we honour the specified currency and amount, but you should only specify currencies that you have agreed upon with your acquiring bank.

## APPENDIX <a name="appendix"></a>

### PaymentMethods
Used in usePaymentMethod($paymentMethod) and in usePayPage()->includePaymentMethods(..., ..., ...) et al.

| Payment method                    | Description                                   |
|-----------------------------------|-----------------------------------------------|
| PaymentMethod::BANKAXESS          | Direct bank payments, Norway                  |
| PaymentMethod::NORDEA_SE          | Direct bank payment, Nordea, Sweden.          |
| PaymentMethod::SEB_SE             | Direct bank payment, private, SEB, Sweden.    |
| PaymentMethod::SEBFTG_SE          | Direct bank payment, company, SEB, Sweden.    |
| PaymentMethod::SHB_SE             | Direct bank payment, Handelsbanken, Sweden.   |
| PaymentMethod::SWEDBANK_SE        | Direct bank payment, Swedbank, Sweden.        |
| PaymentMethod::KORTCERT           | Card payments, Certitrade.                    |
| PaymentMethod::PAYPAL             | Paypal                                        |
| PaymentMethod::SKRILL             | Card payment with Dankort, Skrill.            |
| PaymentMethod::INVOICE            | Invoice by PayPage.                           |
| PaymentMethod::PAYMENTPLAN        | PaymentPlan by PayPage.                       |

[<< To top](http://sveawebpay.github.io/php-integration#index)
