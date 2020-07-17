<?php

class Bayes{

    private $DataTraining = "data.json";


    /* =========================================== 
            FUNCTION SUM TRUE DAN FALSE
    ============================================ */

    function sumTrue(){
        $data = file_get_contents($this->DataTraining);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['status'] == 1):
                $t += 1;
            endif;
        endforeach;

        return $t;
    }

    function sumFalse(){
        $data = file_get_contents($this->DataTraining);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['status'] == 0):
                $t += 1;
            endif;
        endforeach;

        return $t;
    }

    function sumData(){
        $data = file_get_contents($this->DataTraining);
        $hasil= json_decode($data, true);
        
        return count($hasil);
    }
    

    /* ==================================================
                    FUNCTION PROBABILITAS
    =================================================== */

    function probUmur($umur, $status){
        $data = file_get_contents($this->DataTraining);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['umur'] == $umur && $hs['status'] == $status):
                $t += 1;
            elseif($hs['umur'] == $umur && $hs['status'] == $status):
                $t += 1;
            endif;
        endforeach;

        return $t;
    }

    function probTinggi($tinggi, $status){
        $data = file_get_contents($this->DataTraining);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['tinggi'] == $tinggi && $hs['status'] == $status):
                $t += 1;
            elseif($hs['tinggi'] == $tinggi && $hs['status'] == $status):
                $t += 1;
            endif;
        endforeach;

        return $t;
    }

    
}
?>