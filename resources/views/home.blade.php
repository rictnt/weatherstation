@extends('layouts.master')
@section('content')
<section class="testimonials5 cid-r6YBkbGsFg mbr-parallax-background" id="testimonials5-1">
    <div class="mbr-overlay" style="opacity: 0.3;">
    </div>
    <div class="container">
        <div class="media-container-column">   
            <div class="mbr-testimonial align-center col-12 col-md-10">
                <div class="panel-item">
                    <div class="card-block">
                        <div class="testimonial-photo">
                            <img src="front/assets/images/logo-ups-home.png">
                        </div>
                        <p class="mbr-text mbr-fonts-style mbr-white display-7">
                           
                        </p>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                    
                </div>
            </div>
                @include('layouts.partials.forecastups')
                @include('layouts.partials.mapstations')    
            
        </div>
    </div> 
</section>
@endsection