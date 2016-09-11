@extends('backend.backoffice')
@section('content')
    </nav>

    <div id="page-wrapper">

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Data Users
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-10">
                    <div class="table-responsive">
                        <table id="user" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Acara</th>
                                <th>Gambar</th>
                                <th>Deskripsi Acara </th>
                                <th>Dibuat</th>
                                <th>Diubah</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            @foreach($getData as $data)
                                <tbody>
                                <tr>
                                    <td>{{$data->idAcara}}</td>
                                    <td>{{$data->namaAcara}}</td>
                                    <td>{{$data->image}}</td>
                                    <td>{{$data->deskAcara}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->updated_at}}</td>
                                    <td><a href="{{url('/admin/acara/edit/'.$data->idAcara)}}"><button type="button" class="btn btn-info">Edit</button></a>
                                        <a href="{{url('/admin/acara/delete/'.$data->idAcara)}}"><button type="button" class="btn btn-warning">Delete</button></a></td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    </form>

                    <div class="with-3d-shadow">
                        <a href="{{url('/admin/acara/add')}}"><button type="button" class="btn btn-success">Tambah</button></a><br /><br />

                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset('backend/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('backend/js/bootstrap.min.js')}}"></script>

    </body>

    </html>
@endsection