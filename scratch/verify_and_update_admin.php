<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$users = User::all();
echo "Total users in DB: " . $users->count() . "\n";
foreach ($users->take(5) as $u) {
    echo "ID: {$u->id}, Name: {$u->name}, Email: {$u->email}, Role: {$u->role}\n";
}

$user = User::where('email', 'shahimahesh4@gmail.com')->first();
if (!$user) {
    $user = User::where('email', 'admin@merozodi.com')->first();
}
if (!$user) {
    $user = User::find(1);
}

if ($user) {
    $user->email = 'shahimahesh4@gmail.com';
    $user->role = 'super_admin';
    $user->password = Hash::make('Mahesh@9843##');
    $user->save();
    echo "\nConfirmed Super Admin:\n";
    echo "ID: {$user->id}\n";
    echo "Email: {$user->email}\n";
    echo "Role: {$user->role}\n";
    echo "Password Check: " . (Hash::check('Mahesh@9843##', $user->password) ? 'MATCH' : 'FAILED') . "\n";
} else {
    echo "\nCreating new Super Admin...\n";
    $user = User::create([
        'name' => 'Mahesh Shahi',
        'email' => 'shahimahesh4@gmail.com',
        'password' => Hash::make('Mahesh@9843##'),
        'role' => 'super_admin',
        'gender' => 'male',
        'is_verified' => true,
        'is_premium' => true,
        'status' => 'active',
    ]);
    echo "Created Super Admin ID: {$user->id}\n";
}
