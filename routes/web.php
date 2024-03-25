<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Livewire\Volt\Volt;
Route::view('/', 'welcome');
Route::get('/test',function(){
   
    $url="http://localhost/api/list/";
    $client = new Client(['base_uri' => 'http://localhost',
    'timeout'  => 2.0]);
    $options = [
        'http_errors' => true,
        'force_ip_resolve' => 'v4',
        'connect_timeout' => 2,
        'read_timeout' => 2,
        'timeout' => 20000,
    ];
    $result = $client->request('GET','/api/list',$options);
    $result = (string) $result->getBody();
    $result = json_decode($result, true);
    return $result;
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::view('customers/list', 'customers.index')
    ->middleware(['auth', 'verified'])
    ->name('customers.index');
Route::view('customers/create', 'customers.create')
    ->middleware(['auth', 'verified'])
    ->name('customers.create');
Volt::route('customers/{customer}/edit', 'customers.edit-customer')
    ->middleware(['auth'])
    ->name('customers.edit');
Route::view('invoices/list', 'invoices.index')
    ->middleware(['auth', 'verified'])
    ->name('invoices.index');
Route::view('invoices/create', 'invoices.create')
    ->middleware(['auth', 'verified'])
    ->name('invoices.create');
Volt::route('invoices/{invoice}/edit', 'invoices.edit-invoice')
    ->middleware(['auth'])
    ->name('invoices.edit');

require __DIR__.'/auth.php';
