<?php

namespace src\RequestHandlers;
require "src/RequestHandlers/PostRequestHandler.php";
require "src/RequestHandlers/PutRequestHandler.php";

class RequestsWithBodyHandler
{
    private array $input;
    private PostRequestHandler $postRequestHandler;
    private PutRequestHandler $putRequestHandler;

    /**
     * GetRequestHandler constructor.
     */
    public function __construct()
    {
        $this->input = (array)json_decode(file_get_contents('php://input'), TRUE);
        $this->postRequestHandler = new PostRequestHandler();
        $this->putRequestHandler = new PutRequestHandler();
    }

    public function receiveRequest(string $requestMethod, int $contactId): array
    {
        return $requestMethod === 'PUT'
            ? $this->putRequestHandler->receiveRequest($this->input, $contactId)
            : $this->postRequestHandler->receiveRequest($this->input);
    }
}




