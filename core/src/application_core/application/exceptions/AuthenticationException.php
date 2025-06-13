<?php

namespace App\application_core\application\exceptions;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class AuthenticationException extends \RuntimeException {

    public String $string;

    public function __construct(string $string)
    {
        parent::__construct($string);
    }

    public static function handle(Response $response, DatabaseException $e): ResponseInterface {
        $errorResponse = [
            'error' => 'Authentication Error',
            'message' => $e->getMessage(),
            'status' => 401
        ];
        $response->getBody()->write(json_encode($errorResponse));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*') // CORS
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(401);
    }
}