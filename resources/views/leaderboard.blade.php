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

        .card1 {
            position: relative;
            width: 274px;
            height: 431px;
            transition: transform 0.6s ease-in-out;
        }

        .card .front,
        .card .back,
        .card1 .reveal {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .card1 .reveal {
            background-image: url("{{ asset('assets/reveal_card.png') }}");
            background-size: cover;
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

        /* select {
                    margin-bottom: 1em;
                    padding: .25em;
                    border: 0;
                    border-bottom: 2px solid currentcolor;
                    font-weight: bold;
                    letter-spacing: .15em;
                    border-radius: 0;

                    &:focus,
                    &:active {
                        outline: 0;
                        border-bottom-color: red;
                    }
                } */
    </style>
    <div class="max-w-7xl min-h-screen mx-auto">
        <h1 class="text-center text-white font-bold text-2xl md:text-4xl p-4 md:p-8 uppercase">Leaderboard</h1>

        <!-- Top Users Section -->
        <div class="flex flex-col items-center justify-center mb-6">
            <h1 class="titleTopUser text-4xl font-semibold text-white underline mb-6">Top 5 Users You Might Be Interested
            </h1>

            <div class="topUser-grid grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @if ($users)
                    @foreach ($users as $user)
                        <div class="user-card">
                            <i class="fa-solid fa-crown"></i>
                            <img src="{{ asset('storage/' . $user['image']) }}" alt="{{ $user['name'] }}" class="user-image">
                            <h3><a href="{{ route('viewOthers', ['email' => $user['email']]) }}"
                                    class="hover:underline">{{ $user['name'] }}</a></h3>
                            <p>Reputation: {{ $user['reputation'] }}</p>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

        {{-- each tags best user --}}
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl text-white font-semibold">BEST USER IN EACH TAGS</h1>
            <select name="tags" id="tags"
                class="my-4 appearance-none border-0 border-b-2 border-current font-bold tracking-widest bg-white !focus:outline-none text-[--purple] rounded-lg">
                <option value="" disabled selected class="text-gray-500">Choose one tag you want</option>
                @foreach ($tags as $tag)
                    <option value="{{ $tag['id'] }}" class="text-gray-500">{{ $tag['name'] }}</option>
                @endforeach
            </select>
            <div class="card1 mt-4">
                <div class="reveal flex flex-col items-center justify-center">
                    <img src="https://via.placeholder.com/80" class="mb-2 w-40 h-40 object-cover rounded-full"
                        id="best-user-image" alt="Best User Image">
                    <h1 class="text-2xl font-semibold text-white" id="best-user-name"></h1>

                </div>
            </div>
        </div>

        <div class="mt-8 flex flex-col items-center justify-center">
            <h1 class="text-2xl font-semibold text-[--blue] mb-4">YOUR SPECIAL PERSON</h1>
            <div class="card-container">
                <div class="card">
                    <div class="front flex flex-col items-center justify-center">
                        <img src="{{ asset('background/texture_1.jpg') }}" alt="front"
                            class="mb-2 w-40 h-40 object-cover rounded-full">
                        <h1 class="text-2xl font-semibold text-white">John Doe</h1>

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
            const selectElement = document.getElementById('tags');
            const bestUserImage = document.getElementById('best-user-image');
            const bestUserName = document.getElementById('best-user-name');

            selectElement.addEventListener('change', function() {
                const tagId = this.value;
                console.log(tagId);
                if (tagId) {
                    fetch(`/getTagLeaderboard/${tagId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.user) {
                                bestUserImage.src = data.user.profile_picture ||
                                    'https://via.placeholder.com/80';
                                bestUserName.textContent = data.user.name || 'Best User';
                            } else {
                                bestUserImage.src = 'https://via.placeholder.com/80';
                                bestUserName.textContent = 'No User Found';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching leaderboard:', error);
                            bestUserImage.src = 'https://via.placeholder.com/80';
                            bestUserName.textContent = 'Error Loading User';
                        });
                } else {
                    bestUserImage.src = 'https://via.placeholder.com/80';
                    bestUserName.textContent = '';
                }
            });


            const card = document.querySelector('.card');

            card.addEventListener('click', function() {
                card.classList.toggle('flipped');
            });
        });
    </script>
@endsection
