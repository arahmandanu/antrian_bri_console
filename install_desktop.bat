@echo off
REM Install Electron dependencies
cd /d "%~dp0desktop"
echo Installing Electron dependencies...
call npm install
echo.
echo Done. Run start_desktop.bat to launch.
pause
