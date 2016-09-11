@extends('backend.backoffice')
@section('content')
    <form action="{{url('/admin/users/submit')}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="form-group"><label>ID</label> <input type="hidden" class="form-control" name="id" /><br /></div>
        <div class="form-group"><label>Name</label> <input type="text" class="form-control" name="name" /><br /></div>
        <div class="form-group"><label>Username</label> <input type="text" class="form-control" name="username" /><br /></div>
        <div class="form-group"><label>Email</label> <input type="text" class="form-control" name="email" /><br /></div>
        <div class="form-group"><label>Password</label> <input type="password" class="form-control" name="password" /><br /></div>

        <input type="submit" value="OK" class="btn btn-success">
    </form>
@endsection