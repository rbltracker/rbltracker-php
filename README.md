<a href="https://rbltracker.com" target="_blank"><img src="https://rbltracker.com/portal/static/3.4/images/rbl_logo_front.png"/></a>

[Sign up][rbltracker sign up] for a RBLTracker account and visit our [developer site][rbltracker dev site] for even more details.

# PHP Client Library

The official PHP binding for your RBLTracker service.

## Prerequisites

Before using this library, you must have:

* A RBLTracker Account, [sign up for a new account][rbltracker sign up] or [login to RBLTracker](https://rbltracker.com/portal/login/)
* a valid RBLTracker account SID and auth token, available from the [RBLTracker Portal](https://rbltracker.com/portal/login/)
* PHP >= 5.4
* The PHP JSON extension

## Installation

```
composer require rbltracker/sdk
```

## Quickstart

### Get a list of hosts on your account

```php
<?php

$client = new RBLTracker\Client('your_account_sid', 'your_auth_token');

try
{
    $hosts = $client->hosts->get([ 'page_size' => 5, 'page' => 2 ]);

    print_r($hosts);

} catch(RBLTracker\Exceptions\RBLTrackerException $e)
{
    echo $e->getMessage();
}

```

That will output a PHP array that looks like this:

```
Array
(
    [status_code] => 200
    [status_message] => Ok
    [total_hosts] => 1
    [total_listed] => 1
    [page] => 1
    [total_pages] => 1
    [page_size] => 20
    [data] => Array
        (
            [0] => Array
                (
                    [id] => HTee06c4fa7c23aa8a3a4e8d66922b0834
                    [host] => bad-url.com
                    [name] => bad-url.com
                    [type] => uribl
                    [parent] => 
                    [status] => active
                    [rbl_profile] => RP15d4e891d784977cacbfcbb00c48f133
                    [contact_group] => CGd3dca251d33135e0a518d7c49b89dc61
                    [last_checked] => 2016-11-07 21:01:33 EST
                    [first_listed] => 2016-11-06 10:14:58 EST
                    [listed_period] => 1 day 11:37:51
                    [listed] => 1
                    [listed_count] => 1
                    [listed_details] => Array
                        (
                            [0] => Array
                                (
                                    [host] => Google Safe Browsing
                                    [website] => 
                                    [details] => Malware (Virus) on Windows
                                )
                        )
                )
        )
    [version] => 3.4
)
```

## Documentation

Full API documentation is available from the [RBLTracker developer site.][rbltracker dev site]

## Release History

### v1.0.3
* fixed a typo in RBLTrackerException.php where it was using short open tags.
* changed array() instances to [].
* updated classes to use the final keyword.

### v1.0.2
* updated to support the RBLTracker API v3.6
* added manual RBL check support.
* refactored the code layout to make it easier to override the URL for testing.

### v1.0.1
* updated to support the RBLTracker API v3.4.

### v1.0.0
* Initial release.

[rbltracker sign up]:   https://rbltracker.com/portal/signup/
[rbltracker dev site]:  https://rbltracker.com/docs/api/
