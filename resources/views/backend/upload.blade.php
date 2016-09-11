@extends('backend.backoffice')
@section('content')

<html>
    <body>
        <form action="{{URL::TO}}" method="post" enctype="multipart/form-data">
            <label>Masukkan Gambar:</label>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <form class="form-control">Deskripsi Foto<input type="text" name="namaGaleri" class="form-control" /></form>
            <input type="file" name="file" id="file" />
            <input type="submit" value="Upload" name="submit" />
        </form>
    </body>
</html>

@endsection


