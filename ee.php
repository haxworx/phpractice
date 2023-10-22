<?php




function listFiles($directory) {
    $files = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::LEAVES_ONLY,
        RecursiveIteratorIterator::CATCH_GET_CHILD
    );

    foreach ($iterator as $object) {
        if ($object->isReadable() && $object->isFile()) {
            $files[] = $object->getPathname();
        }
    }

    return $files;
} 

$files = listFiles("/");
print_r($files);
