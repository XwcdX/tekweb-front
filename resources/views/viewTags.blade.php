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
            @foreach ($tags as $index => $tag)
                <div class="bg-white shadow-md rounded-lg p-4 border-b-4 border-l-4 border-b-[--purple] border-l-[--bblue]">
                    <div class="flex items-center">
                        <h3 class="text-lg font-semibold text-[--purple] capitalize">{{ $tag['name'] }}</h3>

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
