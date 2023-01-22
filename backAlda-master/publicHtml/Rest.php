<?php

namespace backAlda\publicHtml;

use backAlda\Resources\Common\Common;

class Rest
{
    public function definirRetornoHttp(int $codigo, array $content = []): void
    {
        http_response_code($codigo);
        print_r(Common::formatarRetorno($codigo, CODE_HTTP[$codigo], $content));
        exit();
    }
        
    public function validarRequest(string $request): bool
    {
        return $_SERVER['REQUEST_METHOD'] === $request;
    }
}