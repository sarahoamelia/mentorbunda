@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/dokter/submit')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group"><label>ID</label> <input type="hidden" class="form-control" name="idDokter" /><br /></div>
        <div class="form-group"><label>Username</label> <input type="text" class="form-control" name="username" required="" /><br /></div>
        <div class="form-group"><label>Password</label> <input type="text" class="form-control" name="password" required=""/><br /></div>
        <div class="form-group"><label>Nama Dokter</label> <input type="text" class="form-control" name="namaDokter"required="" /><br /></div>
        <div class="form-group"><label>Alamat</label> <input type="text" class="form-control" name="alamat" required=""/><br /></div>
        <div class="form-group"><label>Nama RS</label> <input type="text" class="form-control" name="namars" required=""/><br /></div>
        <div class="form-group"><label>Alamat RS</label> <input type="text" class="form-control" name="alamatrs" required=""/><br /></div>
        <input type="submit" value="Tambah" class="btn btn-success">
    </form>
@endsection


