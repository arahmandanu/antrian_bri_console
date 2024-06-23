<?php
$xtmbhan = "dua";
$xtest = "C:\wamp64\www\antrianpreview\suara\ ";
$xtest = trim($xtest) . $xtmbhan;



exec('D:\projekan\tes\antrianterbaru\antrianpreview\ss.exe');



exec('powershell -c (New-Object Media.SoundPlayer ' . $xtest . '.wav").PlaySync();');
exec('powershell -c (New-Object Media.SoundPlayer "D:\projekan\tes\antrianterbaru\antrianpreview\suara\1.wav").PlaySync();');
exec('powershell -c (New-Object Media.SoundPlayer "C:\wamp64\www\antrianpreview\suara\delapan.wav").PlaySync();');
exec('powershell -c (New-Object Media.SoundPlayer "C:\wamp64\www\antrianpreview\suara\puluh.wav").PlaySync();');
exec('powershell -c (New-Object Media.SoundPlayer "C:\wamp64\www\antrianpreview\suara\sembilan.wav").PlaySync();');
echo $xtest;
echo "berhasil";
