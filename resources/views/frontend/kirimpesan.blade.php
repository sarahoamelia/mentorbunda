@extends('frontend.backoffice')
@section('content')

    <!-- CONTENT -->
    <br><br>
    <form action="{{url('/konsultasi/submit')}}" method="post">
    <div class="container">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <input type="hidden" name="idDokter" class="form-control" value="{{$row->idDokter}}" /><br />
            <div class="form-group"><label>Nama Dokter : {{$row->namaDokter}}</label><br /></div>
            <div class="form-group"><input type="hidden" name="idKonsultasi" class="form-control" /><br />
                <input type="hidden" name="idDokter" class="form-control" value="{{$row->id}}" /><br />
                <label>Pesan</label><textarea class="form-control" id="pesan" name="pesan" required="Isi kolom pesan!"></textarea></div>
            <input type="submit" value="OK" class="btn btn-success">
            @endforeach


    </div>
    <br><br>
@endsection