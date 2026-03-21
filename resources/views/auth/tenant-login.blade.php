<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firma Girişi</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 24px; }
        .kart { max-width: 460px; margin: 32px auto; background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,.08); }
        .alan { margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        input { width: 100%; height: 42px; border: 1px solid #d6dbe5; border-radius: 8px; padding: 0 12px; box-sizing: border-box; }
        button { width: 100%; height: 44px; border: 0; border-radius: 8px; background: #155efd; color: #fff; font-weight: 700; cursor: pointer; }
        .hata { color: #b00020; font-size: 13px; margin-top: 4px; }
        .bilgi { background: #eef5ff; color: #11449b; border-radius: 8px; padding: 10px 12px; margin-bottom: 12px; font-size: 14px; }
        .satir { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
        a { color: #155efd; text-decoration: none; }
    </style>
</head>
<body>
    <div class="kart">
        <h2>Firma Girişi</h2>
        <p>Firma kodu, kullanıcı adı/e-posta ve şifreniz ile giriş yapın.</p>

        @if (session('status'))
            <div class="bilgi">{{ session('status') }}</div>
        @endif

        <div class="satir">
            <a href="{{ route('yonetici.login') }}">Yönetici girişi</a>
            <a href="{{ route('tenant.firma-kodu-bul.form') }}">Firma kodumu bul</a>
        </div>

        <form method="POST" action="{{ route('tenant.login.attempt') }}">
            @csrf
            <div class="alan">
                <label for="firma_kodu">Firma Kodu</label>
                <input id="firma_kodu" name="firma_kodu" value="{{ old('firma_kodu') }}" required>
                @error('firma_kodu') <div class="hata">{{ $message }}</div> @enderror
            </div>

            <div class="alan">
                <label for="kullanici_adi_veya_eposta">Kullanıcı Adı veya E-posta</label>
                <input id="kullanici_adi_veya_eposta" name="kullanici_adi_veya_eposta" value="{{ old('kullanici_adi_veya_eposta') }}" required>
                @error('kullanici_adi_veya_eposta') <div class="hata">{{ $message }}</div> @enderror
            </div>

            <div class="alan">
                <label for="sifre">Şifre</label>
                <input id="sifre" type="password" name="sifre" required>
                @error('sifre') <div class="hata">{{ $message }}</div> @enderror
                @error('firma') <div class="hata">{{ $message }}</div> @enderror
            </div>

            <div class="alan">
                <label><input type="checkbox" name="beni_hatirla" value="1"> Beni hatırla</label>
            </div>

            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>

