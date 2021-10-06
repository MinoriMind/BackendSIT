<?php

function myAutoload(string $className)
{
    $path = str_replace('Message\\', DIRECTORY_SEPARATOR, $className);
    require_once __DIR__ . "/src/$path.php" ;
}

spl_autoload_register('myAutoload');
$privateMessage = new \Message\PrivateMessage("text", "Cat");
$privateMessage->sent();

$publicMessage = new \Message\PublicMessage("text");
$publicMessage->sent();
?>
