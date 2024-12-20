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
</style>
<div class="text-gray-900 min-h-screen p-6">
    <!-- Main Content -->
    <div class="w-full bg-white rounded-lg p-6 shadow-lg">
        <h1 class="self-center text-[#7494ec] lg:text-4xl text-2xl font-bold text-center">Edit Profile</h1>
        <!-- Profile Header -->
        <div class="my-5 w-full">
            <p class="text-[#7494ec] text-2xl font-bold text-center sm:text-left">Profile Picture</p>
            <div class="flex justify-center items-center p-4">
                <div class="relative w-36 h-36 rounded-full overflow-hidden shadow-lg cursor-pointer"
                    id="upload-profile">
                    <img id="profile-img" src="https://via.placeholder.com/150" alt="Profile Picture"
                        class="w-full h-full object-contain rounded-full">
                    <div
                        class="absolute bottom-2 right-2 bg-white rounded-full w-10 h-10 flex justify-center items-center shadow-md hover:bg-gray-200">
                        <button class="text-gray-700 text-xl">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                    <!-- Hidden file input -->
                    <input type="file" id="profile-input" class="hidden" accept="image/*">
                </div>
            </div>
        </div>

        <div class="my-5 sm:mt-0 flex flex-wrap gap-4 items-center">
            <h2 class="text-[#7494ec] text-2xl font-bold text-center sm:text-left lg:me-10">Username</h2>
            <div class="bg-white p-4 rounded-lg w-full sm:w-72">
                <div class="relative bg-inherit">
                    <input type="text" id="username" name="username"
                        class="peer bg-transparent h-10 w-full rounded-lg text-gray-800 focus:ring-indigo-900 focus:outline-none focus:border-indigo-600"
                        placeholder="" value="{{ $user['username'] }}" />
                </div>
            </div>
        </div>

        <div class="my-5 sm:mt-0 flex flex-wrap gap-4 items-center">
            <h2 class="text-[#7494ec] text-2xl font-bold text-center sm:text-left lg:me-10">Biodata</h2>
            <div class="bg-white lg:p-10 md:p-10 sm:p-4 p-4 rounded-lg w-full sm:w-72">
                <div class="relative bg-inherit">
                    <textarea type="text" id="biodata" name="biodata"
                        class="peer bg-transparent h-48 resize-none lg:w-96 w-full rounded-lg text-gray-800 focus:ring-indigo-900 focus:outline-none focus:border-indigo-600"
                        placeholder="" value="{{ $user['username'] }}"></textarea>
                </div>
            </div>
        </div>

        <div class="w-full flex gap-2 justify-center">
            <button type="submit"
                class="relative px-4 py-2 bg-[#7494ec] hover:bg-[#485d93] rounded text-white w-full sm:w-auto">
                <a href="#route save profile">
                    Save</a>
            </button>
            <button type="cancel"
                class="relative px-4 py-2 bg-[#7494ec] hover:bg-[#485d93] rounded text-white w-full sm:w-auto">
                <a href="{{route('seeProfile')}}">
                    Cancel</a>
            </button>
        </div>


    </div>
</div>

<script>
    document.getElementById('upload-profile').addEventListener('click', function () {
        document.getElementById('profile-input').click();
    });

    // Handle the image file selection
    document.getElementById('profile-input').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                // Set new image as profile
                document.getElementById('profile-img').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
@section('script')
@endsection