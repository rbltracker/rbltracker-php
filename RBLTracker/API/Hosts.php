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

class Hosts
{
    use RequestHandler;

    //
    // constructor to copy over the API key
    //
    public function __construct($_api_token)
    {
        $this->api_token($_api_token);
    }

    //
    // get a list of hosts
    //
    public function get(array $_settings = null)
    {
        return $this->_get('hosts', $_settings);
    }
}
