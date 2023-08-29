<?php declare(strict_types=1);

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
    public const VERSION = '1.1.0';

    //
    // the API key
    //
    private ?string $m_account_sid = null;
    private ?string $m_api_token = null;

    //
    // the request URL
    //
    private string $m_url = 'https://api.rbltracker.com/3.0/';

    //
    // additional CURL opts
    //
    public array $m_curl_opts = [];

    //
    // init the object and set the API token
    //
    public function __construct(string $_account_sid, string $_api_token)
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
    static public function autoload(string $_name): void
    {
        if (strncmp($_name, 'RBLTracker', 10) == 0)
        {
            require_once str_replace('\\', '/', $_name) . '.php';
        }
    }

    //
    // get/set internal values
    //
    public function account_sid(?string $_account_sid = null): mixed
    {
        if (is_null($_account_sid) == true)
        {
            return $this->m_account_sid;
        } else
        {
            $this->m_account_sid = $_account_sid;
        }

        return null;
    }
    public function api_token(?string $_api_token = null): mixed
    {
        if (is_null($_api_token) == true)
        {
            return $this->m_api_token;
        } else
        {
            $this->m_api_token = $_api_token;
        }

        return null;
    }
    public function url(?string $_url = null): mixed
    {
        if (is_null($_url) == true)
        {
            return $this->m_url;
        } else
        {
            $this->m_url = $_url;
        }

        return null;
    }

    //
    // here to support adding additional custom curl opts
    //
    public function curl_opts(?array $_opts = null): void
    {
        $this->m_curl_opts = $_opts;
    }

    //
    // call a resouce by name
    //
    public function __get(string $_name): mixed
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
    public function get_listings(): API\Listings
    {
        return new API\Listings($this);
    }
    
    //
    // return a host or hosts object
    //
    public function get_host(): API\Host
    {
        return new API\Host($this);
    }
    public function get_hosts(): API\Hosts
    {
        return new API\Hosts($this);
    }

    //
    // return a contact or contacts object
    //
    public function get_contact(): API\Contact
    {
        return new API\Contact($this);
    }
    public function get_contacts(): API\Contacts
    {
        return new API\Contacts($this);
    }

    //
    // return a rbl or rbls object
    //
    public function get_rbl(): API\RBL
    {
        return new API\RBL($this);
    }
    public function get_rbls(): API\RBLs
    {
        return new API\RBLs($this);
    }

    //
    // rbl profiles - this is being phased out
    //
    public function get_rbl_profile(): API\RBL_Profile
    {
        return new API\RBL_Profile($this);
    }
    public function get_rbl_profiles(): API\RBL_Profiles
    {
        return new API\RBL_Profiles($this);
    }

    //
    // monitoring profiles
    //
    public function get_monitoring_profile(): API\Monitoring_Profile
    {
        return new API\Monitoring_Profile($this);
    }
    public function get_monitoring_profiles(): API\Monitoring_Profiles
    {
        return new API\Monitoring_Profiles($this);
    }

    //
    // contact groups
    //
    public function get_contact_group(): API\Contact_Group
    {
        return new API\Contact_Group($this);
    }
    public function get_contact_groups(): API\Contact_Groups
    {
        return new API\Contact_Groups($this);
    }

    //
    // return a new check object
    //
    public function get_check(): API\Check
    {
        return new API\Check($this);
    }

    //
    // ACLs
    //
    public function get_acls(): API\ACLs
    {
        return new API\ACLs($this);
    }
}
