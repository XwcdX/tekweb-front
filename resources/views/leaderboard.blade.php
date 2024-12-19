@extends('layout')

@section('content')
    <style>
        /* Title Styling */
        .titleTopUser {
            background: linear-gradient(90deg, #633F92, #7494ec, #5500a4, white, #633F92);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: animateText 30s linear infinite;
            background-size: 400%;
            font-weight: 900;
            word-spacing: 5px;
        }

        @keyframes animateText {
            0% {
                background-position: 0%;
            }

            100% {
                background-position: 500%;
            }
        }

        /* Container for Top 5 Users */
        .topUser-grid {
            display: grid;
            /* grid-template-columns: repeat(auto-fit, minmax(220px, 4fr)); */
            gap: 1rem;
            justify-content: center;
            align-items: stretch;
        }

        /* Card Styling */
        .user-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            /* Make it responsive within the grid */
            width: 150px;
            /* Set a maximum width for cards */
            height: 250px;
            /* Uniform height */
            padding: 1rem;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        /* Hover Effects */
        .user-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        /* Profile Image */
        .user-card .user-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 1rem;
        }

        /* Text Styling */
        .user-card h3 {
            font-size: 1rem;
            text-align: center;
            margin: 0.5rem 0;
        }

        .user-card p {
            font-size: 0.875rem;
            text-align: center;
            margin: 0;
        }

        .user-card i {
            font-size: 2rem;
            color: #f39c12;
            margin-bottom: 0.5rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .user-card {
                height: 280px;
            }
        }

        @media (max-width: 480px) {
            .user-card {
                height: 200px;
                width: 200px;
            }
        }
    </style>

    <style>
        div {
            margin: auto;
        }

        .card-container {
            perspective: 800px;
        }

        .card {
            position: relative;
            width: 258px;
            height: 431px;
            transform-style: preserve-3d;
            transition: transform 0.6s ease-in-out;
            cursor: pointer;
        }

        .card .front,
        .card .back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .card .front {
            background-image: url("{{ asset('assets/front_card.png') }}");
            background-size: cover;
        }

        .card .back {
            background-image: url("{{ asset('assets/back_card.png') }}");
            background-size: cover;
            transform: rotateY(180deg);
        }

        .card.flipped {
            transform: rotateY(180deg);
        }
    </style>
    <div class="max-w-7xl min-h-screen mx-auto">
        <h1 class="text-center text-white font-bold text-2xl md:text-4xl p-4 md:p-8 uppercase">Leaderboard</h1>

        <!-- Top Users Section -->
        <div class="flex flex-col items-center justify-center mb-6">
            <h1 class="titleTopUser text-4xl font-semibold text-white underline mb-6">Top 5 Users</h1>

            <div class="topUser-grid grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Card 1 -->
                <div class="user-card">
                    <i class="fa-solid fa-crown"></i>
                    <img src="https://via.placeholder.com/80" alt="User 1" class="user-image">
                    <h3><a href="#" class="hover:underline">User 1</a></h3>
                    <p>Reputation: 560</p>
                </div>

                <!-- Card 2 -->
                <div class="user-card">
                    <i class="fa-solid fa-crown"></i>
                    <img src="https://via.placeholder.com/80" alt="User 2" class="user-image">
                    <h3><a href="#" class="hover:underline">User 2</a></h3>
                    <p>Reputation: 520</p>
                </div>

                <!-- Card 3 -->
                <div class="user-card">
                    <i class="fa-solid fa-crown"></i>
                    <img src="https://via.placeholder.com/80" alt="User 3" class="user-image">
                    <h3><a href="#" class="hover:underline">User 3</a></h3>
                    <p>Reputation: 500</p>
                </div>

                <!-- Card 4 -->
                <div class="user-card">
                    <i class="fa-solid fa-crown"></i>
                    <img src="https://via.placeholder.com/80" alt="User 4" class="user-image">
                    <h3><a href="#" class="hover:underline">User 4</a></h3>
                    <p>Reputation: 480</p>
                </div>

                <!-- Card 5 -->
                <div class="user-card">
                    <i class="fa-solid fa-crown"></i>
                    <img src="https://via.placeholder.com/80" alt="User 5" class="user-image">
                    <h3><a href="#" class="hover:underline">User 5</a></h3>
                    <p>Reputation: 450</p>
                </div>
            </div>
        </div>

        {{-- each tags best user --}}
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl text-white font-semibold">BEST USER IN EACH TAGS</h1>
        </div>
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl font-semibold text-[--blue] mb-4">YOUR SPECIAL PERSON</h1>
            <div class="card-container">
                <div class="card">
                    <div class="front flex flex-col items-center justify-center">
                        <img src="{{ asset('background/texture_1.jpg') }}" alt="front"
                            class="mb-2 w-40 h-40 object-cover rounded-full">
                        <h1 class="text-2xl font-semibold text-white">John Doe</h1>
                        {{-- <p class="text-sm text-[--white]">Best User</p> --}}

                    </div>
                    <div class="back relative flex flex-col items-center justify-center">
                        <small class="absolute bottom-[10%] text-white">click to open</small>

                    </div>
                </div>
            </div>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.card');

            card.addEventListener('click', function() {
                card.classList.toggle('flipped');
            });
        });
    </script>
@endsection
