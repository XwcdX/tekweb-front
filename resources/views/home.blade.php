@extends('layout')
@section('head')
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
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
        <div class="w-full bg-white rounded-lg p-6 shadow-lg max-w-7xl mx-auto">
            @if (session()->has('email'))
                <h1 class="welcome text-xl sm:text-2xl md:text-3xl lg:text-5xl">
                    <span class="auto-type"></span>!
                </h1>
            @endif
        </div>
        
        <div class="w-full bg-white rounded-lg p-6 shadow-lg max-w-7xl mx-auto">
            <h1 class="lg:text-5xl text-3xl mt-5 mb-10">Newest Questions</h1>

            <!-- Loop through questions -->
            @foreach ($questions as $question)
                <div class="border-b-2 py-4 flex flex-col lg:flex-row">
                    <div class="me-5 mx-1">
                        <!-- Question Title -->
                        <h2 class="text-2xl text-[#7494ec] cursor-pointer hover:text-[#485d93]">
                            <a
                                href="{{ route('user.viewQuestions', ['questionId' => $question['id']]) }}">{{ $question['title'] }}</a>
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
                    </div>
                </div>
            @endforeach
            {{ $questions->links() }}
        </div>
    </div>
@endsection
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const autoTypeElement = document.querySelector('.auto-type');
        const username = @json($username);
        console.log(username);

        // Ensure the element exists before initializing Typed.js
        if (autoTypeElement) {
            // Initialize the typing effect
            new Typed('.auto-type', {
                strings: [`welcome ${username}!`], // Customize phrases
                typeSpeed: 50,  // Speed of typing
                backSpeed: 25,  // Speed of backspacing
                startDelay: 500, // Delay before typing starts
                backDelay: 1000, // Delay before backspacing
                loop: false,     // Type only once
                showCursor: true, // Display cursor
                cursorChar: '|',  // Customize cursor character
            });
        }
    });
</script>
@endsection
