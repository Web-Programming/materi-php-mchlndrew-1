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
//Route ke /path1/path2/detail
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

//Route dinamis dengan parameter id
Route::get('/user1/{id}', function($id){
    echo "User ID: ".$id;
});
//Route dinamis dengan parameter nama
Route::get('/user2/{name}', function($name){
    echo "User Name: ".$name;
});
//Route dinamis dengan parameter nama
Route::get('/user3/{name?}', function($name = 'Tamu'){
    echo "User Name: ".$id;
});
//Route dinamis dengan parameter nama dan id
Route::get('/user4/{id}/{nam}', function($id,$name){
    echo "User ID: ".$id;
    echo "<br>";
    echo "User Name: " . $name;
});

// Route demgan metode POST
Route::post('/simpan', function(){
    echo "Data Berhasil Disimpan";
});

// Route demgan metode PUT
Route::put('/update/{id}', function($id){
    echo "Data Berhasil Diperbarui dengan ID: " . $id;
});
// Route demgan metode Patch
Route::patch('/update/2{id}', function($id){
    echo "Data Berhasil Diperbarui dengan ID: " . $id;
});
// Route demgan metode Delete
Route::delete('/hapus/{id}', function($id){
    echo "Data Berhasil Dihapus dengan ID: " . $id;
});
// Route untuk menampilkan halaman test_method
Route::get('/test-method', function(){
    return view ('test_method');
});

// Menampilkan Halaman Profil 
Route::get('/profil', function(){
    return view ("myprofile");
});
//gunakan untuk memisahkan folder dengan view
//Route::get('/detailproduk', function(){
//    return view ("produk.detail");
//});

// Mengirim data ke view 
Route::get('/detailproduk/{name}', function($name){
    return view ("produk.detail", 
        ['product_name' => $name,
        'id'=>101,
        'color'=> "silver",
        'stock'=>12
        ]
    );
});