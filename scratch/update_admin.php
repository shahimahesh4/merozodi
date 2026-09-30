<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('role', 'super_admin')->first() ?: User::find(1);

if ($user) {
    $user->email = 'shahimahesh4@gmail.com';
    $user->password = Hash::make('Mahesh@9843##');
    $user->save();

    echo "SUCCESS: Super Admin (ID: {$user->id}) updated.\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role: {$user->role}\n";
    echo "Password check: " . (Hash::check('Mahesh@9843##', $user->password) ? 'VALID' : 'INVALID') . "\n";
} else {
    echo "ERROR: Super admin user not found.\n";
}
