@extends('frontend.backoffice')
@section('content')
    </nav>

    <div id="page-wrapper">

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header text-center">
                        Konsultasi Member
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-9">
                    <div class="table-responsive text-center centered">
                        <table id="user" class="table table-hover table-bordered">
                            <thead>
                        <tr>
                            <th>ID</th>
                            <th>Member</th>
                            <th>Pesan</th>
                            <th>Balasan</th>
                            <th>Dikirim</th>
                            <th>Lihat</th>
                        </tr>
                            </thead>
                            @foreach($getData as $data)
                                <tbody>
                                <tr>
                                    <td>{{$data->idKonsultasi}}</td>
                                    <td>{{ Auth::user()->name }}</td>
                                    <td>{{$data->pesan}}</td>
                                    <td>{{$data->balasan}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td><a href="{{url('/dokter/lihat/'.$data->idKonsultasi)}}"><button type="button" class="btn btn-info">Lihat</button></a>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>

                    </div>
                    </form>

                    <div class="with-3d-shadow">

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