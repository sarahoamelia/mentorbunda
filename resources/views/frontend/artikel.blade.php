@extends('frontend.backoffice')
@section('content')
<!-- CONTENT -->

<div class="divider col-sm-12 col-xs-12 col-md-12" xmlns="http://www.w3.org/1999/html">
    <div class="header-text">Artikel</div>
</div>

<section class="blog">
    <section class="blog">
        @foreach($getData as $row)
            <div class="item col-md-4">
                <div class="blok-read-sm">
                    <a href="#" class="hover-image">
                        <img src="{{asset($row->gambar)}}" alt="image">
                        <span class="layer-block"></span>
                    </a>

                    <div class="content-block">
                        <span class="point-caption bg-blue-point"></span>
                        <span class="bottom-line bg-blue-point"></span>
                        <h4>{{$row->judulArtikel}}</h4>
                        <p>{{$row->penggalanArt}}</p>
                        <a href="{{url('artikel/detail/'.$row->idArtikel)}}">
                            <button type="submit" class="btn btn-succes">read more</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

                    <!-- DEMO -->
    </section>

    <!-- DEMO -->
</section>
@endsection
