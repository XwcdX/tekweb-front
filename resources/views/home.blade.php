@extends('layout')
@section('head')
    <style>
  
    </style>
@endsection
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

    @include('partials.nav')
    @include('utils.background2')

    <div class="text-gray-900 min-h-screen p-8">
        <!-- Main Content -->
        <div class="w-full bg-white rounded-lg p-6 shadow-lg max-w-7xl mx-auto mb-10 flex items-center justify-center">
            @if (session()->has('email'))
                <h1 class="welcome lg:text-5xl text-3xl text-center font-extrabold text-[--purple]">Welcome {{ $username }}!</h1>
            @endif
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const welcomeMessage = document.querySelector('.welcome');
                    if (welcomeMessage) {
                        const text = welcomeMessage.textContent;
                        welcomeMessage.textContent = '';
                        let i = 0;
                        const typingSpeed = 100;

                        function typeWriter() {
                            if (i < text.length) {
                                welcomeMessage.textContent += text.charAt(i);
                                i++;
                                setTimeout(typeWriter, typingSpeed);
                            }
                        }

                        typeWriter();
                    }
                });
            </script>
        </div>
        <div class="w-full bg-white rounded-lg p-6 shadow-lg max-w-7xl mx-auto">


            <h3 class="lg:text-2xl text-xl mt-5 mb-10">Newest Questions</h1>

                <!-- Loop through questions -->
                @foreach ($questions as $question)
                    <div class="border-b-2 py-4 flex flex-col lg:flex-row">
                        <div class="me-5 mx-1">
                            <!-- Question Title -->
                            <h2 class="text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]">
                                <a
                                    href="{{ route('user.viewQuestions', ['questionId' => $question['id']]) }}">{{ $question['title'] }}</a>
                                {{-- <small class="text-sm text-gray-400">- asked by {{ $question->user->name }}</small> --}}
                            </h2>

                            <!-- Question Snippet -->
                            <p class="text-md text-justify">{{ \Str::limit($question['question'], 150) }}</p>

                            <!-- Interaction buttons -->
                            <div class="mt-3 flex flex-wrap space-x-3">
                                <div class="p-0 font-semibold inline-flex items-center cursor-auto">
                                    <i
                                        class="text-sm mx-1 fa-regular fa-thumbs-up bg-transparent text-gray-500 focus-visible:text-blue-500"></i>
                                    <span class="text-gray-900 text-xs">{{ $question['vote'] }}</span>
                                </div>
                                <div class="p-0 font-semibold inline-flex items-center cursor-auto">
                                    <i
                                        class="text-sm mx-1 fa-solid fa-eye bg-transparent text-gray-500 focus-visible:text-blue-500"></i>
                                    <span class="text-gray-900 text-xs">{{ $question['view'] }}</span>
                                </div>
                                <div class="p-0 font-semibold inline-flex items-center cursor-auto">
                                    <i
                                        class="text-sm mx-1 fa-regular fa-comment bg-transparent text-gray-500 focus-visible:text-blue-500"></i>
                                    <span class="text-gray-900 text-xs">{{ $question['comments_count'] }}</span>
                                </div>
                            </div>

                            <!-- Tags -->
                            {{-- <div id="tags" class="mt-3 flex flex-wrap space-x-0 lg:space-x-3 text-white">
                    @foreach ($question->tags as $tag)
                        <span class="px-3 py-1 bg-[#7494ec] text-sm rounded hover:text-[#485d93] hover:bg-[#a8bcf3] cursor-pointer">{{ $tag->name }}</span>
                    @endforeach
                </div> --}}
                        </div>

                        <!-- Image or Thumbnail -->
                        {{-- @if ($question['image'])
                        <img class="relative lg:w-52 md:w-52 sm:w-48 w-32 object-contain mt-4 lg:mt-0 lg:ml-4"
                            src="{{ asset('storage/' . $question['image']) }}" alt="Question Image">
                    @endif --}}



                    </div>
                @endforeach
                {{ $questions->links() }}
        </div>
    </div>
@endsection
