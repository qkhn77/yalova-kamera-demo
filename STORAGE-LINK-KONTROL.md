# Storage (Görsel) Symlink Kontrolü

## Sorun
Blog/site görselleri `http://127.0.0.1:8000/storage/posts/dosya.jpg` adresinde açılmıyorsa genelde **symlink** eksik veya yanlış.

## 1. Symlink’i Kontrol Etme (PowerShell)

Proje kökünde:

```powershell
Get-Item public\storage | Format-List FullName, LinkType, Target
```

- **LinkType boş, Attributes: Directory** → `public/storage` normal klasör, symlink değil. Görseller bu yüzden gelmez.
- **LinkType: SymbolicLink, Target: ...\storage\app\public** → Doğru symlink.

## 2. Çözüm A: Laravel Route (Şu an kullanılıyor)
Projede `/storage/{path}` isteği Laravel ile `storage/app/public` içinden sunuluyor.  
**Yapmanız gereken:** `public/storage` klasörünü **silin** (içi boş olsa bile). Böylece istekler Laravel’e gider ve görseller çalışır.

```powershell
Remove-Item -Recurse -Force public\storage
```

Sonra sayfayı yenileyin; görsel URL’i aynı kalır, dosya Laravel route’u ile sunulur.

## 3. Çözüm B: Gerçek Symlink (İsteğe bağlı)
Symlink ile klasik Laravel davranışını kullanmak isterseniz:

1. `public/storage` klasörünü silin (yoksa symlink oluşmaz):
   ```powershell
   Remove-Item -Recurse -Force public\storage
   ```
2. **Yönetici olarak** PowerShell veya CMD açıp proje kökünde:
   ```powershell
   cd c:\xampp\htdocs\yalova-kamera
   php artisan storage:link
   ```
   Veya Windows’ta symlink yetkisi yoksa **Directory Junction** (yönetici gerektirmez):
   ```powershell
   cmd /c mklink /J "public\storage" "storage\app\public"
   ```

## 4. Dosyanın Yerde Olduğunu Kontrol
Görselin gerçekten diskte olduğundan emin olun:

```powershell
Test-Path storage\app\public\posts\01KKKH800XWSQYNSFJNK3VQ31Q.jpg
# True dönmeli
```

True ise dosya var; sorun sadece `public/storage` erişimi veya symlink’tir.
