<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim formu</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #1a1a1a;">İletişim formundan yeni mesaj</h2>

    <p><strong>Ad Soyad:</strong> {{ $name }}</p>
    <p><strong>E-posta:</strong> {{ $email }}</p>
    @if(!empty($phone))
    <p><strong>Telefon:</strong> {{ $phone }}</p>
    @endif
    <p><strong>Mesaj:</strong></p>
    <p style="white-space: pre-wrap; background: #f5f5f5; padding: 12px; border-radius: 6px;">{{ $message }}</p>

    <p style="margin-top: 24px; font-size: 12px; color: #666;">Bu e-posta site iletişim formu üzerinden gönderilmiştir.</p>
</body>
</html>
