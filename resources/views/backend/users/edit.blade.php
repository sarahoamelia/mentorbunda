@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/users/submit')}}" method="post">
        <input type="submit" value="OK" class="btn btn-success">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        @foreach($getData as $row)
            <div class="form-group">ID<input type="hidden" name="id" value="{{$row->id}}" class="form-control" /><br /></div>
            <div class="form-group">Nama<input type="text" name="nama" value="{{$row->name}}" class="form-control" /><br /></div>
            <div class="form-group">Username<input type="text" name="nama" value="{{$row->username}}" class="form-control" /><br /></div>
            <div class="form-group">Email <input type="text" name="kota" value="{{$row->email}}" class="form-control" /><br /></div>
        @endforeach
        <input type="submit" value="OK" />
    </form>
@endsection