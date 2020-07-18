@extends('index')

@section('content')
    {{-- MAIN CONTENT --}}
    <div class="container" style="margin-top: 90px">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="tebal">List Data Latih</h2><br>
                <p class="desc">Berikut ini adalah data latih yang saya gunakan dalam membuat simulasi kemungkinan diterimanya calon pendaftar PT.KAI menggunakan metode naive bayes. Data ini dikumpulkan melalui metode wawancara dan melakukan riset kepada narasumber.</p><br>
                
                <table id="dataLatih" class="display pt-3 mb-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Umur</th>
                            <th>Berat Badan</th>
                            <th>Pendidikan</th>
                            <th>Tinggi Badan</th>
                            <th>Status Kesehatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection