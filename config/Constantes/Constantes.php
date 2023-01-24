<?php

namespace backAlda\config\Constantes;

class Constantes
{
    private function definirConstantes(): void
    {
        define('PROJETO_URI', $_SERVER['REDIRECT_URL']);
        define('PROJETO_URL', $_SERVER['REQUEST_URI']);
        define('PROJETO_NAME', $_SERVER['SERVER_NAME']);
        define('PROJETO_ROOT', dirname(__FILE__, 3));
    }

    private function codigosInformal(): array
    {
        return [
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing',
        ];
    }

    private function codigosSucess(): array
    {
        return [
            200 => 'Ok',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi-Status',
            208 => 'Already Reported',
            226 => 'Im Used',
        ];
    }

    private function codigosRedirection(): array
    {
        return [
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            308 => 'Permanent Redirect',
        ];
    }

    private function codigosClientError(): array
    {
        return [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Payload Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            418 => 'I\'m a teapot',
            421 => 'Misdirected Request',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            426 => 'Upgrade Required',
            428 => 'Precondition Required',
            429 => 'Too Many Requests',
            431 => 'Request Header Fields Too Large',
            444 => 'Connection Closed Without Response',
            451 => 'Unavailable For Legal Reasons',
            499 => 'Client Closed Request',
        ];
    }

    private function codigosServerError(): array
    {
        return [
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            508 => 'Loop Detected',
            510 => 'Not Extended',
            511 => 'Network Authentication Required',
            599 => 'Network Connect Timeout Error',
        ];
    }

    private function definirCodigosHttp(): void
    {
        $arrayCodes = $this->codigosInformal()
            + $this->codigosSucess()
            + $this->codigosRedirection()
            + $this->codigosClientError()
            + $this->codigosServerError();

        define('CODE_HTTP', $arrayCodes);
    }

    public function __construct()
    {
        $this->definirConstantes();
        $this->definirCodigosHttp();
    }
}