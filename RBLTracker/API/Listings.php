<?php 

//    
// This file is part of the RBLTracker PHP Wrapper package.
//   
// (c) Mike Pultz <mike@mikepultz.com>        
//
// For the full copyright and license information, please view the LICENSE
// file that was distributed with this source code.
//

namespace RBLTracker\API;

use RBLTracker\Exceptions\RBLTrackerException;

class Listings
{
    use RequestHandler;

    //
    // constructor to copy over the client details
    //
    public function __construct(\RBLTracker\Client $_client)
    {
        $this->init($_client);
    }

    //
    // get a listings object of hosts
    //
    public function get(array $_settings = null)
    {
        return $this->_get('listings', $_settings);
    }
}
