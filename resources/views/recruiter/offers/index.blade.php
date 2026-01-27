@extends('layouts.recruiter')

@section('title', 'My Offers')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">My Offers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offers as $offer)
                    <tr>
                        <td>{{ $offer->id }}</td>
                        <td>{{ $offer->title }}</td>
                        <td>${{ number_format($offer->amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $offer->status == 'pending' ? 'warning' : ($offer->status == 'accepted' ? 'success' : 'danger') }}">
                                {{ ucfirst($offer->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('recruiter.chat.messages', $offer->sender_id) }}" class="btn btn-sm btn-info">View in Chat</a>
                        </td>
                        <td>{{ $offer->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
