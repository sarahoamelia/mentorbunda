@extends('backend.backoffice')
@section('content')

    <form action="{{url('/admin/artikel/submit')}}" method="post">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <div class="form-group"><input type="hidden" name="idArtikel" value="{{$row->idAcara}}" class="form-control" /><br /></div>
            <div class="form-group">Nama Acara<input type="text" name="namaAcara" value="{{$row->namaAcara}}" class="form-control" /><br /></div>
            <div class="form-group">Gambar<input type="text" id="image" name="isiArtikel" value="{{$row->image}}" class="form-control" /><br /></div>
            <div class="form-group"><label>Deskripsi Acara</label><textarea class="form-control" id="deskAcara" name="deskAcara" data-value="{{$row->deskAcara}}"></textarea>
        @endforeach
        <input type="submit" value="OK" class="btn btn-success">
    </form>

@endsection