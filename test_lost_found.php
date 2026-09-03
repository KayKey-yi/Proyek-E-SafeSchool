<?php
// Test script to verify lost & found views render properly
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Create a test request for lost & found form
$request = \Illuminate\Http\Request::create('/lost-and-found/lapor', 'GET');
$response = $kernel->handle($request);

if ($response->status() === 302) {
    echo "✓ Lost & Found form route exists and redirects (auth required) - Status 302\n";
} elseif ($response->status() === 200) {
    echo "✓ Lost & Found form page renders successfully (200 OK)\n";
} else {
    echo "✗ Lost & Found form page returned: " . $response->status() . "\n";
}

// Test success page view syntax
try {
    view('user.lost_and_found.success')->render();
    echo "✓ Lost & Found success page view is syntactically correct\n";
} catch (\Exception $e) {
    echo "✗ Lost & Found success page error: " . $e->getMessage() . "\n";
}

$kernel->terminate($request, $response);
