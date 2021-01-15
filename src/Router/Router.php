<?php

namespace src\Router;
require "src/RequestHandlers/GetRequestHandler.php";
require "src/RequestHandlers/RequestsWithBodyHandler.php";

use src\RequestHandlers\GetRequestHandler;
use src\RequestHandlers\RequestsWithBodyHandler;
use src\Response\ResponseFactory;

/**
 * Class Router
 *
 * Router class is responsible for calling the right method depending on the
 * request method and the URI parameters.
 *
 * @package src\Router
 */
class Router
{
    private GetRequestHandler $getRequestHandler;
    private RequestsWithBodyHandler $requestWithBodyHandler;
    private ResponseFactory $responseFactory;

    /**
     * Router constructor.
     *
     * Sets a new instance of ContactController to private field $contactController
     */
    public function __construct()
    {
        $this->getRequestHandler = new GetRequestHandler();
        $this->requestWithBodyHandler = new RequestsWithBodyHandler();
        $this->responseFactory = new ResponseFactory();
    }

    /**
     * ProcessRequest method calls the correct method depending on the request
     * and whether or not contactId is present.
     *
     * @param $requestMethod string request method
     * @param int|null $contactId integer id from URL or null if not present
     * @return array response data
     */
    public function processRequest(string $requestMethod, ?int $contactId = null): array
    {
        switch ($requestMethod) {
            case 'GET':
                return $this->getRequestHandler->receiveRequest($contactId);
            case 'POST':
            case 'PUT':
                return $this->requestWithBodyHandler->receiveRequest($requestMethod, $contactId);
            default:
                return $this->responseFactory->createResponse("404", ["Not found!"]);
        }
    }
}