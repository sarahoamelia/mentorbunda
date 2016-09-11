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
                        Data Users
                    </h1>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-9">
                    <div class="with-3d-shadow">

                    </div>
                    <div class="table-responsive col-lg-pull-12">
                        <table id="user" class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Create At</th>
                                <th>Update At</th>
                            </tr>
                            </thead>
                            <?php $id = $user->firstItem() -1; ?>
                            @foreach($user as $data)
                                <tbody>
                                    <tr>
                                        <td>{{$data->$id}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->updated_at}}</td>
                                    </tr>
                                </tbody>
                                @endforeach
                        </table>
                        <?php echo str_replace('/?', '?', $user->render()); ?>
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