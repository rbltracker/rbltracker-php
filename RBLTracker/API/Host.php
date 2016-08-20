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

class Host
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
    // get a single host by id
    //
    public function get($_host_id)
    {
        return $this->_get('host', array('id' => $_host_id));
    }

    //
    // create a host
    //
    public function add(array $_settings)
    {
        return $this->_post('host/add', $_settings);
    }

    //
    // update a host
    //
    public function update($_host_id, array $_settings)
    {
        return $this->_post('host/update', array_merge(array('id' => $_host_id), $_settings));
    }

    //
    // delete a host by id
    //
    public function delete($_host_id)
    {
        return $this->_post('host/delete', array('id' => $_host_id));
    }

    //
    // pause a host by id
    //
    public function pause($_host_id)
    {
        return $this->_post('host/pause', array('id' => $_host_id));
    }

    //
    // resume (un-pause) a host by id
    //
    public function resume($_host_id)
    {
        return $this->_post('host/resume', array('id' => $_host_id));
    }
}
