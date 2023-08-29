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

final class Host
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
    // get a single host by id
    //
    public function get(string $_object_id): array
    {
        return $this->_get('host/' . $_object_id);
    }

    //
    // create a host
    //
    public function add(array $_settings): array
    {
        return $this->_post('host/add', $_settings);
    }

    //
    // update a host
    //
    public function update(string $_object_id, array $_settings): array
    {
        return $this->_post('host/update/' . $_object_id, $_settings);
    }

    //
    // delete a host by id
    //
    public function delete(string $_object_id): array
    {
        return $this->_post('host/delete/' . $_object_id);
    }

    //
    // pause a host by id
    //
    public function pause(string $_object_id): array
    {
        return $this->_post('host/pause/' . $_object_id);
    }

    //
    // resume (un-pause) a host by id
    //
    public function resume(string $_object_id): array
    {
        return $this->_post('host/resume/' . $_object_id);
    }
}
