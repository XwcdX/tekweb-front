@extends('layout')
@section('content')
    @include('utils.background3')
    <style>
        .titleTopUser {
            background: linear-gradient(90deg, #633F92, #7494ec, #5500a4, white, #633F92);
            -webkit-background: linear-gradient(90deg, #633F92, #7494ec, #5500a4, white, #633F92);
            background-size: 400%;
            font-weight: 900 !important;
            /* letter-spacing: 5px; */
            word-spacing: 5px;
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
            -webkit-animation: animateText 30s linear infinite;

        }

        @keyframes animateText {
            0% {
                background-position: 0%;
            }

            100% {
                background-position: 500%;
            }
        }

        @-webkit-keyframes animateText {
            0% {
                background-position: 0%;
            }

            100% {
                background-position: 500%;
            }
        }

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
            /* border: 1px solid #ccc;
                                border-radius: 10px; */
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

        .glowing {
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
            @if ($recommended)
                <h1 class="titleTopUser text-4xl font-semibold text-white underline mb-6">Recommended For You</h1>
            @endif
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 md:gap-x-12 gap-y-8 mb-12">
                @foreach ($recommended as $user)
                    <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-7 px-7 glowing">
                        <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
                        <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}"
                            alt="Profile Picture" class="user-image mx-auto mb-2">
                        <h3 class="font-semibold">
                            <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                                class="hover:underline">{{ $user['username'] }}</a>
                        </h3>
                        <p class="text-sm">Reputation: {{ $user['reputation'] }}</p>
                    </div>
                @endforeach
            </div>


        </div>


        <!-- Search and Tabs -->
        <h1 class="text-4xl font-semibold text-white mb-6">Informates 😍</h1>
        <div class="flex-container flex justify-between items-center mb-6">
            <!-- Search Bar -->
            <div class="search-bar">
                <input id="searchInput" type="text" placeholder="Search users..."
                    class="text-gray-800 placeholder-gray-400" oninput="searchInput()">
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
            <div class="user-grid" id="reputationResult">
                @foreach ($order_by_reputation as $user)
                    <div class="user-card border-2 border-[--purple] rounded-lg">
                        <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}"
                            alt="Profile Picture" class="user-image">
                        <div class="user-info">
                            <h3 class="font-semibold">
                                <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                                    class="hover:underline">{{ $user['username'] }}</a>
                            </h3>
                            <p class="text-sm">Reputation: {{ $user['reputation'] }}</p>
                            <div class="user-tags">
                                {{-- @foreach ($user['tags'] as $tag) --}}
                                <span class="tag">php</span>
                                <span class="tag">java</span>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- New Users Tab -->
        <div id="new-users" class="tab-content hidden">
            <div class="user-grid" id="newestResult">
                @foreach ($order_by_newest as $user)
                    <div class="user-card border-2 border-[--purple] rounded-lg">
                        <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}"
                            alt="Profile Picture" class="user-image">
                        <div class="user-info">
                            <h3 class="font-semibold">
                                <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                                    class="hover:underline">{{ $user['username'] }}</a>
                            </h3>
                            <p class="text-sm text-blue-800 ">Since {{ $user['created_at'] }}</p>
                            <div class="user-tags">
                                {{-- @foreach ($user['tags'] as $tag) --}}
                                <span class="tag">php</span>
                                <span class="tag">java</span>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Voters Tab -->
        <div id="voters" class="tab-content hidden">
            <div class="user-grid" id="voterResult">
                @foreach ($order_by_vote as $user)
                    <div class="user-card border-2 border-[--purple] rounded-lg">
                        <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}"
                            alt="Profile Picture" class="user-image">
                        <div class="user-info">
                            <h3 class="font-semibold"> <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                                    class="hover:underline">{{ $user['username'] }}</a>
                            </h3>
                            <p class="text-sm">Voters: {{ $user['vote_count'] }}</p>
                            <div class="user-tags">
                                {{-- @foreach ($user['tags'] as $tag) --}}
                                <span class="tag">react</span>
                                <span class="tag">vue</span>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('utils.trie')

    <script>
        let searchSwitch = 1; //switch cari berdasarkan tabs yang dipilih

        let byReputation = <?php echo json_encode($order_by_reputation); ?>;
        let byNewest = <?php echo json_encode($order_by_newest); ?>;
        let byVote = <?php echo json_encode($order_by_vote); ?>;

        const reputationTrie = new Trie(); //untuk Reputations tabs

        for (let i = 0; i < byReputation.length; i++) { //Masukkan data ke Node"
            reputationTrie.insert(byReputation[i]['username'].toLowerCase())
        }

        const newestUserTrie = new Trie(); //untuk New Users tabs

        for (let i = 0; i < byNewest.length; i++) {
            newestUserTrie.insert(byNewest[i]['username'].toLowerCase())
        }

        const voterTrie = new Trie(); //untuk Voters tabs

        for (let i = 0; i < byVote.length; i++) {
            voterTrie.insert(byVote[i]['username'].toLowerCase())
        }

        function searchInput() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const baseUrl = "{{ route('viewUser', ['email' => ':email']) }}";

            if (input.length > 0) {
                if (searchSwitch === 1) {
                    const resultsDiv = document.getElementById('reputationResult');
                    const results = reputationTrie.search(input);
                    const matchingUsers = byReputation.filter(user => results.includes(user.username.toLowerCase()));


                    resultsDiv.innerHTML = matchingUsers.map(user => `
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="${user.image ? `storage/${user.image}` : 'https://via.placeholder.com/50'}"  alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                <a href="${baseUrl.replace(':email', user.email)}" class="hover:underline">${user.username}</a>
                    </h3>
                    <p class="text-sm">Reputation: ${user.reputation}</p>
                    <div class="user-tags">
                        <span class="tag">example-tag</span>
                    </div>
                </div>
            </div>
        `).join('');
                } else if (searchSwitch === 2) {
                    const resultsDiv = document.getElementById('newestResult');
                    const results = newestUserTrie.search(input);
                    const matchingUsers = byNewest.filter(user => results.includes(user.username.toLowerCase()));

                    resultsDiv.innerHTML = matchingUsers.map(user => `
                            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="${user.image ? `storage/${user.image}` : 'https://via.placeholder.com/50'}"  alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                <a href="${baseUrl.replace(':email', user.email)}" class="hover:underline">${user.username}</a>
                    </h3>
                    <p class="text-sm text-blue-800 ">Since ${user.created_at}</p>
                    <div class="user-tags">
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">php</span>
                        <span class="tag">java</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            `).join('');
                } else if (searchSwitch === 3) {
                    const resultsDiv = document.getElementById('voterResult');
                    const results = voterTrie.search(input);
                    const matchingUsers = byVote.filter(user => results.includes(user.username.toLowerCase()));

                    resultsDiv.innerHTML = matchingUsers.map(user => `
                            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="${user.image ? `storage/${user.image}` : 'https://via.placeholder.com/50'}"  alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold"> 
                <a href="${baseUrl.replace(':email', user.email)}" class="hover:underline">${user.username}</a>
                    </h3>
                    <p class="text-sm">Voters: ${user.vote_count}</p>
                    <div class="user-tags">
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">react</span>
                        <span class="tag">vue</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            `).join('');

                }
            } else {
                if (searchSwitch === 1) {
                    document.getElementById('reputationResult').innerHTML = `
                @foreach ($order_by_reputation as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                            class="hover:underline">{{ $user['username'] }}</a>
                    </h3>
                    <p class="text-sm">Reputation: {{ $user['reputation'] }}</p>
                    <div class="user-tags">
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">php</span>
                        <span class="tag">java</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            @endforeach
                `;
                } else if (searchSwitch === 2) {
                    document.getElementById('newestResult').innerHTML = `
                    @foreach ($order_by_newest as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                            class="hover:underline">{{ $user['username'] }}</a>
                    </h3>
                    <p class="text-sm text-blue-800 ">Since {{ $user['created_at'] }}</p>
                    <div class="user-tags">
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">php</span>
                        <span class="tag">java</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            @endforeach
                    `;

                } else if (searchSwitch === 3) {
                    document.getElementById('voterResult').innerHTML = `
                    @foreach ($order_by_vote as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ? asset('storage/' . $user['image']) : 'https://via.placeholder.com/50' }}"alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold"> <a href="{{ route('viewUser', ['email' => $user['email']]) }}"
                            class="hover:underline">{{ $user['username'] }}</a>
                    </h3>
                    <p class="text-sm">Voters: {{ $user['vote_count'] }}</p>
                    <div class="user-tags">
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">react</span>
                        <span class="tag">vue</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            @endforeach
                    `;
                }
            }
        }

        function showTab(tab) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show selected tab
            document.getElementById(tab).classList.remove('hidden');

            if (tab.includes('reputations')) {
                searchSwitch = 1;
            } else if (tab.includes('new-users')) {
                searchSwitch = 2;
            } else {
                searchSwitch = 3;
            }

            // Update tab styles
            document.querySelectorAll('.tab-active').forEach(tab => {
                tab.className = 'tab-inactive px-4 py-2';
            });

            document.getElementById('tab-' + tab).className = 'tab-active px-4 py-2';
            searchInput();

        }
    </script>
@endsection
