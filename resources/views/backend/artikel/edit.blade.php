@extends('backend.backoffice')
@section('content')

    <form action="{{url('/admin/artikel/submit')}}" method="post">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <div class="form-group"><input type="hidden" name="idArtikel" value="{{$row->idArtikel}}" class="form-control" /><br /></div>
            <div class="form-group">Judul Artikel<input type="text" name="judulArtikel" value="{{$row->judulArtikel}}" class="form-control" /><br /></div>
            <div class="form-group">Gambar<input type="text" name="gambar" value="{{$row->gambar}}" class="form-control" /><br /></div>
            <div class="form-group">Penggalan Artikel<input type="text" name="penggalanArt" value="{{$row->penggalanArt}}" class="form-control" /><br /></div>
            <div class="form-group">Isi Artikel<textarea class="form-control" id="isiArtikel" name="isiArtikel" value="{{$row->isiArtikel}}"></textarea><br /></div>
        @endforeach
        <input type="submit" value="OK" class="btn btn-success">
    </form>
@endsection