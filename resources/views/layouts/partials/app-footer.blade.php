<footer class="py-5 mt-5 text-bg-dark">
    <div class="container">
        <div class="row gy-4 justify-content-between">

            <div class="col-lg-auto">
                <img class="img-fluid filterWhite" src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    width="150">
            </div><!--/logo-->

            <div class="col-md-auto col-6">
                <h6 class="fw-bold mb-3">{{ __('Company') }}</h6>

                <ul class="nav flex-column gap-2 fs-14">
                    <li><a href={{ route('about') }} class="text-white">{{ __('About us') }}</a></li>
                    <li><a href="{{ route('testimonial') }}" class="text-white">{{ __('Testimonials') }}</a></li>
                    {{-- <li><a href="#" class="text-white">Success Stories</a></li>
                    <li><a href="#" class="text-white">Company Details</a></li>
                    <li><a href="#" class="text-white">Podcast</a></li>
                    <li><a href="#" class="text-white">Blog</a></li> --}}
                </ul>

            </div><!--/link-->

            <div class="col-md-auto col-6">
                <h6 class="fw-bold mb-3">{{ __('Privacy') }}</h6>

                <ul class="nav flex-column gap-2 fs-14">
                    <li><a href="{{ route('page', 'privacy-policy') }}" class="text-white">{{ __('Privacy policy') }}</a></li>
                    <li><a href="{{ route('page', 'term-of-use') }}" class="text-white">{{ __('Terms of use') }}</a></li>
                </ul>

            </div><!--/link-->

            {{-- <div class="col-md-auto col-6">
                <h6 class="fw-bold mb-3">Help</h6>

                <ul class="nav flex-column gap-2 fs-14">
                    <li><a href="#" class="text-white">Safety and trust</a></li>
                    <li><a href="#" class="text-white">How it works</a></li>
                    <li><a href="#" class="text-white">Modeling advice</a></li>
                    <li><a href="#" class="text-white">Contact us</a></li>
                </ul>

            </div> --}}

            <div class="col-md-auto col-6">
                <h6 class="fw-bold mb-3">{{ __('Download our App') }}</h6>

                <ul class="nav flex-column gap-2 fs-14">
                    <li><a href="#" class="text-white">{{ __('iOS') }}</a></li>
                    <li><a href="#" class="text-white">{{ __('Android') }}</a></li>
                </ul>

            </div><!--/link-->

            <div class="col-12">
                <ul class="nav gap-4 justify-content-center fs-3">
                    <li><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-tiktok"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-youtube"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-linkedin"></i></a></li>
                    <li><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
                </ul>
            </div><!--/social-->

            <div class="col-12 text-center">
                <p class="mb-0">© 2025 <a href="#" class="text-white">VeronicaVee</a></p>
            </div><!--/social-->

        </div><!--/row-->
    </div><!--/container-->
</footer>
