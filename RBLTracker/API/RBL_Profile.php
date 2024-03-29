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

final class RBL_Profile
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
    // get a single rbl profile by id
    //
    public function get(string $_object_id): array
    {
        return $this->_get('rblprofile/' . $_object_id);
    }

    //
    // create a rbl profile
    //
    public function add(array $_settings): array
    {
        return $this->_post('rblprofile/add', $_settings);
    }

    //
    // update a rbl profile
    //
    public function update(string $_object_id, array $_settings): array
    {
        return $this->_post('rblprofile/update/' . $_object_id, $_settings);
    }

    //
    // delete a rbl profile by id
    //
    public function delete(string $_object_id): array
    {
        return $this->_post('rblprofile/delete/' . $_object_id);
    }
}
