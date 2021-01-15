<?php

namespace src\RequestHandlers;
require "src/RequestHandlers/PostRequestHandler.php";
require "src/RequestHandlers/PutRequestHandler.php";

/**
 * Class RequestsWithBodyHandler's task is to receive all requests
 * that have body. Determine which RequestHandler to call depending on
 * request method.
 * @package src\RequestHandlers
 */
class RequestsWithBodyHandler
{
    private array $input;
    private PostRequestHandler $postRequestHandler;
    private PutRequestHandler $putRequestHandler;

    /**
     * GetRequestHandler constructor.
     *
     * Sets input from request as private field input.
     * Creates new instance of PostRequestHandler and PutRequestHandler
     * and assigns them to private field postRequestHandler and putRequestHandler.
     */
    public function __construct()
    {
        $this->input = (array)json_decode(file_get_contents('php://input'), TRUE);
        $this->postRequestHandler = new PostRequestHandler();
        $this->putRequestHandler = new PutRequestHandler();
    }

    /**
     * Method which is called from the Router class. Calls the correct request handlers
     * receive method with the required arguments depending on the request method.
     *
     * @param string $requestMethod request method in string format
     * @param int|null $contactId id passed into the URL
     * @return array response
     */
    public function receiveRequest(string $requestMethod, ?int $contactId): array
    {
        return $requestMethod === 'PUT'
            ? $this->putRequestHandler->receiveRequest($this->input, $contactId)
            : $this->postRequestHandler->receiveRequest($this->input);
    }
}




