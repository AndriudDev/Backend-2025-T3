<?php

function jsonResponse(int $statusCode, string $message, $data = null)
{
    http_response_code($statusCode);
    echo json_encode([
        'mensaje' => $message,
        'data' => $data
    ]);
    exit;
}
