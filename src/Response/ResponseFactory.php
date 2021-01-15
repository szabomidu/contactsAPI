<?php

namespace src\Response;

/**
 * Class ResponseFactory's task is to create a request from the given
 * parameters.
 * @package src\ResponseFactory
 */
class ResponseFactory
{
    /**
     * @var array|string[] array containing all the request headers
     * the API is capable of sending as response header.
     */
    private array $headers = ["200" => 'HTTP/1.1 200 OK',
                                "404" => 'HTTP/1.1 404 Not Found',
                                "422" => 'HTTP/1.1 422 Unprocessable Entity'];
    private array $response;

    /**
     * ResponseFactory constructor.
     * Sets the response header from headers array.
     * Sets response body.
     *
     * @param string $status response status in string format
     * @param array $body response body
     * @return array response
     */
    public function createResponse(string $status, array $body): array
    {
        $this->response["header"] = $this->headers[$status];
        $this->response["body"] = $body;
        return $this->getResponse();
    }

    /**
     * Getter method for response.
     *
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

}