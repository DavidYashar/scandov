<?php
function autoLoader($className) {
    $file =  __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "File not found: $file\n";
    }
}

spl_autoload_register('autoLoader');


?>