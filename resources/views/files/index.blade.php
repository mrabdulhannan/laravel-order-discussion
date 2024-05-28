@extends('layouts.app')

@push('stylesheet-page-level')

@endpush

@section('content')
<style>
    .file-gallery {
        display: flex;
        flex-wrap: wrap;
    }

    .file-item {
        margin: 10px;
        position: relative;
    }

    .file-item img {
        max-width: 100px;
        max-height: 100px;
        display: block;
    }

    .file-item .delete-icon {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
        background-color: rgba(255, 0, 0, 0.7);
        color: white;
        padding: 2px 5px;
        border-radius: 50%;
    }
</style>
<div class="container">
    <h1>File Gallery</h1>
    <div class="file-gallery">
        @foreach($files as $file)
            <div class="file-item">
                @if(in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ asset('storage/' . $file) }}" alt="File Preview">
                @else
                    <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ pathinfo($file, PATHINFO_BASENAME) }}</a>
                @endif
                <span class="delete-icon" data-file="{{ basename($file) }}">&times;</span>
            </div>
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteIcons = document.querySelectorAll('.delete-icon');


        deleteIcons.forEach(icon => {
       
            icon.addEventListener('click', function () {
                const file = this.getAttribute('data-file');

                if (confirm('Are you sure you want to delete this file?')) {
                    fetch(`{{ url('/files') }}/${file}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.parentElement.remove();
                        } else {
                            alert('Failed to delete the file.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while deleting the file.');
                    });
                }
            });
        });
    });
</script>
@endsection

@push('scripts-page-level')

@endpush
