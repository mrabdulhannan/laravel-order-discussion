@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Welcome to Order Discussion Board by POPScapes</h1>
        <style>
            #fileList {
                list-style: none;
                padding: 0;
                display: flex;
            }

            .file-item {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .file-preview {
                width: 50px;
                height: 50px;
                object-fit: cover;
                margin-right: 10px;
            }

            .delete-icon {
                cursor: pointer;
            }
        </style>
        <div class="image-container">
            <img src="https://popscapes.art/cdn/shop/files/Florida_01.min_2048x.jpg?v=1695150770" alt="Cropped Image">
        </div>
        <style>
            .image-container {
                width: 100%;
                /* Adjust as needed */
                height: 200px;
                /* Fixed height for the cropped section */
                overflow: hidden;
                position: relative;
            }

            .image-container img {
                width: 100%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .gallery {
                display: flex;
                flex-wrap: wrap;
            }

            .gallery-item {
                margin: 10px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .gallery-item img,
            .gallery-item .file-icon {
                width: 100px;
                height: 100px;
                object-fit: cover;
            }

            .gallery-item .file-icon {
                font-size: 50px;
                display: flex;
                justify-content: center;
                align-items: center;
                border: 1px solid #ccc;
            }
        </style>
        <div class="panel messages-panel">

            <div class="contacts-list">
                <div class="inbox-categories">
                    <div data-toggle="tab" data-target="#inbox" class="active"> Inbox </div>
                    <div data-toggle="tab" data-target="#sent"> Sent </div>
                    <div data-toggle="tab" data-target="#marked"> Marked </div>
                    <div data-toggle="tab" data-target="#drafts"> Drafts </div>
                </div>
                <div class="tab-content">
                    <div id="inbox" class="contacts-outter-wrapper tab-pane active">
                        <form class="panel-search-form info form-group has-feedback no-margin-bottom">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <span class="fa fa-search form-control-feedback"></span>
                        </form>
                        <div class="contacts-outter">
                            <ul class="list-unstyled contacts">
                                <li data-toggle="tab" data-target="#inbox-message-1" class="active">
                                    <div class="message-count"> 1 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> John Doe </h3>
                                        <h5> Hah, too late, I already bought it and my team is impleting the new design
                                            right now.</h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 2:32 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                                <li data-toggle="tab" data-target="#inbox-message-2">
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> John Doe </h3>
                                        <h5> Of course, just call me before that, in case I forget. </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 3:56 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                                <li data-toggle="tab" data-target="#inbox-message-3">
                                    <div class="message-count"> 1 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> John Doe</h3>
                                        <h5> Hey, you asked for my feedback, it's brilliant. Damn, I</h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 5:21 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                                <li data-toggle="tab" data-target="#inbox-message-4">
                                    <div class="message-count"> 2 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> John Doe </h3>
                                        <h5> And invite Daniel too, please </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 6:13 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="sent" class="contacts-outter-wrapper tab-pane">
                        <form class="panel-search-form success form-group has-feedback no-margin-bottom">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <span class="fa fa-search form-control-feedback"></span>
                        </form>
                        <div class="contacts-outter">
                            <ul class="list-unstyled contacts success">
                                <li data-toggle="tab" data-target="#sent-message-1">
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> David Beckham </h3>
                                        <h5> I would like to take a look at it this evening, is it possible ? </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 2:24 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                                <li data-toggle="tab" data-target="#sent-message-2">
                                    <div class="message-count"> 7 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> Jeff Williams </h3>
                                        <h5> Hello, Dennis. I will take a look at it tomorrow, because I'm </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 12:41 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="marked" class="contacts-outter-wrapper tab-pane">
                        <form class="panel-search-form warning form-group has-feedback no-margin-bottom">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <span class="fa fa-search form-control-feedback"></span>
                        </form>
                        <div class="contacts-outter">
                            <ul class="list-unstyled contacts warning">
                                <li data-toggle="tab" data-target="#marked-message-1">
                                    <div class="message-count"> 2 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> Jessica Franco </h3>
                                        <h5> Hello, Dennis. I wanted to let you know we reviewed your proposal and
                                            decided </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 1:44 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                                <li data-toggle="tab" data-target="#marked-message-2">
                                    <div class="message-count"> 1 </div>
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> Pavel Durov </h3>
                                        <h5> Hey, we need your help for our next Telegram re-design. </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 3:23 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="drafts" class="contacts-outter-wrapper tab-pane">
                        <form class="panel-search-form dark form-group has-feedback no-margin-bottom">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                            <span class="fa fa-search form-control-feedback"></span>
                        </form>
                        <div class="contacts-outter">
                            <ul class="list-unstyled contacts dark">
                                <li data-toggle="tab" data-target="#draft-message-1">
                                    <img alt class="img-circle medium-image"
                                        src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    <div class="vcentered info-combo">
                                        <h3 class="no-margin-bottom name"> Milla Shiffman </h3>
                                        <h5> Hello, Mila, can you send me the latest pack of icons, I need </h5>
                                    </div>
                                    <div class="contacts-add">
                                        <span class="message-time"> 4:22 <sup>AM</sup></span>
                                        <i class="fa fa-trash-o"></i>
                                        <i class="fa fa-paperclip"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane message-body active" id="inbox-message-1">
                    <div class="message-top">
                        <a class="btn btn btn-success new-message"> Order # : {{ $orderNumber ?? '' }} </a>
                        <div class="new-message-wrapper">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Send message to...">
                                <a class="btn btn-danger close-new-message" href="#"><i
                                        class="fa fa-times"></i></a>
                            </div>
                            <div class="chat-footer new-message-textarea">
                                <textarea class="send-message-text"></textarea>
                                <label class="upload-file">
                                    <input type="file" required>
                                    <i class="fa fa-paperclip"></i>
                                </label>
                                <button type="button" class="send-message-button btn-info"> <i class="fa fa-send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="message-chat">
                        <div class="chat-body">
                            @foreach ($messages as $message)
                                @if ($message['user_type'] === 'admin')
                                    <div class="message info">
                                        <img alt class="img-circle medium-image"
                                            src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                        <div class="message-body">
                                            <div class="message-info">
                                                <h4> {{ $message['user_name'] }} </h4>
                                                <h5> <i class="fa fa-clock-o"></i> {{ $message['created_at'] }} </h5>
                                            </div>
                                            <hr>
                                            <div class="message-text">
                                                {{ $message['content'] }}
                                            </div>
                                            @php
                                                $imageUrlString = $message['image_url'];
                                                $imageUrls = explode(',', $imageUrlString);
                                            @endphp
                                            <div class="gallery">
                                                @foreach ($imageUrls as $url)
                                                    @if (($url != '') | null)
                                                        <a href="{{ $url }}" target="_blank">
                                                            <div class="gallery-item">
                                                                @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $url))
                                                                    <img src="{{ $url }}" alt="Image preview">
                                                                @else
                                                                    <div class="file-icon">📄</div>
                                                                    <!-- Simple icon for non-image files -->
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                @elseif ($message['user_type'] === 'customer')
                                    <div class="message my-message">
                                        <img alt class="img-circle medium-image"
                                            src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                        <div class="message-body">
                                            <div class="message-body-inner">
                                                <div class="message-info">
                                                    <h4> {{ $message['user_name'] }} </h4>
                                                    <h5> <i class="fa fa-clock-o"></i> {{ $message['created_at'] }} </h5>
                                                </div>
                                                <hr>
                                                <div class="message-text">
                                                    {{ $message['content'] }}
                                                </div>
                                                @php
                                                    $imageUrlString = $message['image_url'];
                                                    $imageUrls = explode(',', $imageUrlString);
                                                @endphp
                                                <div class="gallery">
                                                    @foreach ($imageUrls as $url)
                                                        @if (($url != '') | null)
                                                            <a href="{{ $url }}" target="_blank">
                                                                <div class="gallery-item">
                                                                    @if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $url))
                                                                        <img src="{{ $url }}"
                                                                            alt="Image preview">
                                                                    @else
                                                                        <div class="file-icon">📄</div>
                                                                        <!-- Simple icon for non-image files -->
                                                                    @endif
                                                                </div>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <ul id="imageList"></ul>
                            <div class="chat-footer message-area">
                                <div>
                                </div>

                                <form action="{{ route('messages.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group" hidden>
                                        <label for="order_id">Order ID</label>
                                        <input type="text" name="order_id" id="order_id" class="form-control"
                                            value="{{ $orderId }}" required>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="user_type">User Type</label>
                                        <input type="text" name="user_type" id="user_type" class="form-control"
                                            value="{{ $userType }}">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="image_url">Image URL</label>
                                        <input type="text" name="image_url" id="image_url" class="form-control">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="user_name">User Name</label>
                                        <input type="text" name="user_name" id="user_name" class="form-control"
                                            value="{{ $userName }}">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="user_email">User Email</label>
                                        <input type="email" name="user_email" id="user_email" class="form-control"
                                            value="{{ $customerEmail }}">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label for="order_number">Order Number</label>
                                        <input type="text" name="order_number" id="order_number" class="form-control"
                                            value="{{ $orderNumber }}">
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea name="content" id="content" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button> --}}

                                    <textarea name="content" id="content" class="send-message-text" required></textarea>
                                    {{-- <label class="upload-file">
                                        <input type="file" onchange="submitForm('myForm1')" />
                                        <i class="fa fa-paperclip"></i>
                                    </label> --}}
                                    <button type="submit" class="send-message-button btn-info"> <i
                                            class="fa fa-send"></i>
                                    </button>
                                </form>
                                <form id="myForm1" action="{{ route('message.file.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <label class="upload-file">
                                        <input type="file" name="file"
                                            accept=".pdf, .docx, .xlsx, .ppt, .jpg, .png, .gif, .jpeg"
                                            style="display: none" onchange="submitForm('myForm1')" />
                                        <i class="fa fa-paperclip"></i>
                                    </label>
                                    {{-- <button type="button" class="btn btn-success mt-3"
                                        >Upload</button> --}}
                                </form>

                            </div>
                            <ul id="fileList"></ul>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    var imagesURLs = [];

    function submitForm(formId) {
        // Find the form element
        const form = document.getElementById(formId);
        var inputElement = "";
        if (formId === "myForm1") {
            inputElement = document.getElementById('image_url');
        }

        // Create a FormData object from the form data
        const formData = new FormData(form);
        const csrfTokenMetaTag = document.querySelector('meta[name="csrf-token"]');
        const csrfToken = csrfTokenMetaTag ? csrfTokenMetaTag.getAttribute('content') : '';
        // Submit the form using AJAX
        fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                // Handle the response from the controller
                if (response.ok) {


                    return response.json(); // or response.text(), response.blob(), etc.
                } else {
                    throw new Error('Request failed');
                }
            })
            .then(data => {
                // Handle the data returned by the controller
                console.log(data);
                console.log("response", data.message.file_path);
                imagesURLs.push(data.message.file_path);
                inputElement.value = imagesURLs;
                console.log("element", inputElement);
                console.log("value", inputElement.value);
                renderPreviewList();
                showUploadSuccessMessage(formId);
                // console.log("Element = ", mcAuthorityLetter);

            })
            .catch(error => {
                // Handle any errors that occurred during the request
                console.error('Error:', error);
            });
    }

    function showUploadSuccessMessage(formId) {
        // Find the form element
        // const form = document.getElementById(formId);

        // // Create a message element
        // const messageElement = document.createElement('p');
        // messageElement.textContent = 'Upload successful!';
        // messageElement.classList.add('upload-success-message');

        // // Append the message element to the form
        // form.appendChild(messageElement);
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

    // Function to delete an image from the array
    function deleteImage(index) {
        imagesURLs.splice(index, 1);
        renderPreviewList();
        console.log("remaining List", imagesURLs);
    }
</script>
