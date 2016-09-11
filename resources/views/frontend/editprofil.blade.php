@extends('frontend.backoffice')
@section('content')
    <div class="container">
        <form action="{{url('/editprofil/submit')}}" method="post">
            <input type="submit" value="OK" class="btn btn-success">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            @foreach($getData as $row)
                <div class="form-group">ID<input type="hidden" name="id" value="{{$row->id}}" class="form-control" /><br /></div>
                <div class="form-group">Nama Lengkap<input type="text" name="nama" value="{{$row->name}}" class="form-control" /><br /></div>
                <div class="form-group">Email <input type="text" name="email" value="{{$row->email}}" class="form-control" /><br /></div>
                <div class="form-group">Password <input type="text" name="password" value="{{$row->password}}" class="form-control" /><br /></div>

            @endforeach
            <input type="submit" value="OK" />
        </form>
    </div>

@endsection