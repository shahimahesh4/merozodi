<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$consoleKernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$consoleKernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

$user = User::where('role', 'super_admin')->first() ?: User::first();
echo "Found User: " . $user->name . " (" . $user->email . ")\n";

Auth::login($user);

$httpKernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $httpKernel->handle($request = Request::create('/stnapanel', 'GET'));
echo "FILAMENT HTTP STATUS: " . $response->getStatusCode() . "\n";
echo "Header Clock Rendered: " . (str_contains($response->getContent(), 'updateClock') ? 'YES' : 'NO') . "\n";
