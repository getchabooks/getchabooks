<?php

$threshold = 1073741824;
$free = disk_free_space("/");

if ($free < $threshold) {    
    $gbMailer->FromName = "GetchaBooks Disk Monitor";
    $gbMailer->AddAddress("mwhite@getchabooks.com");
    $gbMailer->AddAddress("rmondello@getchabooks.com");
    $gbMailer->AddAddress("mwalker@getchabooks.com");
    $gbMailer->Subject = "GetchaBooks Disk Warning";
    $gbMailer->Body = "Disk space on the GetchaBooks server is low.\n\nFree space: " . ($free/1000000) . "MiB";
    $gbMailer->Send();
}
