<?php

namespace App\Support;

use App\Providers\Filament\AdminPanelProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Tek Filament paneli — firma ve yönetici girişleri sonrası ortak hedef URL.
 */
class PanelYonlendirme
{
    public static function anaSayfaUrl(): string
    {
        return url(AdminPanelProvider::adminPath());
    }

    /**
     * Oturumdaki url.intended yalnızca panel yolu içindeyse kullanılır.
     * Aksi halde (ör. önce ana sayfa / ziyaret edildiyse) ana sayfaya düşülmez, panel açılır.
     */
    public static function guvenliIntendedIlePanel(Request $istek): RedirectResponse
    {
        $varsayilan = self::anaSayfaUrl();
        $hedef = $istek->session()->get('url.intended');

        if (is_string($hedef) && $hedef !== '' && ! self::urlPanelIciMi($hedef, $istek)) {
            $istek->session()->forget('url.intended');
        }

        return redirect()->intended($varsayilan);
    }

    public static function urlPanelIciMi(string $url, Request $istek): bool
    {
        $parcalar = parse_url($url);
        if ($parcalar === false) {
            return false;
        }

        if (isset($parcalar['host']) && strcasecmp((string) $parcalar['host'], $istek->getHost()) !== 0) {
            return false;
        }

        $yol = $parcalar['path'] ?? '/';
        $panel = trim(AdminPanelProvider::adminPath(), '/');
        $yolNorm = '/'.trim($yol, '/');
        $panelOnEki = '/'.$panel;

        return $yolNorm === $panelOnEki || str_starts_with($yolNorm, $panelOnEki.'/');
    }
}

