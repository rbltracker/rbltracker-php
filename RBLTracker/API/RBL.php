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

final class RBL
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
    // get a single rbl by id
    //
    public function get(string $_object_id): array
    {
        return $this->_get('rbl/' . $_object_id);
    }

    //
    // create an rbl
    //
    public function add(array $_settings): array
    {
        return $this->_post('rbl/add', $_settings);
    }

    //
    // update an rbl
    //
    public function update(string $_object_id, array $_settings): array
    {
        return $this->_post('rbl/update/' . $_object_id, $_settings);
    }

    //
    // delete an rbl by id
    //
    public function delete(string $_object_id): array
    {
        return $this->_post('rbl/delete/' . $_object_id);
    }

    //
    // pause an rbl by id
    //
    public function pause(string $_object_id): array
    {
        return $this->_post('rbl/pause/' . $_object_id);
    }

    //
    // resume (un-pause) an rbl by id
    //
    public function resume(string $_object_id): array
    {
        return $this->_post('rbl/resume/' . $_object_id);
    }
}
