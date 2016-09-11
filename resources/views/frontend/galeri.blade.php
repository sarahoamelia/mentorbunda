@extends('frontend.backoffice')
@section('content')
<section id="clients">
    <div class="inner team">

        <!-- Header -->
        <!-- Members -->

            <div class="team-members inner-details"><!-- Member -->
                @foreach($getData as $row)
            <div class="col-xs-4 member animated" data-animation="fadeInUp" data-animation-delay="0">

                <div class="member-inner">
                    <!-- Team Member Image -->
                    <a class="team-image">
                        <!-- Img -->

                        <img src="{{$row->kontenGaleri}}" alt="" />
                    </a>
                    <div class="member-details">
                        <div class="member-details-inner">
                            <!-- Name -->
                            <h2 class="member-name light"></h2>
                            <!-- Description -->
                            <p class="member-description">{{$row->namaGaleri}}</p>
                            <!-- Socials -->
                            <div class="socials">
                                <!-- Link -->

                            </div><!-- End Socials -->
                        </div> <!-- End Detail Inner -->
                    </div><!-- End Details -->
                </div> <!-- End Member Inner -->
            </div><!-- End Member -->
            @endforeach


    </div><!-- End Team Inner -->
</section><!-- End Team Section -->
@endsection