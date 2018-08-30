<?php

namespace Ypho\Scryfall;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Ypho\Scryfall\Endpoint\Cards;
use Ypho\Scryfall\Endpoint\Sets;
use Ypho\Scryfall\Endpoint\Symbols;
use Ypho\Scryfall\Exception\ScryfallException;

class Client
{
    /** @var \GuzzleHttp\Client */
    protected $guzzle;

    /** @var string */
    protected $baseURI;

    /**
     * Client constructor.
     * @param null $httpClient
     */
    public function __construct($httpClient = null)
    {
        $this->baseURI = 'https://api.scryfall.com/';

        if (is_null($httpClient)) {
            $this->guzzle = new \GuzzleHttp\Client([
                'base_uri' => $this->baseURI,
            ]);
        } else {
            $this->guzzle = $httpClient;
        }
    }

    /**
     * @return Sets
     */
    public function sets()
    {
        return new Sets($this);
    }

    /**
     * @return Cards
     */
    public function cards()
    {
        return new Cards($this);
    }

    /**
     * @return Symbols
     */
    public function symbols()
    {
        return new Symbols($this);
    }

    /**
     * @param $method
     * @param $url
     * @param null $parameters
     * @return Response
     * @throws ScryfallException
     */
    public function send($method, $url, $parameters = null)
    {
        try {
            // If we have GET or PUT, and we have parameters, add them to the URL
            if (is_array($parameters) && in_array($method, ['GET', 'PUT'])) {
                $url .= $this->generateParameterString($parameters);
            }

            /** @var Response $response */
            $response = $this->guzzle->request($method, $this->baseURI . $url, [
                'body' => (in_array($method, ['POST']) ? $this->getXml($parameters) : '')
            ]);

            return $response;
        } catch (ClientException $ex) {
            $json = json_decode($ex->getResponse()->getBody()->getContents());
            throw new ScryfallException($json->details, $ex->getCode());
        }  catch (\GuzzleHttp\Exception\GuzzleException $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        } catch (\Exception $ex) {
            throw new ScryfallException($ex->getMessage(), $ex->getCode());
        }
    }

    /**
     * Converts an array of parameters to a valid string
     *
     * @param array $parameters
     * @return string
     */
    protected function generateParameterString($parameters)
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
        $string = substr($string, 0, -1);

        return $string;
    }
}