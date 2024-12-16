@extends('layout')
@section('content')
    @if (session()->has('Error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('Error') }}'
            });
        </script>
    @endif
    <style>
        body {
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            min-width: 100vw;
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            background-color: #F4DEB5;
            background-image:
                radial-gradient(at 93% 100%, #7494ec 0px, transparent 50%),
                radial-gradient(at 0% 0%, #633F92 0px, transparent 50%),
                radial-gradient(at 38% 60%, #fffd44 0px, transparent 50%),
                radial-gradient(at 100% 0%, #7494ec 0px, transparent 50%),
                radial-gradient(at 80% 50%, #633F92 0px, transparent 50%),
                radial-gradient(at 0% 100%, #fffd44 0px, transparent 50%);
            background-size: 200% 200%;
            background-repeat: no-repeat;
            overflow-x: hidden;
            animation: gradient 30s ease infinite;
        }

        #editor {
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #6366F1 #e5e7eb;
        }

        #editor::-webkit-scrollbar {
            width: 8px;
        }

        #editor::-webkit-scrollbar-thumb {
            background-color: #6366F1;
            border-radius: 10px;
        }

        #editor::-webkit-scrollbar-track {
            background-color: #e5e7eb;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .image-preview-item {
            position: relative;
            max-width: 200px;
        }

        .image-preview img {
            width: 100%;
            border-radius: 8px;
        }

        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            padding: 5px;
        }

        .image-upload-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .image-upload-button:hover {
            background-color: #45a049;
        }
    </style>

    @include('partials.nav')

    <div class="text-gray-900 min-h-screen p-6">
        <!-- Main Content -->
        <div class="w-full bg-white rounded-lg p-6 shadow-lg">
            <h1 class="text-xl text-center font-semibold">Having a difficult time? Ask for help! <i
                    class="fa-solid fa-graduation-cap"></i></h1>
            <h1 class="font-bold text-xl">Create a post</h1>
            <form id="post-form" enctype="multipart/form-data">
                <div class="mt-5">
                    <label for="title-input" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" id="title"
                        class="block w-[50%] p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Insert title here...." required>
                </div>
                <div class="mt-5">
                    <label for="question-input" class="block mb-2 text-sm font-medium text-gray-900">What is the
                        problem?</label>
                    <!-- Editor -->
                    <div
                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div class="flex items-center justify-between px-3 py-2 border-b dark:border-gray-600">
                            <div
                                class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                                <!-- Upload Image Button -->
                                <button type="button" id="upload-image-btn" class="image-upload-button">
                                    <i class="fa-solid fa-image text-gray-500"></i> Upload Image
                                </button>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                            <textarea id="question" rows="8"
                                class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="Write the details here..." required></textarea>

                            <!-- Image Preview Section -->
                            <div id="image-preview" class="image-preview">
                                <!-- Images will be dynamically added here -->
                            </div>

                        </div>
                    </div>
                </div>
                <button type="submit" id="submit-btn"
                    class="mt-10 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Publish
                </button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let imageFile = null; // Store the single image file

        // Image upload and preview
        document.getElementById("upload-image-btn").addEventListener("click", function() {
            let fileInput = document.createElement("input");
            fileInput.type = "file";
            fileInput.accept = "image/*";
            fileInput.addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Remove any existing preview
                        const imagePreviewContainer = document.getElementById("image-preview");
                        imagePreviewContainer.innerHTML = ""; // Clear previous image

                        // Create a new image preview item
                        const imagePreviewContainerNew = document.createElement("div");
                        imagePreviewContainerNew.classList.add("image-preview-item");

                        const image = document.createElement("img");
                        image.src = e.target.result;
                        imagePreviewContainerNew.appendChild(image);

                        // Create a delete button for this image
                        const deleteBtn = document.createElement("button");
                        deleteBtn.textContent = "X";
                        deleteBtn.classList.add("delete-btn");
                        deleteBtn.addEventListener("click", function() {
                            imagePreviewContainerNew.remove();
                            imageFile = null; // Reset the imageFile variable
                        });

                        imagePreviewContainerNew.appendChild(deleteBtn);

                        // Append the preview item to the preview container
                        imagePreviewContainer.appendChild(imagePreviewContainerNew);

                        // Store the file
                        imageFile = file;
                    };
                    reader.readAsDataURL(file);
                }
            });
            fileInput.click(); // Trigger the file input click event
        });

        // Form submission
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submit-btn").addEventListener("click", function(e) {
                e.preventDefault(); 

                const question = document.getElementById("question").value;
                const title = document.getElementById("title").value;

                // Validate input
                if (question === '' && title === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Question must be filled out!'
                    });
                    return;
                }

             

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Once submitted, you cannot undo this action!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Submit!',
                    cancelButtonText: 'No, Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Submitting...",
                            text: "Please wait while we submit your post.",
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        let formData = new FormData();
                        formData.append("title", title);
                        formData.append("question", question);
                        
                        if (imageFile){
                            formData.append("image", imageFile);
                        }

                        fetch("{{ route('addQuestion') }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(res => {
                                Swal.close();

                                if (res.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: 'Your post has been successfully submitted!'
                                    }).then(() => {
                                        window.location.href = "{{ route('askPage') }}";
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: res.message
                                    });
                                }
                            })
                            .catch(err => {
                                console.error('Fetch Error:', err);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'There was an error while submitting your post.'
                                });
                            });
                    }
                });
            });
        });
    </script>
@endsection
