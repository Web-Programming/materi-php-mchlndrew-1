<?php
namespace Kendaraan;

//Cara penulisan class Mobil
class Mobil{
    //Cara Penulisan property
    public $warna;
    public $merk;

    //Cara Penulisan method
    function maju(){
        // isi method maju()
        return "Mobil maju";
    }


    function berhenti(){
        // Isi method berhenti()
        return "Mobil Berhenti";   
    }
}
use Kendaraan\Mobil;

// instansiaisi object dari namespace alias
$mobil_ahmad = new Mobil();

// instansiaisi object
//$mobil_ahmad = new Mobil();
$mobil_anton = new Mobil();

// set property
$mobil_ahmad->warna="Hitam";
$mobil_anton->merk="toyota";

// tampilkan property
echo "Mobil Ahmad";
echo "<br>Warna :".$mobil_ahmad->warna;
echo "<br>Merk :".$mobil_ahmad->merk;

//tampilan method
echo $mobil_ahmad->maju();
echo "<br>";
echo $mobil_ahmad->berhenti();
?>
