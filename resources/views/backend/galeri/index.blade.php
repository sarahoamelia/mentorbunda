@extends('backend.backoffice')
@section('content')
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

    </nav>

    <div id="page-wrapper">

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Data Galeri
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Galeri</th>
                                <th>Konten Galeri</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($getData as $row)
                                <tbody>
                                <tr>
                                    <td>{{$row->idGaleri}}</td>
                                    <td>{{$row->namaGaleri}}</td>
                                    <td>{{$row->kontenGaleri}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td>{{$row->updated_at}}</td>
                                    <td><a href="{{url('/admin/galeri/edit/'.$row->idGaleri)}}"><button type="button" class="btn btn-info">Edit</button></a>
                                        <a href="{{url('/admin/galeri/delete/'.$row->idGaleri)}}"><button type="button" class="btn btn-warning">Delete</button></a></td>
                                </tr>
                                </tbody>
                            @endforeach

                        </table>
                        <div class="with-3d-shadow">
                            <a href="{{url('/admin/galeri/add')}}"><button type="button" class="btn btn-success">Tambah</button></a><br /><br />

                        </div>
                    </div>
                    </form>


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