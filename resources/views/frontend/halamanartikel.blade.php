@extends('frontend.backoffice')
@section('content')

    <div class="container">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <div class="form-group"><input type="hidden" name="idArtikel" class="form-control" /><br /></div>
            <div class="form-group"><h1 class="text-center">{{$row->judulArtikel}}</h1><br /></div>
            <div class="form-group"><img src="{{asset($row->gambar)}}" alt="image"><br /></div>
            <div class="form-group"><p class="text-justify">{{$row->isiArtikel}}</p><br /></div>
        @endforeach


            <div class="form-group"><input type="hidden" name="idKomentar" class="form-control" /><br /></div>
            <div class="form-group"><label>Komentar: </label>{{$row->isiKomentar}}<br /></div>


        <form action="{{url('artikel/submit')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="form-group"><input type="hidden" name="idKomentar" class="form-control" /><br /></div>
                <div class="form-group"> <label>Tambahkan Komentar</label><textarea placeholder="Tulis komentar..." name="isiKomentar" class="form-control"></textarea></div>
                <input type="submit" value="Kirim" class="btn btn-success">
                <br /><br />
            </form>
    </div>

@endsection

