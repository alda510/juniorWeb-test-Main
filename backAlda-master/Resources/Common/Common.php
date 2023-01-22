<?php

namespace backAlda\Resources\Common;

class Common
{
    public static function formatarRetorno(
        int $code, 
        string $message, 
        array $content = []
        ): string {
            return json_encode(self::prepararRetorno(
                $code, 
                $message, 
                $content
            ));
    }

        
    public static function prepararRetorno(
        int $code, 
        string $message, 
        array $content = []
    ): array {
        $error = !($code === 0 || $code === 200);
        return [
            'error' => $error,
            'code' => $code,
            'message' => $message,
            'content' => $content,
        ];
    }
}