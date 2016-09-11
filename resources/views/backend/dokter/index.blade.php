@extends('backend.backoffice')
@section('content')
    </nav>

    <div id="page-wrapper">

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Data Dokter
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-pull-10">
                    <div class="table-responsive">
                        <table id="user" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nama Dokter</th>
                                <th>Alamat</th>
                                <th>Nama RS</th>
                                <th>Alamat RS</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            @foreach($dokter as $data)
                                <tbody>
                                <tr>
                                    <td>{{$data->idDokter}}</td>
                                    <td>{{$data->username}}</td>
                                    <td>{{$data->namaDokter}}</td>
                                    <td>{{$data->alamat}}</td>
                                    <td>{{$data->namars}}</td>
                                    <td>{{$data->alamatrs}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->updated_at}}</td>
                                    <td><a href="{{url('/admin/dokter/edit/'.$data->idDokter)}}"><button type="button" class="btn btn-info">Edit</button></a>
                                        <a href="{{url('/admin/dokter/delete/'.$data->idDokter)}}"><button type="button" class="btn btn-warning">Delete</button></a></td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <?php echo str_replace('/?', '?', $dokter->render()); ?>
                    </div>
                    </form>

                    <div class="with-3d-shadow">
                        <a href="{{url('/admin/dokter/add')}}"><button type="button" class="btn btn-success">Tambah</button></a><br /><br />

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