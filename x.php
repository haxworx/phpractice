<?php


try {
    throw new \Exception('Hello World');
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
}
throw new \InvalidArgumentException('Hello World');
