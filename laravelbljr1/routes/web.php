<?php

use Illuminate\Support\Facades\Route;

//Route ke halaman utama (home)
Route::get('/', function () {
    echo "Hallo Nama saya Andrew";
    //return view('welcome');
});
//Route ke halaman alamat
Route::get('/alamat', function(){
    echo "Jalan Kolonel Atmo 12. Palembang";
});

Route::get('/path1/path2/detail', function(){
    echo "Jalan Kolonel Atmo 12. Palembang";
    echo "<br>";
    echo "Rt. 01 Rw. 02";
    echo "<br>";
    echo "Kecamatan Ilir Timur 1";
    echo "<br>";
    echo "Kota Palembang";
    echo "<br>";
    echo "Provinsi Sumatera Selatan";
});