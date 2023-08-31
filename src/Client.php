<?php

namespace Ypho\Scryfall;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\Endpoints\CardEndpoint;
use Ypho\Scryfall\Endpoints\SetEndpoint;
use Ypho\Scryfall\Endpoints\SymbologyEndpoint;
use Ypho\Scryfall\Exception\ScryfallException;

class Client
{
    const BASE_URI = 'https://api.scryfall.com/';

    private \GuzzleHttp\Client $guzzle;

    public function __construct(\GuzzleHttp\Client $httpClient = null)
    {
        $this->guzzle = $httpClient ?? new \GuzzleHttp\Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => self::BASE_URI,
        ]);
    }

    public function sets(): SetEndpoint
    {
        return new SetEndpoint($this);
    }

    public function symbology(): SymbologyEndpoint
    {
        return new SymbologyEndpoint($this);
    }

    public function cards(): CardEndpoint
    {
        return new CardEndpoint($this);
    }

    /**
     * Fires a call to Scryfall and returns either a ScryfallException or an array with data.
     *
     * @param string $url
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws ScryfallException
     */
    public function fetchResponse(string $url, string $method = 'GET', array $parameters = []): array
    {
        try {
            // If we have GET or PUT, and we have parameters, add them to the URL
            if (is_array($parameters) && in_array($method, ['GET', 'PUT'])) {
                $url .= $this->generateParameterString($parameters);
            }

            /** @var Response $response */
            $response = $this->guzzle->request($method, $url, [
                'body' => json_encode([$parameters])
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $ex) {
            $json = json_decode($ex->getResponse()->getBody()->getContents());
            throw new ScryfallException($json->details, $ex->getCode());
        } catch (GuzzleException $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        } catch (Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Converts an array of parameters to a valid string
     *
     * @param array $parameters
     * @return string
     */
    private function generateParameterString(array $parameters): string
    {
        // Start string with ?
        $string = '?';

        foreach ($parameters as $k => $v) {
            if (is_bool($v)) {
                $string .= $k . '=' . ($v ? 'true' : 'false') . '&';
            } else {
                $string .= $k . '=' . $v . '&';
            }
        }

        // Remove last &
        return substr($string, 0, -1);
    }
}