<section class="mt-5" id="other">
    <div class="container">
        <div class="card text-bg-primary bg-gradient border shadow-lg text-center rounded-4">
            <div class="card-body py-5">

                <h4 class="fw-medium mb-5">{{ __('ui.talent_creators_trust') }}</h4>

                <div class="row gy-4 justify-content-around">

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfProjects ?? 0 }}</h2>
                        <p class="mb-0">{{ __('ui.new_jobs_posted') }}</p>
                    </div><!--/col(1)-->

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfModels ?? 0 }}</h2>
                        <p class="mb-0">{{ __('ui.models_and_artists') }}</p>
                    </div><!--/col(2)-->

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfRecruiters ?? 0 }}</h2>
                        <p class="mb-0">{{ __('ui.recruiters_count') }}</p>
                    </div><!--/col(3)-->

                </div><!--/row-->

            </div><!--/card-body-->
        </div><!--/card-->
    </div>
    </div><!--/container-fluid-->
</section>
