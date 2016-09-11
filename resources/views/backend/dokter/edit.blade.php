@extends('backend.backoffice')
@section('content')

    <form action="{{url('/admin/dokter/submit')}}" method="post">

        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <div class="form-group"><input type="hidden" name="id" value="{{$row->idDokter}}" class="form-control" /><br /></div>
            <div class="form-group">Username<input type="text" name="username" value="{{$row->username}}" class="form-control" /><br /></div>
            <div class="form-group">Password<input type="text" name="password" value="{{$row->password}}" class="form-control" /><br /></div>
            <div class="form-group">Nama Dokter<input type="text" name="namaDokter" value="{{$row->namaDokter}}" class="form-control" /><br /></div>
            <div class="form-group">Alamat<input type="text" name="alamat" value="{{$row->alamat}}" class="form-control" /><br /></div>
            <div class="form-group">Nama RS<input type="text" name="namars" value="{{$row->namars}}" class="form-control" /><br /></div>
            <div class="form-group">Alamat RS<input type="text" name="alamatrs" value="{{$row->alamatrs}}" class="form-control" /><br /></div>
        @endforeach
        <input type="submit" value="OK" class="btn btn-success">
    </form>
@endsection