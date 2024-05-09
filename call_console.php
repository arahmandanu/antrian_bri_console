<?php

$parent_path = realpath(__DIR__);
$path = realpath(__DIR__).'\\run_call.bat';
// echo $parent_path, ' || ', $path;
// echo public_path();
system("cmd /c $path $parent_path");
