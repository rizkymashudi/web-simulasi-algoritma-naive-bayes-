@extends('index')

@section('content')
    {{-- MAIN CONTENT --}}
    <div class="container" style="margin-top: 90px">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="tebal">Naive Bayes</h2>
                <p>
                    Algoritma Naive Bayes merupakan sebuah metoda klasifikasi menggunakan metode probabilitas dan statistik yg dikemukakan oleh ilmuwan Inggris Thomas Bayes. Algoritma Naive Bayes memprediksi peluang di masa depan berdasarkan pengalaman di masa sebelumnya sehingga dikenal sebagai Teorema Bayes. Ciri utama dr Naïve Bayes Classifier ini adalah asumsi yg sangat kuat (naïf) akan independensi dari masing-masing kondisi / kejadian.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-4">
                <h3 class="tebal"> Simulasi probabilitas </h3>
            </div>

            {{-- form input --}}
            <div class="col-6">
                <form action="{{ route('simulasi-create') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                        <label for="umur">Umur :</label>
                        <select name="umur" id="umur" class="form-control selBox" required="required">
                        <option value="" disabled selected>-- pilih umur anda--</option>
                            <?php
                                for($i=20 ; $i <= 25 ; $i++){
                                    echo"<option value='$i' name='umur'>$i</option>";
                                }
                            ?>
                        </select>
                        <span id="lblErrorUmur" style="color: red"></span>
                    </div>
                    

                    <div class="form-group">
                        <label for="umur">Tinggi Badan :</label>
                        <select name="tinggi" id="tinggi" class="form-control selBox" required="required">
                        <option value="" disabled selected>-- pilih tinggi--</option>
                            <option value="kt" name="kt">Kurang Tinggi ( < 150 cm - 159 cm )</option>
                            <option value="ideal" name="ideal">Ideal ( 160 cm - 167 cm )</option>
                            <option value="st" name="st">Sangat Tinggi ( >167 cm )</option>
                        </select>
                        <span id="lblErrorTB" style="color: red"></span>
                    </div>

                    <div class="form-group">
                        <label for="umur">Berat Badan :</label>
                        <select name="beratB" id="beratB" class="form-control selBox" required="required">
                        <option value="" disabled selected>-- pilih berat badan--</option>
                            <option value="kurus" name="kurus">Kurus ( < 50 kg - 55 kg )</option>
                            <option value="ideal" name="ideal">Ideal ( 56 kg - 60 kg )</option>
                            <option value="tambun" name="tambun">Tambun ( >61 kg )</option>
                        </select>
                        <span id="lblErrorBB" style="color: red"></span>
                    </div>

                    <div class="form-group">
                        <label for="umur">Status Kesehatan :</label>
                        <select name="kesehatan" id="kesehatan" class="form-control selBox" required="required">
                        <option value="" disabled selected>-- pilih status kesehatan--</option>
                            <option value="sehat" name="sehat">Sehat</option>
                            <option value="tidak_sehat" name="tidak sehat">Tidak Sehat</option>
                        </select>
                        <span id="lblErrorSK" style="color: red"></span>
                    </div>

                    <div class="form-group">
                        <label for="umur">Pendidikan :</label>
                        <select name="pendidikan" id="pendidikan" class="form-control selBox" required="required">
                        <option value="" disabled selected>-- pilih pendidikan--</option>
                            <option value="sma" name="sma">SMA</option>
                            <option value="smk" name="smk">SMK</option>
                            <option value="s1" name="s1">S1</option>
                        </select>
                        <span id="lblErrorPD" style="color: red"></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-primary mt-3" id="dor" onclick="return simulasi()"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- HASIL --}}
    <div class="row">
        <div class="col-12 mt-5 mb-5">
            <div id="hasilSIM" class="container">
              
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            $('.toggle').click(function(){
                $('ul').toggleClass('active');
            });
        });


        //validate
        function simulasi()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var umur = $("#umur").val();
            var tinggi_badan = $("#tinggi").val();
            var berat_badan = $("#beratB").val();
            var status_kesehatan = $("#kesehatan").val();
            var pendidikan = $("#pendidikan").val();

            //validasi
            var um = document.getElementById("umur");
            var tb = document.getElementById("tinggi");
            var bb = document.getElementById("beratB");
            var sk = document.getElementById("kesehatan");
            var pp = document.getElementById("pendidikan");

            if(um.selectedIndex == 0){
                $("#lblErrorUmur").html('umur tidak boleh kosong');
            return false;
            }

            if(tb.selectedIndex == 0){
                $("#lblErrorTB").html("Tinggi Badan Tidak Boleh Kosong");
            return false;
            }

            if(bb.selectedIndex == 0){
                $("#lblErrorBB").html("Berat Badan Tidak Boleh Kosong");
            return false;
            }

            if(sk.selectedIndex == 0){
                $("#lblErrorSK").html("Status Kesehatan Tidak Boleh Kosong");
            return false;
            }

            if(pp.selectedIndex == 0){
                $("#lblErrorPD").html("Pendidikan Tidak Boleh Kosong");
            return false;
            }
            
            //send data to controller using ajax
            $.ajax({
                url: '{{ route("simulasi-create") }}',
                type: 'POST',
                dataType: 'html',
                data: {
                    umur : umur,
                    tinggi_badan : tinggi_badan,
                    berat_badan : berat_badan,
                    status_kesehatan : status_kesehatan,
                    pendidikan : pendidikan
                },
                success: function(data){
                    var obj = JSON.parse(data);
                    console.log(obj.resultcontent);
                    document.getElementById("hasilSIM").innerHTML = data;
                    $('#hasilSIM').html(obj.resultcontent);
                },
            });

            return false;
        }

        // $(document).ready(function(){
        // $('#dor').click(function(){
        //     $('html, body').animate({
        //         scrollTop: $("#hasilSIM").offset().top
        //     }, 500);
        // });
        // });
    </script>
@endsection