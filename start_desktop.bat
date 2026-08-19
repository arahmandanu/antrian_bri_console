@echo off
cd /d "%~dp0desktop"

REM Check if WAMP server is running
curl -s -o nul -w "%%{http_code}" http://localhost/antrian_bri_console/ >nul 2>&1
if errorlevel 1 (
    echo [!] Server not reachable at http://localhost/antrian_bri_console
    echo [!] Make sure WAMP / Apache is running before starting Electron.
    pause
    exit /b 1
)

REM Run Electron directly (no npx, no prompt)
start "" "%CD%\node_modules\electron\dist\electron.exe" "%CD%"
