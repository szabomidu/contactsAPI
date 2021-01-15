<?php

namespace src\Response;

/**
 * Class ResponseFactory
 * @package src\ResponseFactory
 */
class ResponseFactory
{
    /**
     * @var array|string[]
     */
    private array $headers = ["200" => 'HTTP/1.1 200 OK',
                                "404" => 'HTTP/1.1 404 Not Found',
                                "422" => 'HTTP/1.1 422 Unprocessable Entity'];
    /**
     * @var array
     */
    private array $response;

    /**
     * ResponseFactory constructor.
     * @param string $status
     * @param array $body
     * @return array
     */
    public function createResponse(string $status, array $body): array
    {
        $this->response["header"] = $this->headers[$status];
        $this->response["body"] = $body;
        return $this->getResponse();
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

}