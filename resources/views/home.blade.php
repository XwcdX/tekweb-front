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

        <h1 class="text-5xl mt-5 mb-10">Newest Questions</h1>
        <div class="border-y-2 py-4 flex">
            <div class="me-5 mx-1">
                <!-- Ganti route -->
                <h2 class="text-2xl text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]"><a href="#route pertanyaan"></a>Title Pertanyaan <small class="text-sm text-gray-400">- asked by [user]</small>
                </h2>
                <!-- klo ada image -->
                <p class="text-md text-justify">Snippet pertanyaan Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim,
                    repellat autem. Dolores laboriosam doloremque veritatis rerum amet quos, voluptatibus consequuntur
                    eius
                    architecto labore deleniti repellat iusto cum suscipit consequatur obcaecati.</p>
                <div id="etc" class="mt-3 flex flex-wrap space-x-3">
                    <span class="p-0 text-xs font-semibold inline-flex items-center cursor-auto">
                        <!-- Upvote Button -->
                        <button aria-pressed="false"
                            class="group flex justify-center items-center p-0 border-0 aspect-square rounded-full bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"
                            style="height: var(--size-button-sm-h);" upvote="">
                            <span class="flex mx-1 text-lg">
                                <svg fill="currentColor" height="16" viewBox="0 0 20 20" width="16"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <span id="votes" class="text-gray-900">11</span>
                    </span>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i
                            class="text-sm mx-1 fa-regular fa-comment bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span
                            class="text-gray-900 text-xs">7</span></div>

                </div>
                <!-- Ganti route -->
                <div id="tags" class="mt-3 flex flex-wrap space-x-3 text-white">
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>angular</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>html</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>css</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>javascript</span>
                </div>
            </div>
            <img class="relative lg:w-52 md:w-52 sm:w-48 w-32 object-contain" src="https://dummyimage.com/600x400/000/fff" alt="">

        </div>
        <div class="border-b-2 py-4 flex">
            <div class="me-5 mx-1">
                <!-- Ganti route -->
                <h2 class="text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]"><a href="#routepertanyaan"></a>Title Pertanyaan <small class="text-sm text-gray-400">- asked by [user]</small>
                </h2>
                <!-- klo ada image -->
                <p class="text-md text-justify">Snippet pertanyaan Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim,
                    repellat autem. Dolores laboriosam doloremque veritatis rerum amet quos, voluptatibus consequuntur
                    eius
                    architecto labore deleniti repellat iusto cum suscipit consequatur obcaecati.</p>
                <div id="etc" class="mt-3 flex flex-wrap space-x-3">
                    <span class="p-0 text-xs font-semibold inline-flex items-center cursor-auto">
                        <!-- Upvote Button -->
                        <button aria-pressed="false"
                            class="group flex justify-center items-center p-0 border-0 aspect-square rounded-full bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"
                            style="height: var(--size-button-sm-h);" upvote="">
                            <span class="flex mx-1 text-lg">
                                <svg fill="currentColor" height="16" viewBox="0 0 20 20" width="16"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10 19c-.072 0-.145 0-.218-.006A4.1 4.1 0 0 1 6 14.816V11H2.862a1.751 1.751 0 0 1-1.234-2.993L9.41.28a.836.836 0 0 1 1.18 0l7.782 7.727A1.751 1.751 0 0 1 17.139 11H14v3.882a4.134 4.134 0 0 1-.854 2.592A3.99 3.99 0 0 1 10 19Zm0-17.193L2.685 9.071a.251.251 0 0 0 .177.429H7.5v5.316A2.63 2.63 0 0 0 9.864 17.5a2.441 2.441 0 0 0 1.856-.682A2.478 2.478 0 0 0 12.5 15V9.5h4.639a.25.25 0 0 0 .176-.429L10 1.807Z">
                                    </path>
                                </svg>
                            </span>
                        </button>
                        <span id="votes" class="text-gray-900">11</span>
                    </span>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i
                            class="text-sm mx-1 fa-regular fa-hand bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span
                            class="text-gray-900 text-xs">12</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i
                            class="text-sm mx-1 fa-regular fa-hand bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span
                            class="text-gray-900 text-xs">12</span></div>
                    <div class="p-0 font-semibold inline-flex items-center cursor-auto"><i
                            class="text-sm mx-1 fa-regular fa-comment bg-transparent text-gray-500 hover:text-blue-500 focus-visible:text-blue-500"></i><span
                            class="text-gray-900 text-xs">7</span></div>

                </div>
                 <!-- Ganti route -->
                 <div id="tags" class="mt-3 flex flex-wrap space-x-3 text-white">
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>angular</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>html</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>css</span>
                    <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer"><a href="#route tags"></a>javascript</span>
                </div>
            </div>
            <img class="relative lg:w-52 md:w-52 sm:w-48 w-32 object-contain" src="https://dummyimage.com/600x400/000/fff" alt="">

        </div>
    </div>
</div>
@endsection

@section('script')

@endsection