@extends('frontend.backoffice')
@section('content')

    <div class="container">
        <form action="{{url('dokter/submit')}}" method="post">

            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            @foreach($getData as $row)
                <div class="form-group"><input type="hidden" name="idKonsultasi" value="{{$row->idKonsultasi}}" class="form-control" /><br /></div>
                <div class="form-group"><label>Member: </label> {{ Auth::user()->name }}<br /></div>
                <div class="form-group"><label>Pesan: </label> {{$row->pesan}}<br /></div>
                <div class="form-group">Balasan<textarea name="balasan" id="balasan" class="form-control"></textarea></div>
            @endforeach
            <input type="submit" value="Kirim" class="btn btn-success">
        </form>
        <br />
    </div>

@endsection