<?php

namespace backAlda\publicHtml;

use backAlda\Resources\Common\Common;

class Rest
{
    public function definirRetornoHttp(int $codigo, array $content = []): void
    {
        /* Handle CORS */

        // Specify domains from which requests are allowed
        header("Access-Control-Allow-Origin: http://localhost:3000");

        // Specify which request methods are allowed
        header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

        // Additional headers which may be sent along with the CORS request
        header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');

        // Set the age to 1 day to improve speed/caching.
        header('Access-Control-Max-Age: 86400');

        http_response_code($codigo);
        print_r(Common::formatarRetorno($codigo, CODE_HTTP[$codigo], $content));
        exit();
    }

    public function validarRequest(string $request): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $request;
    }
}
