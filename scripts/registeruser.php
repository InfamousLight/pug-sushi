<?php
require __DIR__ . '../vendor/autoload.php';
//use App\User;
//use App\Http\Controllers\Controller;

print_r($argv);

$test  = DB::table('users')->get();

print_r($test);

//DB::create([
//    'name' => $argv[1],
//    'email' => $argv[2],
//    'password' => bcrypt($argv[3]),
//]);