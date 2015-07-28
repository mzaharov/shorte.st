<?php

namespace Appsketch\Shortest;

use GuzzleHttp\Client;
use Illuminate\Config\Repository as Config;

/**
 * Class Shortest
 *
 * @package Appsketch\Shortest
 */
class Shortest
{
    /**
     * Base url
     */
    const BASE_URL = "https://api.shorte.st/v1/data/url";
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Client $client
     * @param Config $config
     */
    public function __construct(Client $client, Config $config)
    {
        // Guzzle HTTP client.
        $this->client = $client;

        // Shortest config.
        $this->config = $config;
    }

    /**
     * Short the link.
     *
     * @param $url_to_shorten
     *
     * @return null
     */
    public function link($url_to_shorten)
    {
        // json decode the result.
        $result = json_decode($this->post($url_to_shorten));

        // Check if the result isset and not empty.
        if(isset($result) && !empty($result))
        {
            // Return the shortened url.
            return $result->shortenedUrl;
        }

        // If not.
        else
        {
            // Return null.
            return $result;
        }
    }

    /**
     * Make a post request to shorte.st.
     *
     * @param $url_to_shorten
     *
     * @return \GuzzleHttp\Stream\StreamInterface|null|\Psr\Http\Message\StreamInterface
     */
    private function post($url_to_shorten)
    {
        // Prepare the request.
        $request = $this->client->put(Shortest::BASE_URL, [

            // Set the put headers.
            'headers' => [

                // Get the public api token from the config file.
                'public-api-token' => $this->config->get('shortest.api_token')
            ],

            // Set the parameters.
            'form_params' => [

                // The url that needs to be shorten.
                'urlToShorten' => $url_to_shorten
            ]
        ]);

        // Return the body as json.
        return $request->getBody();
    }
}