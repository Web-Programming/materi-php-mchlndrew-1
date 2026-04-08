<?php
namespace App\Produk;
class Item{
    public $nama;
    public function_construct($nama){
        $this->nama = $nama;
    }
    public function info(){
        return "Servicek: " . $this->nama;

    }

}