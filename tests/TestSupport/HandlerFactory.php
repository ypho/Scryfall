<?php
namespace Tests\TestSupport;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class HandlerFactory
{
    /**
     * @param string $file
     * @param int $statusCode
     * @return HandlerStack
     */
    public static function getHandler(string $file, int $statusCode = 200)
    {
        return self::getHandlerForResponse(self::getResponse($file, $statusCode));
    }

    protected static function getHandlerForResponse($response)
    {
        $mock = new MockHandler([
            $response
        ]);

        $handler = HandlerStack::create($mock);

        return $handler;
    }

    /**
     * @param string $file
     * @param int $statusCode
     * @return Response
     */
    protected static function getResponse(string $file, int $statusCode = 200)
    {
        return new Response($statusCode, ['Content-Type' => 'application/json'], self::getContents('/responses/' . $file));
    }

    /**
     * @param $filename
     * @return bool|string
     */
    protected static function getContents(string $filename)
    {
        return file_get_contents(__DIR__ . $filename);
    }
}