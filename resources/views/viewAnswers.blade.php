@extends('layout')
@section('content')
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

        .hover\:shadow-glow:hover {
            box-shadow: 0 0 10px rgba(255, 223, 0, 0.6), 0 0 20px rgba(255, 223, 0, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
    </style>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Display the question -->
        <div class="bg-opacity-50 bg-[#633F92] shadow-md rounded-lg p-6 mb-6 text-white">
            <div class="flex flex-col">
                <img src="" alt="Question Image"
                    class="w-full max-w-md max-h-64 object-contain mb-4 rounded-lg border">
                <p class="text-lg md:text-xl font-semibold text-white">
                    Bagaimana supaya orang bisa survive terus sampai sem akhir hehehehhehe?
                </p>
                <!-- Input for answering -->
                <div class="mt-4">
                    <!-- btn upload img file -->
                    <button class="flex flex-col space-y-2 mb-4">
                        <label
                            class="px-2 py-1 bg-white bg-opacity-50 text-white rounded-lg transition-all hover:bg-white hover:text-[#633F92] cursor-pointer">
                            <i class="fa-solid fa-file-upload"></i> Upload Image
                            <input type="file" class="hidden image-upload" accept="image/*">
                        </label>

                    </button>
                    <!-- Image preview -->
                    <div class="image-preview hidden mb-4">
                        <img src="" alt="Preview" class="w-full max-w-md rounded-lg shadow-md">
                        <span class="file-name text-white"></span>
                    </div>

                    <textarea
                        class="w-full bg-white bg-opacity-10 rounded-lg p-3 text-white placeholder-white focus:outline-2 focus:outline-yellow-400"
                        rows="2" placeholder="Write your answer here!"></textarea>
                    <button
                        class="mt-2 px-4 py-2 bg-white hover:shadow-glow transition-all hover:font-bold text-[#633F92] font-semibold rounded-lg">
                        Submit Jawaban
                    </button>
                </div>
            </div>
        </div>

        {{-- Display the answers --}}
        <div class="mb-4 answers bg-white bg-opacity-10 rounded-lg p-6 shadow-lg space-y-6">
            {{-- @foreach ($answers as $answer) --}}
            <div class="answer flex flex-col p-4">
                <p class="text-white ">
                    This is where an answer will appear.
                </p>
                <!-- vote buttons -->
                <div class="mt-2 flex items-center space-x-4">
                    <!-- Comment button -->
                    <div>
                        <button
                            class="comment-btn text-[#633F92] hover:text-yellow-100 flex items-center space-x-2 focus:outline-none">
                            <i class="fa-solid fa-reply text-lg"></i>
                            <span>Comment</span>
                        </button>
                        <!-- comment input box -->
                        <div class="comment-box hidden mt-2">
                            <textarea class="w-full bg-gray-100 rounded-lg p-3 text-gray-800 placeholder-gray-400 focus:outline-none" rows="2"
                                placeholder="Write your comment here!"></textarea>
                            <button
                                class="mt-4 px-4 py-2 bg-[#633F92] text-white rounded-lg transition-all duration-300 hover:font-semibold hover:shadow-glow">
                                Submit Comment
                            </button>
                        </div>
                    </div>
                    <!-- Thumbs up -->
                    <div class="flex items-center space-x-2">
                        <button class="text-white hover:text-[#633F92] focus:outline-none thumbs-up">
                            <i class="fas fa-thumbs-up text-lg"></i>
                        </button>
                        <span class="thumbs-up-count text-white  font-medium">0</span>
                    </div>
                    <!-- Thumbs down -->
                    <div class="flex items-center space-x-2">
                        <button class="text-white  hover:text-gray-700 focus:outline-none thumbs-down">
                            <i class="fas fa-thumbs-down text-lg"></i>
                        </button>
                        <span class="thumbs-down-count text-white  font-medium">0</span>
                    </div>
                </div>

            </div>
            <hr class="border-t border-gray-300">
            {{-- @endforeach --}}
        </div>


        {{-- Display the answers --}}
        <div class="mb-4 answers bg-white bg-opacity-10 rounded-lg p-6 shadow-lg space-y-6">
            {{-- @foreach ($answers as $answer) --}}
            <div class="answer flex flex-col p-4">
                <p class="text-white ">
                    This is where an answer will appear.
                </p>
                <!-- vote buttons -->
                <div class="mt-2 flex items-center space-x-4">
                    <!-- Comment button -->
                    <div>
                        <button
                            class="comment-btn text-[#633F92] hover:text-yellow-100 flex items-center space-x-2 focus:outline-none">
                            <i class="fa-solid fa-reply text-lg"></i>
                            <span>Comment</span>
                        </button>
                        <!-- comment input box -->
                        <div class="comment-box hidden mt-2">
                            <textarea class="w-full bg-gray-100 rounded-lg p-3 text-gray-800 placeholder-gray-400 focus:outline-none" rows="2"
                                placeholder="Write your comment here!"></textarea>
                            <button
                                class="mt-4 px-4 py-2 bg-[#633F92] text-white rounded-lg transition-all duration-300 hover:font-semibold hover:shadow-glow">
                                Submit Comment
                            </button>
                        </div>
                    </div>
                    <!-- Thumbs up -->
                    <div class="flex items-center space-x-2">
                        <button class="text-white hover:text-[#633F92] focus:outline-none thumbs-up">
                            <i class="fas fa-thumbs-up text-lg"></i>
                        </button>
                        <span class="thumbs-up-count text-white  font-medium">0</span>
                    </div>
                    <!-- Thumbs down -->
                    <div class="flex items-center space-x-2">
                        <button class="text-white  hover:text-gray-700 focus:outline-none thumbs-down">
                            <i class="fas fa-thumbs-down text-lg"></i>
                        </button>
                        <span class="thumbs-down-count text-white  font-medium">0</span>
                    </div>
                </div>

            </div>
            <hr class="border-t border-gray-300">
            {{-- @endforeach --}}
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle comment box
            const commentButtons = document.querySelectorAll('.comment-btn');
            commentButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const commentBox = button.nextElementSibling;
                    commentBox.classList.toggle('hidden');
                });
            });

            // Update thumbs up/down counts
            const thumbsUpButtons = document.querySelectorAll('.thumbs-up');
            const thumbsDownButtons = document.querySelectorAll('.thumbs-down');

            thumbsUpButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    const countSpan = button.nextElementSibling;
                    const count = parseInt(countSpan.textContent, 10);
                    countSpan.textContent = count + 1;
                });
            });

            thumbsDownButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    const countSpan = button.nextElementSibling;
                    const count = parseInt(countSpan.textContent, 10);
                    countSpan.textContent = count + 1;
                });
            });
        });
    </script>
    <!-- file upload and preview -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const imageUploads = document.querySelectorAll('.image-upload');
            const fileNameDisplays = document.querySelectorAll('.file-name');
            const imagePreviews = document.querySelectorAll('.image-preview');

            imageUploads.forEach((upload, index) => {
                upload.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const previewImage = imagePreviews[index].querySelector('img');
                            previewImage.src = e.target.result; // set preview image source
                            imagePreviews[index].classList.remove('hidden'); // show preview
                        };
                        reader.readAsDataURL(file);
                        fileNameDisplays[index].textContent = file.name; // file name
                    } else {
                        fileNameDisplays[index].textContent = '';
                        imagePreviews[index].classList.add('hidden'); // hide preview kalau no file
                    }
                });
            });
        });
    </script>
@endsection
