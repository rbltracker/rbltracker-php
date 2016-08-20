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
    public function __construct($_api_token)
    {
        $this->api_token($_api_token);
    }

    //
    // get a single contact by id
    //
    public function get($_contact_id)
    {
        return $this->_get('contact', array('id' => $_contact_id));
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
    public function update($_contact_id, array $_settings)
    {
        return $this->_post('contact/update', array_merge(array('id' => $_contact_id), $_settings));
    }

    //
    // delete a contact by id
    //
    public function delete($_contact_id)
    {
        return $this->_post('contact/delete', array('id' => $_contact_id));
    }

    //
    // pause a contact by id
    //
    public function pause($_contact_id)
    {
        return $this->_post('contact/pause', array('id' => $_contact_id));
    }

    //
    // resume (un-pause) a contact by id
    //
    public function resume($_contact_id)
    {
        return $this->_post('contact/resume', array('id' => $_contact_id));
    }

    //
    // resend and authorization code for a contact by id
    //
    public function resend($_contact_id)
    {
        return $this->_post('contact/resend', array('id' => $_contact_id));
    }

    //
    // confirm a contact by id
    //
    public function confirm($_contact_id, $_auth_code)
    {
        return $this->_post('contact/confirm', array('id' => $_contact_id, 'authcode' => $_auth_code));
    }
}
