<?php 
class Mahasiswa {
    var $name;
    var $nim;
    var $rombel;

    function new (){
        echo "Hello my name $this->name, my nim is $this->nim and im from $this->rombel";
    }
}

$Maha = new Mahasiswa();
$maha->name = "Tegar Asayahanda Firdaus";
$maha->nim = "0110223175";
$maha->rombel = "TI06";
$maha->new();



?>