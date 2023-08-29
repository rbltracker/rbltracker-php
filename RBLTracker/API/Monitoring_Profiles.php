<?php declare(strict_types=1);

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

final class Monitoring_Profiles
{
    use RequestHandler;

    //
    // constructor to copy over the API key
    //
    public function __construct(\RBLTracker\Client $_client)
    {
        $this->init($_client);
    }

    //
    // get a list of monitoring profiles
    //
    public function get(?array $_settings = null): array
    {
        return $this->_get('monitoringprofiles', $_settings);
    }
}
