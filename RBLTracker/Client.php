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

final class Client
{
    //
    // PHP SDK version
    //
    const VERSION = '1.0.3';

    //
    // the API key
    //
    private $m_account_sid = null;
    private $m_api_token = null;

    //
    // the request URL
    //
    private $m_url = 'https://rbltracker.com/api/';

    //
    // additional CURL opts
    //
    public $m_curl_opts = [];

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

        $this->account_sid($_account_sid);
        $this->api_token($_api_token);
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
    // get/set internal values
    //
    public function account_sid($_account_sid = null)
    {
        if (is_null($_account_sid) == true)
        {
            return $this->m_account_sid;
        } else
        {
            $this->m_account_sid = $_account_sid;
        }
    }
    public function api_token($_api_token = null)
    {
        if (is_null($_api_token) == true)
        {
            return $this->m_api_token;
        } else
        {
            $this->m_api_token = $_api_token;
        }
    }
    public function url($_url = null)
    {
        if (is_null($_url) == true)
        {
            return $this->m_url;
        } else
        {
            $this->m_url = $_url;
        }
    }

    //
    // here to support adding additional custom curl opts
    //
    public function curl_opts(array $_opts = null)
    {
        $this->m_curl_opts = $_opts;
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
        return new API\Listings($this);
    }
    
    //
    // return a host or hosts object
    //
    public function get_host()
    {
        return new API\Host($this);
    }
    public function get_hosts()
    {
        return new API\Hosts($this);
    }

    //
    // return a contact or contacts object
    //
    public function get_contact()
    {
        return new API\Contact($this);
    }
    public function get_contacts()
    {
        return new API\Contacts($this);
    }

    //
    // return a rbl or rbls object
    //
    public function get_rbl()
    {
        return new API\RBL($this);
    }
    public function get_rbls()
    {
        return new API\RBLs($this);
    }

    //
    // rbl profiles
    //
    public function get_rbl_profile()
    {
        return new API\RBL_Profile($this);
    }
    public function get_rbl_profiles()
    {
        return new API\RBL_Profiles($this);
    }

    //
    // contact groups
    //
    public function get_contact_group()
    {
        return new API\Contact_Group($this);
    }
    public function get_contact_groups()
    {
        return new API\Contact_Groups($this);
    }

    //
    // return a new check object
    //
    public function get_check()
    {
        return new API\Check($this);
    }
}
