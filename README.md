PHP Package Tracking URL Library

This software library is licenced under the BSD 3-clause license, and may be
freely used in any project which is compatible with this license. 

Please see the examples folder for information on how to implment this library


---


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


---


This library is used to convert package tracking numbers into their respective
shipper's online tracking URL format. 

Supported shippers:
* United States Postal Service (USPS)
* United Parcel Service (UPS)
* Federal Express (FedEx)
* OnTrac
