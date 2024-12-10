@extends('layout')
@section('content')
@if (session()->has('Error'))
    <Script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('Error') }}'
        });
    </Script>
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
</style>
@include('partials.nav')
<div class="text-gray-900 min-h-screen p-6">
    <!-- Main Content -->
    <div class="w-full bg-white rounded-lg p-6 shadow-lg">
        @if (session()->has('email'))
            <h3>Welcome! {{$user['username']}}</h3>
        @endif

        <h1 class="text-5xl mt-5 mb-10">Popular Questions <i class="fa-solid fa-fire text-[#ec9074]"></i></h1>
        <div class="border-y-2 py-4 flex flex-col lg:flex-row">
            <div class="me-5 mx-1">
                <!-- Ganti route -->
                <h2 class="text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]">
                    <a href="#route pertanyaan"></a>Title Pertanyaan <small class="text-sm text-gray-400">- asked by [user]</small>
                </h2>
                <p class="text-md text-justify">Snippet pertanyaan Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, repellat autem. Dolores laboriosam doloremque veritatis rerum amet quos, voluptatibus consequuntur eius architecto labore deleniti repellat iusto cum suscipit consequatur obcaecati.</p>
                <div id="etc" class="mt-3 flex flex-wrap space-x-3">
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-thumbs-up bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">7</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-hand bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">12</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-comment bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">7</span></div>
                </div>
                <div id="tags" class="mt-3 flex flex-wrap space-x-0 lg:space-x-3 text-white">
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>angular</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>html</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>css</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>javascript</span>
                </div>
            </div>
            <img class="relative lg:w-52 md:w-52 sm:w-48 w-32 object-contain mt-4 lg:mt-0 lg:ml-4" src="https://dummyimage.com/600x400/000/fff" alt="">
        </div>
        <div class="border-b-2 py-4 flex flex-col lg:flex-row">
            <div class="me-5 mx-1">
                <h2 class="text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]">
                    <a href="#routepertanyaan"></a>Title Pertanyaan <small class="text-sm text-gray-400">- asked by [user]</small>
                </h2>
                <p class="text-md text-justify">Snippet pertanyaan Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, repellat autem. Dolores laboriosam doloremque veritatis rerum amet quos, voluptatibus consequuntur eius architecto labore deleniti repellat iusto cum suscipit consequatur obcaecati.</p>
                <div id="etc" class="mt-3 flex flex-wrap space-x-3">
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-thumbs-up bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">7</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-hand bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">12</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i class="text-sm mx-1 fa-regular fa-comment bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span class="text-gray-900 text-xs">7</span></div>
                </div>
                <div id="tags" class="mt-3 flex flex-wrap space-x-0 lg:space-x-3 text-white">
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>angular</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>html</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>css</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>javascript</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection
