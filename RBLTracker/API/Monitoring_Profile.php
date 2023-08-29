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

final class Monitoring_Profile
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
    // get a single monitoring profile by id
    //
    public function get(string $_object_id): array
    {
        return $this->_get('monitoringprofile/' . $_object_id);
    }

    //
    // create a monitoring profile
    //
    public function add(array $_settings): array
    {
        return $this->_post('monitoringprofile/add', $_settings);
    }

    //
    // update a monitoring profile
    //
    public function update(string $_object_id, array $_settings): array
    {
        return $this->_post('monitoringprofile/update/' . $_object_id, $_settings);
    }

    //
    // delete a monitoring profile by id
    //
    public function delete(string $_object_id): array
    {
        return $this->_post('monitoringprofile/delete/' . $_object_id);
    }
}
