@extends('frontend.backoffice')
@section('content')

<!-- CONTENT -->
<br><br>
<div class="container">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />

                                @foreach($getData as $row)
                                <div class="col-lg-6">
                                    <div class="kotak text-center">
                                            <label><h3>{{$row->namaDokter}}</h3></label><br>
                                            <label>{{$row->namars}}</label><br>
                                            <label>{{$row->alamatrs}}</label><br>
                                            <a href="{{url('konsultasi/konsul/'.$row->idDokter)}}">
                                                <button type="button" class="btn btn-info">Konsultasi</button>
                                            </a><br>
                                        <hr>
                                    </div>
                                </div>
                                @endforeach


</div>
    <br><br>
@endsection