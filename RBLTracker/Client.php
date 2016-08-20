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
    // current version of this library
    //
    const VERSION = '1.0.0';

    //
    // the API key
    //
    protected $m_api_token = null;

    //
    // init the object and set the API token
    //
    public function __construct($_api_token)
    {
        //
        // validate the key
        //
        if (preg_match('/^[0-9a-f]{64}$/', $_api_token) == 0)
        {
            throw new RBLTrackerException('invalid API access token provided.');
        }

        $this->m_api_token = $_api_token;
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
        return new API\Listings($this->m_api_token);
    }
    
    //
    // return a host or hosts object
    //
    public function get_host()
    {
        return new API\Host($this->m_api_token);
    }
    public function get_hosts()
    {
        return new API\Hosts($this->m_api_token);
    }

    //
    // return a contact or contactss object
    //
    public function get_contact()
    {
        return new API\Contact($this->m_api_token);
    }
    public function get_contacts()
    {
        return new API\Contacts($this->m_api_token);
    }
}
