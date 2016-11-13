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

class Contact
{
    use RequestHandler;

    //
    // constructor to copy over the API key
    //
    public function __construct($_account_sid, $_api_token)
    {
        $this->auth($_account_sid, $_api_token);
    }

    //
    // get a single contact by id
    //
    public function get($_object_id)
    {
        return $this->_get('contact/' . $_object_id);
    }

    //
    // create a contact
    //
    public function add(array $_settings)
    {
        return $this->_post('contact/add', $_settings);
    }

    //
    // update a contact
    //
    public function update($_object_id, array $_settings)
    {
        return $this->_post('contact/update/' . $_object_id, $_settings);
    }

    //
    // delete a contact by id
    //
    public function delete($_object_id)
    {
        return $this->_post('contact/delete/' . $_object_id);
    }

    //
    // pause a contact by id
    //
    public function pause($_object_id)
    {
        return $this->_post('contact/pause/' . $_object_id);
    }

    //
    // resume (un-pause) a contact by id
    //
    public function resume($_object_id)
    {
        return $this->_post('contact/resume/' . $_object_id);
    }

    //
    // resend and authorization code for a contact by id
    //
    public function resend($_object_id)
    {
        return $this->_post('contact/resend/' . $_object_id);
    }

    //
    // confirm a contact by id
    //
    public function confirm($_object_id, $_auth_code)
    {
        return $this->_post('contact/confirm/' . $_object_id, array('authcode' => $_auth_code));
    }
}
