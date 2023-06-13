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

final class Contact_Group
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
    // get a single contact group by id
    //
    public function get($_object_id)
    {
        return $this->_get('contactgroup/' . $_object_id);
    }

    //
    // create a contact group
    //
    public function add(array $_settings)
    {
        return $this->_post('contactgroup/add', $_settings);
    }

    //
    // update a contact group
    //
    public function update($_object_id, array $_settings)
    {
        return $this->_post('contactgroup/update/' . $_object_id, $_settings);
    }

    //
    // delete a contact group by id
    //
    public function delete($_object_id)
    {
        return $this->_post('contactgroup/delete/' . $_object_id);
    }
}
