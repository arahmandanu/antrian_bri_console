<?php

echo getcwd();
$path = realpath(__DIR__) . "\\run_call";
system("cmd /c $path");
