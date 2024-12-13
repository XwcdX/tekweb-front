@extends('layout')
@section('content')
@if (session()->has('Error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('
        Error ') }}'
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

    /* text-area scrollbar */
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

    /* Code formatting */
    .code-format {
        font-family: 'Courier New', Courier, monospace;
        background-color: #f7f7f7;
        padding: 8px;
        border-radius: 5px;
    }

    .list-item {
        margin-left: 1em;
        list-style-type: decimal;
    }

    .list-container {
        padding-left: 20px;
    }
</style>
@include('partials.nav')
<div class="text-gray-900 min-h-screen p-6">
    <!-- Main Content -->
    <div class="w-full bg-white rounded-lg p-6 shadow-lg">
        <h1 class="text-xl text-center font-semibold">Having a difficult time? Ask for help! <i
                class="fa-solid fa-graduation-cap"></i></h1>
        <h1 class="font-bold text-xl">Create a post</h1>
        <form action="{{ route('nembakAsk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-5">
                <label for="title-input" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                <input type="text" id="title-input"
                    class="block w-[50%] p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Insert title here....">
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
                            <!-- start nav -->
                            <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                                <!-- Undo button -->
                                <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                                    onclick="undoText()">
                                    <i class="fa-solid fa-rotate-left"></i>
                                    <span class="sr-only">Undo</span>
                                </button>

                                <!-- Redo button -->
                                <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                                    onclick="redoText()">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    <span class="sr-only">Redo</span>
                                </button>
                                <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                                    id="upload-image-btn">
                                    <i class="fa-solid fa-image text-gray-500"></i> Upload Image
                                </button>
                                <!-- <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                                    id="format-code-btn">
                                    <i class="fa-solid fa-code text-gray-500"></i> Format Code
                                </button>
                                <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600"
                                    id="add-list-btn">
                                    <i class="fa-solid fa-list text-gray-500"></i> Add List
                                </button> -->
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800">
                        <textarea id="editor" rows="8"
                            class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                            placeholder="Write the details here..." required></textarea>
                        <div id="image-group" class="mx-2 space-y-3 overflow-hidden">
                            <!-- Images will appear here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <input type="text" id="tags-input"
                    class="block w-[25%] p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Add Tags">
            </div>
            <div id="tags" class="mt-3 flex flex-wrap space-x-3 text-white">

                <span
                    class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a
                        href="#route tags"></a>angular</span>
                <span
                    class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a
                        href="#route tags"></a>html</span>
                <span
                    class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a
                        href="#route tags"></a>css</span>
                <span
                    class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a
                        href="#route tags"></a>javascript</span>
            </div>
            <button type="submit"
                class="mt-10 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                Publish
            </button>
        </form>

    </div>
</div>
@endsection

@section('script')
<script>
    function undoText() {
        const editor = document.getElementById('editor');
        editor.setSelectionRange(editor.selectionStart, editor.selectionEnd);
        document.execCommand('undo');
    }

    function redoText() {
        const editor = document.getElementById('editor');
        editor.setSelectionRange(editor.selectionStart, editor.selectionEnd);
        document.execCommand('redo');
    }


    // Image upload
    document.getElementById("upload-image-btn").addEventListener("click", function() {
    let fileInput = document.createElement("input");
    fileInput.type = "file";
    fileInput.accept = "image/*";
    fileInput.addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageURL = e.target.result;
                const imageGroup = document.getElementById("image-group");
                const imageElement = document.createElement("div");
                imageElement.classList.add("w-full", "p-5", "border-2", "rounded", "border-gray-600", "text-white");
                imageElement.innerHTML = `<i class="fa-solid fa-image text-gray-500"></i> ${file.name}`;
                imageGroup.appendChild(imageElement);
            };
            reader.readAsDataURL(file);
        }
    });
    fileInput.click();
});

document.querySelector('form').addEventListener('submit', function(event) {
    const editor = document.getElementById('editor');
    const titleInput = document.getElementById('title-input');
    const tagsInput = document.getElementById('tags-input');
    
    const questionContent = editor.value;

    const questionField = document.createElement('input');
    questionField.type = 'hidden';
    questionField.name = 'question';
    questionField.value = questionContent;
    this.appendChild(questionField);
    
    const titleField = document.createElement('input');
    titleField.type = 'hidden';
    titleField.name = 'title';
    titleField.value = titleInput.value;
    this.appendChild(titleField);
    
    const tagsField = document.createElement('input');
    tagsField.type = 'hidden';
    tagsField.name = 'tags';
    tagsField.value = tagsInput.value;
    this.appendChild(tagsField);

    const imageGroup = document.getElementById("image-group");
    const images = imageGroup.querySelectorAll('div');
    images.forEach(function(image) {
        const imageData = image.innerText;
        const imageField = document.createElement('input');
        imageField.type = 'hidden';
        imageField.name = 'images[]';
        imageField.value = imageData;
        this.appendChild(imageField);
    });
});

</script>
@endsection