<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Bayes;

class simulasiController extends Controller
{
    public function index(){
        return view('pages.home');
    }

    public function simulate(Request $request){
        //call class bayes
        $obj = new Bayes();

        //declare function from class NaiveBayes
        $jumTrue = $obj->sumTrue();
        $jumFalse= $obj->sumFalse();
        $jumData = $obj->sumData();

        if($request->ajax()):
            //request from ajax
            $age       =   $request->umur;
            $height    =   $request->tinggi_badan;
            $weight    =   $request->berat_badan;
            $healthy   =   $request->status_kesehatan;
            $education =   $request->pendidikan;
        endif;
        
        //TRUE
        $umurT       = $obj->probUmur($age, 1);
        $tinggiT     = $obj->probTinggi($height, 1);
        $bbT         = $obj->probBeratB($weight, 1);
        $kesehatanT  = $obj->probKesehatan($healthy, 1);
        $pendidikanT = $obj->probPendidikan($education, 1);

        //FALSE
        $umurF      =   $obj->probUmur($age, 0);
        $tinggiF    =   $obj->probTinggi($height, 0);
        $bbF        =   $obj->probBeratB($weight, 0);
        $kesehatanF =   $obj->probKesehatan($healthy, 0);
        $pendidikanF=   $obj->probPendidikan($education, 0);

        //RESULT
        $paT    =   $obj->hasilTrue($jumTrue, $jumData, $umurT, $tinggiT, $bbT, $kesehatanT, $pendidikanT);
        $paF    =   $obj->hasilFalse($jumFalse, $jumData, $umurF, $tinggiF, $bbF, $kesehatanF, $pendidikanF);

        if($height == "kt"):
            $height = "Kurang Tinggi";
        elseif($height == "st"):
            $height = "Sangat Tinggi";
        endif;

        $response =     "<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
                            <div class='container'>
                            <h1 class='display-4 tebal'>Hasil Prediksi</h1>
                            <p class='lead'>Berikut ini adalah hasil prediksi berdasarkan masukan calon pegawai menggunakan metode naive bayes.</p>
                            </div>
                        </div>";

        $response .=    "<div class='card' style='width: 25rem;'>
                            <div class='card-header' style='background-color:#17a2b8;color:#fff'>
                            <b>Informasi Calon Pegawai</b>
                            </div>
                            <ul class='list-group list-group-flush'>
                            <li class='list-group-item'>umur : &nbsp;&nbsp;<b>$age</b></li>
                            <li class='list-group-item'>tinggi : &nbsp;&nbsp;<b>$height</b></li>
                            <li class='list-group-item'>berat badan : &nbsp;&nbsp;<b>$weight</b></li>
                            <li class='list-group-item'>kesehatan : &nbsp;&nbsp;<b>$healthy</b></li>
                            <li class='list-group-item'>pendidikan : &nbsp;&nbsp;<b>$education</b></li>
                            </ul>
                        </div><br>
                        <hr>";
        
        $response .=    "<table class='table table-bordered' style='font-size:18px;text-align:center'>
                            <tr style='background-color:#17a2b8;color:#fff'>
                                <th>Jumlah True</th>
                                <th>Jumlah False</th>
                                <th>Jumlah Total Data</th>
                            </tr>
                            <tr>
                                <td>$jumTrue</td>
                                <td>$jumFalse</td>
                                <td>$jumData</td>
                            </tr>
                        </table>";

        $response .=    "<br>
                        <table class='table table-bordered' style='font-size:18px;text-align:center'>
                            <tr style='background-color:#17a2b8;color:#fff'>
                                <th></th>
                                <th>True</th>
                                <th>False</th>
                            </tr>
                            <tr>
                                <td>pA</td>
                                <td>$jumTrue / $jumData</td>
                                <td>$jumFalse / $jumData</td>
                            </tr>
                            <tr>
                                <td>Umur</td>
                                <td>$umurT / $jumTrue</td>
                                <td>$umurF / $jumFalse</td>
                            </tr>
                            <tr>
                                <td>Tinggi Badan</td>
                                <td>$tinggiT / $jumTrue</td>
                                <td>$tinggiF / $jumFalse</td>
                            </tr>
                            <tr>
                                <td>Berat Badan</td>
                                <td>$bbT / $jumTrue</td>
                                <td>$bbF / $jumFalse</td>
                            </tr>
                            <tr>
                                <td>Status Kesehatan</td>
                                <td>$kesehatanT / $jumTrue</td>
                                <td>$kesehatanF / $jumFalse</td>
                            </tr>
                            <tr>
                                <td>Pendidikan</td>
                                <td>$pendidikanT / $jumTrue</td>
                                <td>$pendidikanF / $jumFalse</td>
                            </tr>
                        </table>";

        $response .=    "<br>
                        <table class='table table-bordered' style='font-size:18px;text-align:center;'>
                            <tr style='background-color:#17a2b8;color:#fff'>
                                <th>Presentasi Diterima</th>
                                <th>Presentasi Ditolak</th>
                            </tr>
                            <tr>
                                <td>$paT</td>
                                <td>$paF</td>
                            </tr>
                        </table>";

        $result =   $obj->perbandingan($paT, $paF);

        if($paT > $paF):
            $response .= "<br>
                        <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>DITERIMA</b></span> LEBIH BESAR DARI PADA PRESENTASI DITOLAK</h3><br";

            $response .= "<h4><br>Presentasi diterima sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi ditolak sebanyak : <b>".round($result[2],2)." % </b></h4>";
        
        elseif($paF > $paT):
            $response .= "<br>
                        <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>DITOLAK</b></span> LEBIH BESAR DARI PADA PRESENTASI DITERIMA</h3><br>";
            
            $response .= "<h4><br>Presentasi ditolak sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi diterima sebanyak : <b>".round($result[2],2)." % </b></h4>";
        endif;

        if($result[0] == "DITERIMA"):
            $response .= "<div class='alert alert-success mt-5' role='aler'>
                            <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
                            <p>Selamat ! berdasarkan hasil prediksi , anda dinyatakan <b>diterima!</b></p>
                            <hr>
                            <p class='mb-0'>- Have a nice day -</p>
                            </div>";
        else:
            $response .= "<div class='alert alert-danger mt-5' role='aler'>
                            <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
                            <p>Maaf, berdasarkan hasil prediksi , anda dinyatakan <b>ditolak!</p>
                            <hr>
                            <p class='mb-0'>- Don't give up ! -</p>
                            </div>";
        endif;

        return json_encode([
            "resultcontent" => $response
        ]);
    }
}
