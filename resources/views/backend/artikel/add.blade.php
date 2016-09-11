@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/artikel/submit')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group"><label>ID</label> <input type="hidden" class="form-control" name="idArtikel" /><br /></div>
        <div class="form-group"><label>Judul Artikel</label> <input type="text" class="form-control" name="judulArtikel" required="" /><br /></div>
        <div class="form-group"><label>Gambar</label> <input type="text" class="form-control" name="gambar" required="" /><br /></div>
        <div class="form-group"><label>Penggalan Artikel</label> <input type="text" class="form-control" name="penggalanArt" required="" /><br /></div>
        <div class="form-group"><label>Isi Artikel</label><input type="text" class="form-control" id="isiArtikel" name="isiArtikel" required=""/><br />

        <input type="submit" value="OK" class="btn btn-success">
    </form>

@endsection


