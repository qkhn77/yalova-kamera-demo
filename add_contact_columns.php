<?php
/**
 * Canlı sunucuda SSH yoksa: Bu dosyayı sitenin KÖK dizinine yükleyin,
 * tarayıcıdan http://demo.yalovakamera.com/add_contact_columns.php açın.
 * "Tamamlandı" yazısını gördükten sonra bu dosyayı sunucudan SİLİN.
 */

// Laravel bootstrap (tek seferlik script)
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

header('Content-Type: text/html; charset=utf-8');

$done = [];
$errors = [];

try {
    if (!Schema::hasColumn('contact_pages', 'whatsapp_url')) {
        Schema::table('contact_pages', function (Blueprint $table) {
            $table->string('whatsapp_url')->nullable()->after('form_intro');
        });
        $done[] = 'whatsapp_url eklendi.';
    } else {
        $done[] = 'whatsapp_url zaten var.';
    }
} catch (Throwable $e) {
    $errors[] = 'whatsapp_url: ' . $e->getMessage();
}

try {
    if (!Schema::hasColumn('contact_pages', 'facebook_url')) {
        Schema::table('contact_pages', function (Blueprint $table) {
            $table->string('facebook_url')->nullable()->after('twitter_url');
        });
        $done[] = 'facebook_url eklendi.';
    } else {
        $done[] = 'facebook_url zaten var.';
    }
} catch (Throwable $e) {
    $errors[] = 'facebook_url: ' . $e->getMessage();
}

echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>contact_pages sütunları</title></head><body style="font-family:sans-serif;padding:2rem;">';
echo '<h1>contact_pages tablosu</h1>';
if (!empty($done)) {
    echo '<p style="color:green;"><strong>Tamamlandı:</strong><br>' . implode('<br>', $done) . '</p>';
}
if (!empty($errors)) {
    echo '<p style="color:red;"><strong>Hata:</strong><br>' . implode('<br>', $errors) . '</p>';
}
if (empty($errors)) {
    echo '<p><strong>Bu dosyayı sunucudan silin:</strong> add_contact_columns.php</p>';
}
echo '</body></html>';
