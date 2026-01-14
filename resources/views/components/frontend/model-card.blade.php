@push('styles')
    <style>
        /* Image hover zoom */
        .model-card .model-img {
            transition: transform 0.5s ease !important;
            /* object-fit: contain */
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

<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden text-white">

    <!-- Image with hover overlay -->

        <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : asset('images/placeholder.png') }}"
            alt="{{ $model->user->first_name ?? 'Model' }}" class="card-img h-100 model-img">

        <!-- Gradient Overlay -->
        <div
            class="card-img-overlay rounded-0 top-unset pt-5">
            <h5 class="mb-1 fw-bold">{{ $model->user->first_name ?? 'Model' }}
                {{ $model->user->last_name ?? '' }}</h5>
            <p class="fs-14 mb-2">{{ $model->age ?? '-' }} {{ __('ui.years') }} •  {{ $model->gender ?? '-' }}</p>
            <p class="fs-14 mb-3 d-sm-block d-none "><i class="bi bi-geo-alt-fill me-1"></i>{{ $model->location ?? '-' }}</p>
            {{-- @if ($model->experience)
                <span class="badge d-sm-block d-none bg-primary mb-2">{{ Str::limit($model->experience, 25) }}</span>
            @endif --}}

             <a href="{{ route('frontend.model.profile', $model->id) }}" class="btn btn-primary w-100 rounded-pill fw-semibold btn-hover-shadow"> {{ __('ui.view_profile') }} </a>
        </div>


</div>


