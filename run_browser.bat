

@REM start msedge --app=http://localhost/antrian_bri_console/kios --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --new-window --user-data-dir=%TEMP%/monitor1 --edge-kiosk-type=fullscreen
@REM start msedge --app=http://localhost/antrian_bri_console/ --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --new-window --user-data-dir=%TEMP%/monitor0 --edge-kiosk-type=fullscreen


start firefox --kiosk --user-data-dir=%TEMP%/monitor1 --window-position=0,1920 -new-tab localhost/antrian_bri_console
start firefox --kiosk --user-data-dir=%TEMP%/monitor0 --window-position=1920,0 -new-tab localhost/antrian_bri_console/kios


@REM start "" "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe" --kiosk --user-data-dir=%TEMP%/monitor0 --window-position=1920,0 --private-window localhost/antrian_bri_console/kios
@REM start "" "C:\Program Files\BraveSoftware\Brave-Browser\Application\brave.exe" --kiosk --user-data-dir=%TEMP%/monitor1 --window-position=0,0 --private-window localhost/antrian_bri_console

@REM start msedge --app=http://localhost/antrian_bri_console/kios --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --new-window --user-data-dir=%TEMP%/monitor0 --edge-kiosk-type=fullscreen
@REM start msedge --app=http://localhost/antrian_bri_console/ --kiosk --no-first-run --autoplay-policy=no-user-gesture-required --user-data-dir=%TEMP%/monitor1 --edge-kiosk-type=fullscreen
