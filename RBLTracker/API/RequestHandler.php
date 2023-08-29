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

trait RequestHandler
{
    private \RBLTracker\Client $m_client;

    //
    // init a new object
    //
    protected function init(\RBLTracker\Client $_client): void
    {
        $this->m_client = $_client;
    }

    //
    // build a request URL
    //
    private function build_url(string $_action, ?array $_args = null): string
    {
        //
        // if there were arguments passed in
        //
        if (is_null($_args) == false)
        {
            return $this->m_client->url() . $_action . '.json' . '?' . http_build_query($_args);
        } else
        {
            return $this->m_client->url() . $_action . '.json';
        }
    }

    //
    // make the actual request
    //
    private function request(string $_type, string $_action, ?array $_args = null): array
    {
        $response = '';

        //
        // if CURL exists, use it- it's faster
        //
        if (function_exists('curl_version') == true)
        {
            //
            // set up CURL
            //
            $c = curl_init();

            if ($_type == 'POST')
            {
                curl_setopt($c, CURLOPT_URL, $this->build_url($_action));
                curl_setopt($c, CURLOPT_POST, true);

                //
                // build headers
                //
                $headers = [

                    'Content-type'  => 'application/x-www-form-urlencoded'
                ];

                //
                // if there are args
                //
                if (is_null($_args) == false)
                {
                    curl_setopt($c, CURLOPT_POSTFIELDS, http_build_query($_args));

                } else
                {
                    //
                    // some versions of CURL apparently set the content-length value to -1 in the event you do a post with no
                    // POST data, like we do for delete operations.
                    //  
                    // I wasn't able to reproduce this issue, but I found some people complaining about the same issue, and it
                    // should be safe to set this to 0 if there's no data anyway.
                    //
                    $headers['Content-Length'] = 0;
                }

                //
                // add the custom headers
                //
                curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
                
            } else
            {
                curl_setopt($c, CURLOPT_URL, $this->build_url($_action, $_args));
            }

            curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_USERPWD, $this->m_client->account_sid() . ':' . $this->m_client->api_token());

            //
            // add additional custom CURL opts
            //
            if (count($this->m_client->m_curl_opts) > 0)
            {
                curl_setopt_array($c, $this->m_client->m_curl_opts);
            }

            //
            // make the request
            //
            $response  = curl_exec($c);

            //
            // shutdown CURL
            //
            curl_close($c);

            //
            // validate the response data
            //
            if ( ($response === false) || (strlen(strval($response)) == 0) )
            {
                throw new RBLTrackerException('failed to make request to RBLTracker API');
            }

        //
        // otherwise, just use file_get_contents()
        //
        } else
        {
            //
            // POST request
            //
            if ($_type == 'POST')
            {
                //
                // build the opts
                //
                $opts = [ 'http' => [

                        'method'    => 'POST',
                        'header'    => [

                            'Content-type: application/x-www-form-urlencoded',
                            'Authorization: Basic ' . base64_encode($this->m_client->account_sid() . ':' . $this->m_client->api_token())
                        ],
                        'content'   => (is_null($_args) == true) ? '' : http_build_query($_args),
                    ]
                ];

                //
                // make the request
                //
                $response = file_get_contents($this->build_url($_action), false, stream_context_create($opts));

                if ( ($response === false) || (strlen($response) == 0) )
                {
                    throw new RBLTrackerException('failed to make request to RBLTracker API');
                }

            //
            // GET request
            //
            } else
            {
                //
                // build the opts
                //
                $opts = [ 'http' => [

                        'method'    => 'GET',
                        'header'    => [

                            'Authorization: Basic ' . base64_encode($this->m_client->account_sid() . ':' . $this->m_client->api_token())
                        ]
                    ]
                ];

                //
                // make the request
                //
                $response = file_get_contents($this->build_url($_action, $_args), false, stream_context_create($opts));
                if ( ($response === false) || (strlen($response) == 0) )
                {
                    throw new RBLTrackerException('failed to make request to RBLTracker API');
                }
            }
        }

        //
        // json decode it
        //
        $data = json_decode(strval($response), true);
        if (is_null($data) == true)
        {
            throw new RBLTrackerException('failed to decode response from RBLTracker API');
        }

        //
        // look for a positive response
        //
        if ( (isset($data['status_code']) == false) || ($data['status_code'] != 200) )
        {
            throw new RBLTrackerException('RBLTracker API returned error: ' . $data['status_message']);
        }

        return $data;
    }

    //
    // make a get request to the API
    //
    protected function _get(string $_action, ?array $_args = null): array
    {
        return $this->request('GET', $_action, $_args);
    }

    //
    // make a post request to the API
    //
    protected function _post(string $_action, ?array $_args = null): array
    {
        return $this->request('POST', $_action, $_args);
    }
}
