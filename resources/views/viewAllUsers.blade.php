@extends('layout')
@section('content')
    <style>
        .tab-active {
            background-color: #633F92;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .tab-inactive {
            background-color: white;
            color: #633F92;
            border-radius: 5px;
            border: 1px solid #633F92;
            padding: 10px 20px;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background-color: white;
            border-radius: 5px;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            flex: 1;
            max-width: 600px;
        }

        .search-bar input {
            border: none;
            outline: none;
            width: 100%;
        }

        .tabs-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .topUser-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .user-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .user-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-info {
            display: flex;
            flex-direction: column;
        }

        .user-tags {
            font-size: 0.9rem;
            color: #666;
        }

        .tab-active,
        .tab-inactive {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
        }

        @keyframes glow {

            0%,
            100% {
                box-shadow: 0 0 5px #fffd44, 0 0 10px #fffd44, 0 0 15px #fffd44, 0 0 20px #fffd44;
            }

            50% {
                box-shadow: 0 0 8px #fffd44, 0 0 15px #fffd44, 0 0 20px #fffd44, 0 0 25px #fffd44;
            }
        }

        .glowing{
          animation: glow 2s infinite;
        }

        @media (max-width: 768px) {
            .flex-container {
                flex-direction: column;
                align-items: stretch;
            }

            .search-bar {
                width: 100%;
            }

            .tabs-container {
                width: 100%;
                justify-content: flex-start;
            }
        }
    </style>

    <div class="max-w-4xl sm:max-w-6xl mx-auto px-4 py-8">
       
        <!-- Our Top Users -->
        <div class="flex flex-col items-center justify-center w-full">
            <h1 class="text-3xl font-semibold text-white underline mb-6">Our Top Users</h1>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 md:gap-x-16 gap-y-8 mb-12">
                {{-- @foreach ($topUsers as $user) --}}
                <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-4 px-4 glowing">
                    <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
                    {{-- <img src="path/to/crown-icon.png" alt="Crown Icon" class="crown-icon"> --}}
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image mx-auto mb-2">
                    <h3 class="font-semibold">
                        <a href="#" class="hover:underline">User 1</a>
                    </h3>
                    <p class="text-sm">Reputation: 560</p>
                    <button class="text-sm font-normal text-blue-500 hover:text-blue-800 transition-all">follow</button>
                </div>
               


                <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-4 px-4 glowing">
                  <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
                  {{-- <img src="path/to/crown-icon.png" alt="Crown Icon" class="crown-icon"> --}}
                  <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image mx-auto mb-2">
                  <h3 class="font-semibold">
                      <a href="#" class="hover:underline">User 1</a>
                  </h3>
                  <p class="text-sm">Reputation: 560</p>
              </div>



              <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-4 px-4 glowing">
                <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
                {{-- <img src="path/to/crown-icon.png" alt="Crown Icon" class="crown-icon"> --}}
                <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image mx-auto mb-2">
                <h3 class="font-semibold">
                    <a href="#" class="hover:underline">User 1</a>
                </h3>
                <p class="text-sm">Reputation: 560</p>
            </div>


            <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-4 px-4 glowing">
              <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
              {{-- <img src="path/to/crown-icon.png" alt="Crown Icon" class="crown-icon"> --}}
              <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image mx-auto mb-2">
              <h3 class="font-semibold">
                  <a href="#" class="hover:underline">User 1</a>
              </h3>
              <p class="text-sm">Reputation: 560</p>
          </div>


          <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-4 px-4 glowing">
            <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
            {{-- <img src="path/to/crown-icon.png" alt="Crown Icon" class="crown-icon"> --}}
            <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image mx-auto mb-2">
            <h3 class="font-semibold">
                <a href="#" class="hover:underline">User 1</a>
            </h3>
            <p class="text-sm">Reputation: 560</p>
        </div>
                {{-- @endforeach --}}
            </div>

            
        </div>


        <!-- Search and Tabs -->
        <h1 class="text-4xl font-semibold text-white mb-6">Informates 😍</h1>
        <div class="flex-container flex justify-between items-center mb-6">
            <!-- Search Bar -->
            <div class="search-bar">
                <input type="text" placeholder="Search users..." class="text-gray-800 placeholder-gray-400">
                <button class="text-[#007bff] ml-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <!-- Tabs -->
            <div class="tabs-container flex space-x-4">
                <button onclick="showTab('reputations')" id="tab-reputations" class="tab-active">Reputations</button>
                <button onclick="showTab('new-users')" id="tab-new-users" class="tab-inactive">New Users</button>
                <button onclick="showTab('voters')" id="tab-voters" class="tab-inactive">Voters</button>
            </div>
        </div>

        <!-- Reputations Tab -->
        <div id="reputations" class="tab-content">
            <div class="user-grid">
                {{-- @foreach ($reputations as $user) --}}
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold">
                            <a href="#" class="hover:underline">User 1</a><button href="" class="ml-[8px] text-sm font-normal text-blue-500 hover:text-blue-800 transition-all">follow</button>
                        </h3>
                        <p class="text-sm">Reputation: 560</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold"><a href="#" class="hover:underline">User 2</a></h3>
                        </h3>
                        <p class="text-sm">Reputation: 300</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">laravel</span>
                            <span class="tag">javascript</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold"><a href="#" class="hover:underline">User 3</a></h3>
                        <p class="text-sm">Reputation: 560</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold"><a href="#" class="hover:underline">User 4</a></h3>
                        <p class="text-sm">Reputation: 560</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold"><a href="#" class="hover:underline">User 5</a></h3>
                        <p class="text-sm">Reputation: 560</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold"><a href="#" class="hover:underline">User 6</a></h3>
                        </h3>
                        <p class="text-sm">Reputation: 560</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">php</span>
                            <span class="tag">java</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>

        <!-- New Users Tab -->
        <div id="new-users" class="tab-content hidden">
            <div class="user-grid">
                <p>No new users to display.</p>
            </div>
        </div>

        <!-- Voters Tab -->
        <div id="voters" class="tab-content hidden">
            <div class="user-grid">
                {{-- @foreach ($voters as $user) --}}
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold">User 3</h3>
                        <p class="text-sm">Voters: 200</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">react</span>
                            <span class="tag">vue</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                <div class="user-card">
                    <img src="https://via.placeholder.com/50" alt="Profile Picture" class="user-image">
                    <div class="user-info">
                        <h3 class="font-semibold">User 4</h3>
                        <p class="text-sm">Voters: 100</p>
                        <div class="user-tags">
                            {{-- @foreach ($user['tags'] as $tag) --}}
                            <span class="tag">node.js</span>
                            <span class="tag">angular</span>
                            {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show selected tab
            document.getElementById(tab).classList.remove('hidden');

            // Update tab styles
            document.querySelectorAll('.tab-active').forEach(tab => {
                tab.className = 'tab-inactive px-4 py-2';
            });

            document.getElementById('tab-' + tab).className = 'tab-active px-4 py-2';
        }
    </script>
@endsection
