@echo off
chcp 65001 >nul
echo ============================================
echo  XAMPP MySQL Servis Yolu Duzeltme
echo ============================================
echo.

:: Yonetici kontrolu
net session >nul 2>&1
if %errorLevel% neq 0 (
    echo HATA: Bu dosyayi YONETICI OLARAK CALISTIRIN.
    echo Sag tiklayin - "Yonetici olarak calistir" secin.
    pause
    exit /b 1
)

echo [1/4] MySQL servisi durduruluyor...
net stop mysql 2>nul
net stop MySQL 2>nul
net stop MySQL80 2>nul
timeout /t 2 /nobreak >nul
echo.

echo [2/4] Eski MySQL servisi kaldiriliyor...
"c:\xampp\mysql\bin\mysqld.exe" --remove mysql 2>nul
"c:\xampp\mysql\bin\mysqld.exe" --remove MySQL 2>nul
sc delete mysql 2>nul
sc delete MySQL 2>nul
sc delete MySQL80 2>nul
timeout /t 2 /nobreak >nul
echo.

echo [3/4] MySQL servisi dogru yolla yeniden yukleniyor...
"c:\xampp\mysql\bin\mysqld.exe" --install mysql --defaults-file=c:\xampp\mysql\bin\my.ini
if %errorLevel% neq 0 (
    echo Uyari: --install basarisiz olabilir. Manuel kurulum deneyin.
) else (
    echo Servis basariyla yuklendi.
)
echo.

echo [4/4] Tamamlandi.
echo.
echo Simdi XAMPP Control Panel'i KAPATIP TEKRAR ACIN.
echo MySQL'i panelden Start ile baslatabilirsiniz.
echo.
pause
