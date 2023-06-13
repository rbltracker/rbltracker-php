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

final class Check
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
    // start a new check request
    //
    public function start(array $_settings)
    {
        return $this->_post('check/start', $_settings);
    }

    //
    // get the current status of the check
    //
    public function status($_object_id, array $_args = null)
    {
        return $this->_get('check/status/' . $_object_id, $_args);
    }
}
