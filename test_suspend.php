<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

echo "=== TESTING SUSPEND STATUS ===\n\n";

$allSellers = User::where('role', 'seller')->get();

echo "Total Sellers: " . $allSellers->count() . "\n\n";

foreach ($allSellers as $seller) {
    echo "- {$seller->nama_toko} ({$seller->nama}): {$seller->status}\n";
}

echo "\n=== STATUS BREAKDOWN ===\n";
echo "Approved: " . User::where('role', 'seller')->where('status', 'approved')->count() . "\n";
echo "Pending: " . User::where('role', 'seller')->where('status', 'pending')->count() . "\n";
echo "Rejected: " . User::where('role', 'seller')->where('status', 'rejected')->count() . "\n";
echo "Suspend: " . User::where('role', 'seller')->where('status', 'suspend')->count() . "\n";
