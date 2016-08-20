## Installation

You can install **rbltracker-php** via composer or by downloading the source.

#### Via Composer:

**rbltracker-php** is available on Packagist as the
[`rbltracker/sdk`](https://packagist.org/packages/rbltracker/sdk) package.

## Quickstart

### Get a list of hosts on your account

```php
<?php

$client = new RBLTracker\Client(< RBLTracker API Token');

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
    [total_hosts] => 8
    [total_listed] => 0
    [page] => 2
    [total_pages] => 2
    [page_size] => 5
    [data] => Array
        (
            [0] => Array
                (
                    [id] => HTa370ecd34e7d9eb124d1b3617afafaf8
                    [host] => fonolo.com
                    [name] => Fonolo
                    [type] => uribl
                    [parent] => 
                    [status] => active
                    [last_checked] => 2016-07-20 09:02:18 EDT
                    [first_blocked] => 
                    [first_listed] => 
                    [block_period] => 
                    [listed_period] => 
                    [blocked] => 0
                    [listed] => 0
                    [listed_count] => 0
                    [listed_details] => Array
                        (
                        )

                )

            [1] => Array
                (
                    [id] => HTf4e4796f608db1e3edf95c4bc19b3fc9
                    [host] => mrhost.ca
                    [name] => Mr.Host Website
                    [type] => uribl
                    [parent] => 
                    [status] => active
                    [last_checked] => 2016-07-20 09:00:59 EDT
                    [first_blocked] => 
                    [first_listed] => 
                    [block_period] => 
                    [listed_period] => 
                    [blocked] => 0
                    [listed] => 0
                    [listed_count] => 0
                    [listed_details] => Array
                        (
                        )

                )

            [2] => Array
                (
                    [id] => HTbd7fe63ba673506575158fdd7a7d33b9
                    [host] => rbltracker.com
                    [name] => RBLTracker Site
                    [type] => uribl
                    [parent] => 
                    [status] => active
                    [last_checked] => 2016-07-20 09:01:23 EDT
                    [first_blocked] => 
                    [first_listed] => 
                    [block_period] => 
                    [listed_period] => 
                    [blocked] => 0
                    [listed] => 0
                    [listed_count] => 0
                    [listed_details] => Array
                        (
                        )

                )

        )

    [version] => 3.1
)

```

## Documentation

The documentation for the RBLTracker API can be found in your RBLTracker account.

## Prerequisites

* PHP >= 5.4
* The PHP JSON extension
