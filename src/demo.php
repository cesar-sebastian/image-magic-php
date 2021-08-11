<?php
require __DIR__ . './../vendor/autoload.php';

use Orbitale\Component\ImageMagick\Command;

//Windows
$command = new Command('C:\ImageMagick-7.1.0-Q16-HDRI\magick.exe');

//Linux
//$command = new Command('/usr/bin/convert');

$response = $command
    ->convert('background.png')
    ->output('background-target.png')
    ->quality(60)
    ->run()
;

// Check if the command failed and get the error if needed
if ($response->hasFailed()) {
    throw new Exception('An error occurred:'.$response->getError());
} else {
    // If it has not failed, then we simply send it to the buffer
    header('Content-type: image/png');
    echo file_get_contents('background-target.png');
}