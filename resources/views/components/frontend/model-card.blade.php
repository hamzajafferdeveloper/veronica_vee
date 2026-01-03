<div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative model-card">

    <!-- Image with hover overlay -->
    <div class="position-relative overflow-hidden rounded-top" style="height: 350px;">
        <img src="{{ $model->avatar ? asset('storage/' . $model->avatar) : asset('images/placeholder.png') }}"
            alt="{{ $model->user->first_name ?? 'Model' }}" class="w-100 h-100 object-fit-cover model-img">

        <!-- Gradient Overlay -->
        <div
            class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-end p-3 text-white">
            <h5 class="mb-1 fw-bold">{{ $model->user->first_name ?? 'Model' }}
                {{ $model->user->last_name ?? '' }}</h5>
            <small class="d-block">{{ $model->age ?? '-' }} yrs •
                {{ $model->gender ?? '-' }}</small>
            <small class="d-block">{{ $model->location ?? '-' }}</small>
            @if ($model->experience)
                <span class="badge bg-primary mt-2">{{ Str::limit($model->experience, 25) }}</span>
            @endif
        </div>
    </div>

    <!-- Card body -->
    <div class="card-body text-center p-3 bg-white">
        <a href="{{ route('frontend.model.profile', $model->id) }}"
            class="btn btn-primary w-100 rounded-pill fw-semibold btn-hover-shadow">
            View Profile
        </a>
    </div>
</div>
