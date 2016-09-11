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
                        Data Artikel
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Penggalan Artikel</th>
                                <th>Create At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($getData as $row)
                                <tbody>
                                <tr>
                                    <td>{{$row->idArtikel}}</td>
                                    <td>{{$row->judulArtikel}}</td>
                                    <td>{{$row->gambar}}</td>
                                    <td>{{$row->penggalanArt}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td>{{$row->updated_at}}</td>
                                    <td><a href="{{url('/admin/artikel/edit/'.$row->idArtikel)}}"><button type="button" class="btn btn-info">Edit</button></a>
                                        <a href="{{url('/admin/artikel/delete/'.$row->idArtikel)}}"><button type="button" class="btn btn-warning">Delete</button></a></td>
                                </tr>
                                </tbody>
                            @endforeach

                        </table>
                        <div class="with-3d-shadow">
                            <a href="{{url('/admin/artikel/add')}}"><button type="button" class="btn btn-success">Tambah</button></a><br /><br />

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