
start msedge --app=http://localhost/antrian_bri_console/kios --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --window-position=0,0 --new-window --user-data-dir=%TEMP%/monitor1
start msedge --app=http://localhost/antrian_bri_console/ --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --window-position=1920,0 --new-window --user-data-dir=%TEMP%/monitor0 --edge-kiosk-type=fullscreen

@REM start "" "C:\Program Files\Mozilla Firefox\firefox.exe" --kiosk --user-data-dir=%TEMP%/monitor1 --window-position=0,0 --private-window localhost/antrian_bri_console
@REM start "" "C:\Program Files\Mozilla Firefox\firefox.exe" --kiosk --user-data-dir=%TEMP%/monitor0 --window-position=1920,0 --private-window localhost/antrian_bri_console/kios


@REM start "" "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe" --kiosk --user-data-dir=%TEMP%/monitor0 --window-position=1920,0 --private-window localhost/antrian_bri_console/kios
@REM start "" "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe" --kiosk --user-data-dir=%TEMP%/monitor1 --window-position=0,0 --private-window localhost/antrian_bri_console
