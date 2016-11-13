## Installation

You can install **rbltracker-php** via composer or by downloading the source.

#### Via Composer:

**rbltracker-php** is available on Packagist as the
[`rbltracker/sdk`](https://packagist.org/packages/rbltracker/sdk) package.

## Quickstart

### Get a list of hosts on your account

```php
<?php

$client = new RBLTracker\Client('your_account_sid', 'your_auth_token');

try
{
    $hosts = $client->hosts->get(array('page_size' => 5, 'page' => 2));

    print_r($hosts);

} catch(RBLTracker\Exceptions\RBLTrackerException $e)
{
    echo $e->getMessage();
}

?>
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

The documentation for the RBLTracker API can be found in your RBLTracker account.

## Prerequisites

* PHP >= 5.4
* The PHP JSON extension
