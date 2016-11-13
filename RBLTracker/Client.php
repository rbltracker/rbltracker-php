<?php

//
// This file is part of the RBLTracker PHP Wrapper package.
//
// (c) Mike Pultz <mike@mikepultz.com>
//
// For the full copyright and license information, please view the LICENSE
// file that was distributed with this source code.
//

namespace RBLTracker;

use RBLTracker\Exceptions\RBLTrackerException;

//
// register the autoloader
//
spl_autoload_register('RBLTracker\Client::autoload');

class Client
{
    //
    // PHP SDK version
    //
    const VERSION = '1.0.1';

    //
    // the API key
    //
    protected $m_account_sid = null;
    protected $m_api_token = null;

    //
    // init the object and set the API token
    //
    public function __construct($_account_sid, $_api_token)
    {
        //
        // validate the key
        //
        if (preg_match('/^[A-Z]{2}[0-9a-f]{32}$/', $_account_sid) == 0)
        {
            throw new RBLTrackerException('invalid API acount sid provided.');
        }
        if (preg_match('/^[0-9a-f]{64}$/', $_api_token) == 0)
        {
            throw new RBLTrackerException('invalid API access token provided.');
        }

        $this->m_account_sid    = $_account_sid;
        $this->m_api_token      = $_api_token;
    }

    //
    // autoloader
    //
    static public function autoload($_name)
    {
        if (strncmp($_name, 'RBLTracker', 10) == 0)
        {
            require_once str_replace('\\', '/', $_name) . '.php';
        }
    }

    //
    // call a resouce by name
    //
    public function __get($_name)
    {
        $method = 'get_' . strtolower($_name);

        if (method_exists($this, $method) == false)
        {
            throw new RBLTrackerException('invalid resource ' . $_name);
        }

        return $this->$method();
    }

    //
    // return a listings object- just a host list
    //
    public function get_listings()
    {
        return new API\Listings($this->m_account_sid, $this->m_api_token);
    }
    
    //
    // return a host or hosts object
    //
    public function get_host()
    {
        return new API\Host($this->m_account_sid, $this->m_api_token);
    }
    public function get_hosts()
    {
        return new API\Hosts($this->m_account_sid, $this->m_api_token);
    }

    //
    // return a contact or contacts object
    //
    public function get_contact()
    {
        return new API\Contact($this->m_account_sid, $this->m_api_token);
    }
    public function get_contacts()
    {
        return new API\Contacts($this->m_account_sid, $this->m_api_token);
    }

    //
    // return a rbl or rbls object
    //
    public function get_rbl()
    {
        return new API\RBL($this->m_account_sid, $this->m_api_token);
    }
    public function get_rbls()
    {
        return new API\RBLs($this->m_account_sid, $this->m_api_token);
    }

    //
    // rbl profiles
    //
    public function get_rbl_profile()
    {
        return new API\RBL_Profile($this->m_account_sid, $this->m_api_token);
    }
    public function get_rbl_profiles()
    {
        return new API\RBL_Profiles($this->m_account_sid, $this->m_api_token);
    }

    //
    // contact groups
    //
    public function get_contact_group()
    {
        return new API\Contact_Group($this->m_account_sid, $this->m_api_token);
    }
    public function get_contact_groups()
    {
        return new API\Contact_Groups($this->m_account_sid, $this->m_api_token);
    }
}
