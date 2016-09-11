@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/galeri/submit')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group"><label>ID</label> <input type="hidden" class="form-control" name="idGaleri" /><br /></div>
        <div class="form-group"><label>Nama Galeri</label> <input type="text" class="form-control" name="namaGaleri" required=""/><br /></div>
        <div class="form-group"><label>Konten Galeri</label> <input type="text" class="form-control" id="kontenGaleri" name="kontenGaleri" required=""/><br /></div>

            <input type="submit" value="OK" class="btn btn-success">
    </form>

@endsection


