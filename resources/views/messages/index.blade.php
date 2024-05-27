@extends('layouts.app')

@push('stylesheet-page-level')
    <style>
        .table td, .table th {
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            max-width: 150px; /* Adjust this value to control the maximum width of table cells */
            overflow-wrap: break-word; /* Added for additional compatibility */
        }
    </style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Messages') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Order ID</th>
                                <th>User Type</th>
                                
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Content</th>
                                <th>Actions</th>
                                <th>Image URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>{{ $message->order_id }}</td>
                                    <td>{{ $message->user_type }}</td>
                                    
                                    <td>{{ $message->user_name }}</td>
                                    <td>{{ $message->user_email }}</td>
                                    <td>{{ $message->content }}</td>
                                    <td>
                                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                    <td>{{ $message->image_url }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
