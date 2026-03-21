<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Tam sayfa GET testi auth view’larında Setting vb. DB erişimi gerektirdiği için
 * burada en azından route’ların tanımlı olduğu doğrulanır.
 * Manuel: tarayıcıda /yonetici-giris ve /giris açılışını kontrol edin.
 */
class GirisEkranlariTest extends TestCase
{
    public function test_yonetici_giris_route_tanimli(): void
    {
        $this->assertTrue(Route::has('yonetici.login'));
        $this->assertTrue(Route::has('yonetici.login.attempt'));

        $rota = Route::getRoutes()->getByName('yonetici.login');
        $this->assertNotNull($rota);
        $this->assertContains('GET', $rota->methods());
        $this->assertStringContainsString('yonetici-giris', (string) $rota->uri());
    }

    public function test_tenant_giris_route_tanimli(): void
    {
        $this->assertTrue(Route::has('tenant.login'));
        $this->assertTrue(Route::has('tenant.login.attempt'));

        $rota = Route::getRoutes()->getByName('tenant.login');
        $this->assertNotNull($rota);
        $this->assertContains('GET', $rota->methods());
        $this->assertStringContainsString('giris', (string) $rota->uri());
    }
}
