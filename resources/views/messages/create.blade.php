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

<form id="myForm1" action="{{ route('message.file.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="upload-btn-wrapper">
        <button class="btn">Upload files</button>
        <input type="file" name="files[]" multiple />
    </div>
    <button type="button" class="btn btn-success mt-3" onclick="submitForm('myForm1')">Upload</button>
</form>
<ul id="fileList"></ul>
<input type="hidden" id="image_url" name="image_url" />



<script>
    var imagesURLs = [];

    function submitForm(formId) {
        const form = document.getElementById(formId);
        const inputElement = formId === "myForm1" ? document.getElementById('image_url') : null;
        const formData = new FormData(form);
        const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMetaTag ? csrfTokenMetaTag.getAttribute('content') : '';

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => response.json().catch(() => {
            // If JSON parsing fails, return response text for debugging
            return response.text().then(text => { throw new Error(text) });
        }))
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }

            if (Array.isArray(data.message.file_paths)) {
                imagesURLs = imagesURLs.concat(data.message.file_paths);
            } else {
                imagesURLs.push(data.message.file_path);
            }
            if (inputElement) {
                inputElement.value = imagesURLs.join(',');
            }
            renderPreviewList();
            showUploadSuccessMessage(formId);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred: ' + error.message);
        });
    }

    function showUploadSuccessMessage(formId) {
        const form = document.getElementById(formId);
        const messageElement = document.createElement('p');
        messageElement.textContent = 'Upload successful!';
        messageElement.classList.add('upload-success-message');
        form.appendChild(messageElement);
    }

    function renderPreviewList() {
        const fileList = document.getElementById('fileList');
        fileList.innerHTML = ''; // Clear the existing list

        imagesURLs.forEach((url, index) => {
            const listItem = document.createElement('li');
            listItem.classList.add('file-item');

            const filePreview = document.createElement('img');
            filePreview.classList.add('file-preview');
            filePreview.src = url;
            listItem.appendChild(filePreview);

            const deleteIcon = document.createElement('span');
            deleteIcon.innerHTML = '&#10006;'; // Cross icon
            deleteIcon.classList.add('delete-icon');
            deleteIcon.onclick = function() {
                deleteImage(index);
            };
            listItem.appendChild(deleteIcon);

            fileList.appendChild(listItem);
        });
    }

    function deleteImage(index) {
        imagesURLs.splice(index, 1);
        renderPreviewList();
        if (document.getElementById('image_url')) {
            document.getElementById('image_url').value = imagesURLs.join(',');
        }
        console.log("remaining List", imagesURLs);
    }
</script>


@endsection