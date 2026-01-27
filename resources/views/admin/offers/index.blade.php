@extends('layouts.admin')

@section('title', 'Offer History')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Platform Offers</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="offersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Recruiter</th>
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
                        <td>{{ $offer->receiver->first_name }} {{ $offer->receiver->last_name }}</td>
                        <td>{{ $offer->title }}</td>
                        <td>${{ number_format($offer->amount, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $offer->status == 'pending' ? 'warning' : ($offer->status == 'accepted' ? 'success' : 'danger') }}">
                                {{ ucfirst($offer->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.chat.messages', $offer->receiver_id) }}" class="btn btn-sm btn-info">View in Chat</a>
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
