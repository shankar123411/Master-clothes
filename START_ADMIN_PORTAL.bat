@echo off
title NovaApparel Admin Portal - Local Server
cd /d "%~dp0"

set "PHP_EXE=php"
if exist "D:\xampp\php\php.exe" set "PHP_EXE=D:\xampp\php\php.exe"

echo ==================================================
echo   NovaApparel Admin Portal (Laravel 12 + Filament)
echo   URL: http://127.0.0.1:8000/admin
echo ==================================================
echo.

start "" cmd /c "timeout /t 2 /nobreak >nul && (start chrome http://127.0.0.1:8000/admin 2>nul || start http://127.0.0.1:8000/admin)"
"%PHP_EXE%" artisan serve --host=127.0.0.1 --port=8000
pause
