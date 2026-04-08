<?php
require_once "app/produk/Item.php";
include "app/service/Item.php";

//Menggunakan alias untuk menghindari konflik nama 
use App\Produk\Item as ProdukItem;
use App\Service\Item as ServiceItem;

//Membuat instance
$produk = new ProdukItem("Laptop");
$service = new ServiceItem("Perbaikan Laptop");

// Menampilkan hasil
echo $produk->info()."\n";
echo $service->info();