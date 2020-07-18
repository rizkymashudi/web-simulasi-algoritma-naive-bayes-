<?php
namespace App\Helpers;

class Bayes{

    private $DataTraining = "data.json";


    /* =========================================== 
            FUNCTION SUM TRUE DAN FALSE
    ============================================ */

    function sumTrue(){
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
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
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
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
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
        $hasil= json_decode($data, true);
        
        return count($hasil);
    }
    
    // ===================== END SUM TRUE FALSE ==================== //



    /* ==================================================
                    FUNCTION PROBABILITAS
    =================================================== */

    function probUmur($umur, $status){
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
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
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
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

    function probBeratB($bb, $status){
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['berat_badan'] == $bb && $hs['status'] == $status):
                $t += 1;
            elseif($hs['berat_badan'] == $bb && $hs['status'] == $status):
                $t += 1;
            endif;
        endforeach;

        return $t;
    }

    function probPendidikan($pendidikan, $status)
    {
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
        $hasil= json_decode($data, true);

        $t = 0;
        foreach($hasil as $hs):
            if($hs['pendidikan'] == $pendidikan && $hs['status'] == $status):
                $t += 1;
            elseif($hs['pendidikan'] == $pendidikan && $hs['status'] == $status):
                $t += 1;
            endif;
        endforeach;
        
        return $t;
    }


    function probKesehatan($kesehatan,$status)
    {
        $DT = \storage_path($this->DataTraining);
        $data = file_get_contents($DT);
        $hasil = json_decode($data,true);

        $t = 0;
        foreach ($hasil as $hs) {
        if($hs['kesehatan'] == $kesehatan && $hs['status'] == $status){
            $t += 1;
        }else if($hs['kesehatan'] == $kesehatan && $hs['status'] == $status){
            $t +=1;
        }
        }
        return $t;
    }

    // ========================= END PROBABILITY ========================= //



    /* =============================================================
        LETS COUNTING
        keterangan parameter :
        $sT :   jumlah data yang bernilai true  //sumTrue
        $sF :   jumlah data yang bernilai false //sumFalse 
        $sD :   jumlah data pada data training  //sumData
        $pU :   jumlah probability umur         //probUmur
        $pT :   jumlah probability tinggi       //probTinggi
        $pBB:   jumlah probability berat badan  //probBB
        $pK :   jumlah probability kesehatan    //probKesehatan
        $pP :   jumlah probability pendidikan   //probPendidikan
    ============================================================== */

    function hasilTrue($sT =0, $sD = 0, $pU = 0, $pT = 0, $pBB = 0, $pK = 0, $pP = 0){
        
        $paTrue = $sT / $sD;
        $p1     = $pU / $sT;
        $p2     = $pT / $sT;
        $p3     = $pBB/ $sT;
        $p4     = $pK / $sT;
        $p5     = $pP / $sT;

        $hsl    = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5;
        return $hsl; 
    }

    function hasilFalse($sF = 0, $sD = 0, $pU = 0, $pT = 0, $pBB = 0, $pK = 0, $pP = 0){

        $paFalse = $sF / $sD;
        $p1      = $pU / $sF;
        $p2      = $pT / $sF;
        $p3      = $pBB / $sF;
        $p4      = $pK / $sF;
        $p5      = $pP / $sF;

        $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5;

        return $hsl;
    }

    function perbandingan($pATrue, $pAFalse){
        if($pATrue > $pAFalse):
            $stt    = "DITERIMA";
            $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
            $diterima = 100 - $hitung;

        elseif($pAFalse > $pATrue):
            $stt = "DITOLAK";
            $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
            $diterima = 100 - $hitung;
        endif;

       $hsl = array($stt, $hitung, $diterima);
       
       return $hsl; 
    }

    // ============================================================================= // 
}
?>