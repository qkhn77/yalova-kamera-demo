<?php
/**
 * SSH/terminal yoksa cache temizlemek için tarayıcıdan açın:
 * https://yalovakamera.com/clear-cache.php
 * Bir kez çalıştırdıktan sonra bu dosyayı silebilirsiniz (güvenlik).
 */

define('LARAVEL_START', microtime(true));

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$messages = [];
$messages[] = 'Cache temizlendi.';
$messages[] = '';

try {
    Illuminate\Support\Facades\Artisan::call('view:clear');
    $messages[] = '- view:clear OK';
} catch (Throwable $e) {
    $messages[] = '- view:clear: ' . $e->getMessage();
}
try {
    Illuminate\Support\Facades\Artisan::call('config:clear');
    $messages[] = '- config:clear OK';
} catch (Throwable $e) {
    $messages[] = '- config:clear: ' . $e->getMessage();
}
try {
    Illuminate\Support\Facades\Artisan::call('cache:clear');
    $messages[] = '- cache:clear OK';
} catch (Throwable $e) {
    $messages[] = '- cache:clear: ' . $e->getMessage();
}
try {
    Illuminate\Support\Facades\Artisan::call('route:clear');
    $messages[] = '- route:clear OK';
} catch (Throwable $e) {
    $messages[] = '- route:clear: ' . $e->getMessage();
}

// Route cache dosyasını sil (varsa)
$routeCache = __DIR__ . '/bootstrap/cache/routes-v7.php';
if (file_exists($routeCache)) {
    @unlink($routeCache);
    $messages[] = '- route cache dosyası silindi';
}

$messages[] = '';
$messages[] = 'İşlem bitti. İsterseniz bu dosyayı (clear-cache.php) silebilirsiniz.';

header('Content-Type: text/plain; charset=utf-8');
echo implode("\n", $messages);
