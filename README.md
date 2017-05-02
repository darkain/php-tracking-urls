# PHP Package Tracking URL Library
[![Build Status](https://travis-ci.org/darkain/php-tracking-urls.svg?branch=master)](https://travis-ci.org/darkain/php-tracking-urls)


## About
PHP Package Tracking URL Library is used to convert package tracking numbers
into their respective shipper's online tracking URL format.

Supported shippers:
* United States Postal Service (USPS)
* United Parcel Service (UPS)
* Federal Express (FedEx)
* OnTrac
* DHL


## License
This software library is licensed under the BSD 2-clause license, and may be
freely used in any project which is compatible with this license.


## Example
Usage:
```php
$tracking = '1Z9999W99999999999';
$url = get_tracking_url($tracking);
echo $url;
```

Output:
```
http://wwwapps.ups.com/WebTracking/processInputRequest?TypeOfInquiryNumber=T&InquiryNumber1=1Z9999W99999999999
```


