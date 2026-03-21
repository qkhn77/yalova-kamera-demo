<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firma Kodumu Bul</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 24px; }
        .kart { max-width: 460px; margin: 32px auto; background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,.08); }
        .alan { margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; font-size: 14px; font-weight: 600; }
        input { width: 100%; height: 42px; border: 1px solid #d6dbe5; border-radius: 8px; padding: 0 12px; box-sizing: border-box; }
        button { width: 100%; height: 44px; border: 0; border-radius: 8px; background: #155efd; color: #fff; font-weight: 700; cursor: pointer; }
        .hata { color: #b00020; font-size: 13px; margin-top: 4px; }
        .bilgi { background: #eef5ff; color: #11449b; border-radius: 8px; padding: 10px 12px; margin-bottom: 12px; font-size: 14px; }
        .basari { background: #ecfdf3; color: #106b45; border-radius: 8px; padding: 10px 12px; margin-bottom: 12px; font-size: 14px; }
        a { color: #155efd; text-decoration: none; }
    </style>
</head>
<body>
    <div class="kart">
        <h2>Firma Kodumu Bul</h2>
        <p>Firma adınızı yazarak firma kodunuzu öğrenebilirsiniz.</p>

        @if (session('bulunan_firma_kodlari'))
            <div class="basari">
                <strong>Eşleşen firma kodları:</strong>
                <ul style="margin:8px 0 0 18px; padding:0;">
                    @foreach(session('bulunan_firma_kodlari', []) as $firma)
                        <li>{{ $firma['ad'] }} - <strong>{{ $firma['firma_kodu'] }}</strong></li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('status'))
            <div class="bilgi">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('tenant.firma-kodu-bul') }}">
            @csrf
            <div class="alan">
                <label for="firma_adi">Firma Adı</label>
                <input id="firma_adi" name="firma_adi" value="{{ old('firma_adi') }}" required>
                @error('firma_adi') <div class="hata">{{ $message }}</div> @enderror
            </div>
            <button type="submit">Kodu Bul</button>
        </form>

        <p style="margin-top: 14px;"><a href="{{ route('tenant.login') }}">Giriş sayfasına dön</a></p>
    </div>
</body>
</html>

