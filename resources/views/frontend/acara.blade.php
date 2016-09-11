@extends('frontend.backoffice')
@section('content')
<section id="clients">
    <div class="inner team">

        <!-- Header -->
        <!-- Members -->
        @foreach($getData as $row)
        <div class="team-members inner-details">

            <!-- Member -->
            <div class="col-xs-4 member animated" data-animation="fadeInUp" data-animation-delay="0">
                <div class="member-inner">
                    <!-- Team Member Image -->
                    <a class="team-image">
                        <!-- Img -->
                        <img src="{{$row->image}}" alt="" />
                    </a>

                </div> <!-- End Member Inner -->
            </div><!-- End Member -->
            @endforeach
        </div><!-- End Members -->
    </div><!-- End Team Inner -->
</section><!-- End Team Section -->
@endsection