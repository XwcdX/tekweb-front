@extends('layout')
@section('content')
    @include('partials.nav')
    @include('utils.background')
    <style>
        @keyframes wiggle {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }
        }

        .animate-wiggle {
            animation: wiggle 0.5s ease-in-out infinite;
        }
    </style>
    <div class="container mx-auto py-8 px-4 max-w-7xl">
        <div class=" mb-6">
            <h1 class="text-2xl font-bold text-white flex items-center">
                Tags
            </h1>
            <div class="mt-2 ml-4 p-2 rounded-lg">
                <p class="text-sm md:text-lg text-white">Tags represent all the courses offered in the Informatics,
                    Business Information Systems, and Data Science and Analytics programs
                    at Petra Christian University.
                    Each tag corresponds to a specific course.</p>
            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
                // Dummy data (hardcoded)
                $tags = [
                    [
                        'name' => 'javascript',
                        'questions' => 2537050,
                        'asked_today' => 74,
                        'asked_this_week' => 638,
                        'description' =>
                            'JavaScript is a programming language used to create interactive effects within web browsers.',
                    ],
                    [
                        'name' => 'python',
                        'questions' => 2217530,
                        'asked_today' => 128,
                        'asked_this_week' => 1159,
                        'description' =>
                            'Python is a high-level, interpreted language with a focus on readability and simplicity.',
                    ],
                    [
                        'name' => 'java',
                        'questions' => 1922458,
                        'asked_today' => 52,
                        'asked_this_week' => 506,
                        'description' =>
                            'Java is known for its "Write Once, Run Anywhere" capability and is widely used in enterprise applications.',
                    ],
                    [
                        'name' => 'c#',
                        'questions' => 1625547,
                        'asked_today' => 56,
                        'asked_this_week' => 453,
                        'description' =>
                            'C# is used for developing Windows applications, web services, and games using the .NET framework.',
                    ],
                    [
                        'name' => 'php',
                        'questions' => 1469534,
                        'asked_today' => 24,
                        'asked_this_week' => 246,
                        'description' =>
                            'PHP is commonly used in server-side web development and powers a large number of websites.',
                    ],
                    [
                        'name' => 'android',
                        'questions' => 1421767,
                        'asked_today' => 41,
                        'asked_this_week' => 379,
                        'description' =>
                            'Android powers a vast number of smartphones and tablets, offering a rich app ecosystem.',
                    ],
                    [
                        'name' => 'html',
                        'description' => 'HTML is the markup language for creating web pages',
                        'questions' => 1191029,
                        'asked_today' => 35,
                        'asked_this_week' => 326,
                        'description' => 'HTML is the standard language used to create web pages and web applications.',
                    ],
                    [
                        'name' => 'jquery',
                        'questions' => 1033902,
                        'asked_today' => 5,
                        'asked_this_week' => 38,
                        'description' =>
                            'jQuery simplifies JavaScript programming by providing easy-to-use functions for HTML document manipulation.',
                    ],
                ];
            @endphp

            @foreach ($tags as $index => $tag)
                <div class="bg-white shadow-md rounded-lg p-4 border-b-4 border-l-4 border-b-[--purple] border-l-[--bblue]">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-[--purple] capitalize text-center">{{ $tag['name'] }}</h3>

                        <span
                            class="material-symbols-outlined text-[--purple] text-2xl cursor-pointer toggle-btn hover:animate-wiggle"
                            data-target="description-{{ $index }}">
                            play_arrow
                        </span>
                    </div>

                    <div id="description-{{ $index }}" class="hidden my-1 text-[--purple] text-sm">
                        <p>{{ $tag['description'] }}</p>
                    </div>

                    <div class="text-[--bblue] text-xs">
                        <p><strong>{{ number_format($tag['questions']) }}</strong> questions</p>
                        <p>{{ $tag['asked_today'] }} asked today, {{ $tag['asked_this_week'] }} this week</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-btn');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = button.getAttribute('data-target');
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        targetElement.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
@endsection
