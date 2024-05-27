@extends('layouts.app')

@push('stylesheet-page-level')
    
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Message') }}</div>

                <div class="card-body">
                    <div class="container">
                        <h1>Create a Message</h1>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('messages.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="order_id">Order ID</label>
                                <input type="text" name="order_id" id="order_id" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="user_type">User Type</label>
                                <input type="text" name="user_type" id="user_type" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="image_url">Image URL</label>
                                <input type="text" name="image_url" id="image_url" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="user_name">User Name</label>
                                <input type="text" name="user_name" id="user_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="user_email">User Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection