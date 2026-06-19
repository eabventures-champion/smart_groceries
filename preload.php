<?php
/**
 * OPcache Preload Script for Smart Groceries
 * 
 * This script pre-compiles frequently used PHP files into OPcache
 * on server startup, eliminating the cold-start penalty.
 * 
 * Usage: Set opcache.preload in php.ini to this file path
 * Note: Only works with php-fpm/apache, NOT with php -S (built-in server)
 */

require_once __DIR__ . '/vendor/autoload.php';

// Preload Laravel framework core files
$directories = [
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Foundation',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Routing',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/View',
    __DIR__ . '/app',
    __DIR__ . '/config',
];

$count = 0;
foreach ($directories as $dir) {
    if (!is_dir($dir)) continue;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );
    foreach ($iterator as $file) {
        if ($file->getExtension() === 'php') {
            try {
                opcache_compile_file($file->getRealPath());
                $count++;
            } catch (\Throwable $e) {
                // Skip files that can't be preloaded
            }
        }
    }
}

echo "Preloaded {$count} files\n";
