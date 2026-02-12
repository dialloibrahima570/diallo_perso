<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    //
}


use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::create([
    'name' => 'diallo',
    'email' => 'camarafta570@gmail.com',
    'password' => Hash::make('DIALLO'),
]);
