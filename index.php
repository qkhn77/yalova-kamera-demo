<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Symlink yoksa /storage/* isteklerini direkt storage/app/public'tan servis et.
// Document root proje kökü olduğunda web server "storage/" klasörüyle çakışıp 404 üretebiliyor.
if (isset($_SERVER['REQUEST_URI'])) {
    $uriPath = parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '';
    if (str_starts_with($uriPath, '/storage/')) {
        $rel = substr($uriPath, strlen('/storage/'));
        $rel = str_replace(['..', '\\'], ['', '/'], $rel);
        $rel = ltrim($rel, '/');

        $full = __DIR__ . '/storage/app/public/' . $rel;
        if (is_file($full) && is_readable($full)) {
            $mime = function_exists('mime_content_type') ? @mime_content_type($full) : null;
            if (! is_string($mime) || $mime === '') {
                $mime = 'application/octet-stream';
            }
            header('Content-Type: ' . $mime);
            header('Cache-Control: public, max-age=31536000, immutable');
            header('X-Content-Type-Options: nosniff');
            readfile($full);
            exit;
        }

        http_response_code(404);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Not Found';
        exit;
    }
}

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->handleRequest(Request::capture());