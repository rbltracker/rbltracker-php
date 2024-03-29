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

final class Contact
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
    // get a single contact by id
    //
    public function get(string $_object_id): array
    {
        return $this->_get('contact/' . $_object_id);
    }

    //
    // create a contact
    //
    public function add(array $_settings): array
    {
        return $this->_post('contact/add', $_settings);
    }

    //
    // update a contact
    //
    public function update(string $_object_id, array $_settings): array
    {
        return $this->_post('contact/update/' . $_object_id, $_settings);
    }

    //
    // delete a contact by id
    //
    public function delete(string $_object_id): array
    {
        return $this->_post('contact/delete/' . $_object_id);
    }

    //
    // pause a contact by id
    //
    public function pause(string $_object_id): array
    {
        return $this->_post('contact/pause/' . $_object_id);
    }

    //
    // resume (un-pause) a contact by id
    //
    public function resume(string $_object_id): array
    {
        return $this->_post('contact/resume/' . $_object_id);
    }

    //
    // resend and authorization code for a contact by id
    //
    public function resend(string $_object_id): array
    {
        return $this->_post('contact/resend/' . $_object_id);
    }

    //
    // confirm a contact by id
    //
    public function confirm(string $_object_id, string $_auth_code): array
    {
        return $this->_post('contact/confirm/' . $_object_id, [ 'authcode' => $_auth_code ]);
    }
}
