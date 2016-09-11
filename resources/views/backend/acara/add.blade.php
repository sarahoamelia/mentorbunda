@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/acara/submit')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group"><label>ID</label> <input type="hidden" class="form-control" name="idAcara" /><br /></div>
        <div class="form-group"><label>Nama Acara</label> <input type="text" class="form-control" name="namaAcara" required=""/><br /></div>
        <div class="form-group"><label>Gambar</label> <input type="text" class="form-control" name="image" required=""/><br /></div>
        <div class="form-group"><label>Deskripsi Acara</label><textarea class="form-control" name="deskAcara" required=""></textarea><br />

            <input type="submit" value="OK" class="btn btn-success"><br />
    </form>


@endsection


