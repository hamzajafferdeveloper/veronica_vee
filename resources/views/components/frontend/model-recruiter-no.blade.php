@push('styles')
    <style>
        /* Image hover zoom */
        .model-card .model-img {
            transition: transform 0.5s ease;
        }

        .model-card:hover .model-img {
            transform: scale(1.05);
        }

        /* Overlay gradient */
        .model-card .overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0));
            transition: background 0.3s ease;
        }

        .model-card:hover .overlay {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
        }

        /* Button hover shadow */
        .btn-hover-shadow:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }

        /* Responsive card */
        @media (max-width: 576px) {
            .model-card .overlay h5 {
                font-size: 1rem;
            }

            .model-card .overlay small {
                font-size: 0.75rem;
            }

            .model-card .overlay .badge {
                font-size: 0.6rem;
            }
        }
    </style>
@endpush

<section class="mt-5" id="other">
    <div class="container">
        <div class="card text-bg-primary bg-gradient border shadow-lg text-center rounded-4">
            <div class="card-body py-5">

                <h4 class="fw-medium mb-5">The worlds best talent and creators that trust us</h4>

                <div class="row gy-4 justify-content-around">

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfProjects ?? 0 }}</h2>
                        <p class="mb-0">NEW JOB POSTED</p>
                    </div><!--/col(1)-->

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfModels ?? 0 }}</h2>
                        <p class="mb-0">MODEL AND ARTISTS</p>
                    </div><!--/col(2)-->

                    <div class="col-auto">
                        <h2 class="mb-0 display-5 fw-bold">{{ $noOfRecruiters ?? 0 }}</h2>
                        <p class="mb-0">RECRUITERS</p>
                    </div><!--/col(3)-->

                </div><!--/row-->

            </div><!--/card-body-->
        </div><!--/card-->
    </div>
    </div><!--/container-fluid-->
</section>
