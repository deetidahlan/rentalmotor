<?php

class Data{
    public $member;
    public $jenis;
    public $waktu;
    public $diskon;
    public $pajak;
    private $Scooter = 0;
    private $Sport = 0;
    private $SportTouring = 0;
    private $Cross = 0;
    private $listmember = ['abyan', 'ferdy', 'fatih', 'panji', 'kenjo', 'attala', 'daniel', 'adit', 'fauzan', 'dennis', 'rizal', 'whildan', 'arizqy', 'khylmi'];

    function __construct(){
        $this->pajak = 10000;
    }

    public function getMember(){
        if (in_array($this->member, $this->listmember)){
            return "member";
        } else {
            return "non member";
        }
    }

    public function setHarga($jenis1, $jenis2, $jenis3, $jenis4){
        $this->Scooter = $jenis1;
        $this->Sport = $jenis2;
        $this->SportTouring = $jenis3;
        $this->Cross = $jenis4;
    }

    public function getHarga(){
        $data["Scooter"] = $this->Scooter;
        $data["Sport"] = $this->Sport;
        $data["SportTouring"] = $this->SportTouring;
        $data["Cross"] = $this->Cross;
        return $data;
    }
}

class Rental extends Data {
    public function HargaRental(){
        $DataHarga = $this->getHarga()[$this->jenis];
        $diskon = $this->getMember() == "member" ? 5 : 0;
        if ($this->waktu === 1){
            $bayar = ($DataHarga - ($DataHarga * $diskon / 100)) + $this->pajak;
        } else {
            $bayar = (($DataHarga * $this->waktu) - ($DataHarga * $diskon / 100)) + $this->pajak;
        }
        return [$bayar, $diskon];
    }

    public function pembayaran(){
        echo"<center>";
        echo $this->member . " berstatus sebagai " . $this->getMember() . " mendapatkan diskon sebesar " . $this->HargaRental()[1] . "%";
        echo "<br />";
        echo "Jenis motor yang dirental adalah " . $this->jenis . " selama " . $this->waktu . " hari";
        echo "<br />";
        echo "Harga rental per-harinya : Rp. " . number_format($this->getHarga()[$this->jenis], 0, '', '.');
        echo "<br />";
        echo "<br />";
        echo "Besar yang harus dibayarkan adalah Rp. " . number_format($this->HargaRental()[0], 0, '', '.');
        echo "</center>";
    }
}

?>