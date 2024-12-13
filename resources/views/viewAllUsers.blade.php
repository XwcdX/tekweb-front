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
        <h1 class="titleTopUser text-4xl font-semibold text-white underline mb-6">Our Top Users</h1>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-x-10 md:gap-x-12 gap-y-8 mb-12">
            @foreach ($users->take(5) as $user)
            <div class="bg-[white] flex flex-col items-center justify-center rounded-lg py-7 px-7 glowing">
                <i class="fa-solid fa-crown text-4xl text-yellow-500"></i>
                <img src="{{ $user['image'] ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image mx-auto mb-2">
                <h3 class="font-semibold">
                    <a href="#" class="hover:underline">{{ $user['username'] }}</a>
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
            <input id="searchInput" type="text" placeholder="Search users..." class="text-gray-800 placeholder-gray-400" onkeyup="searchInput()">
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
        <div id="searchResult" class="user-grid">
            @foreach ($users as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="/{{ $user['id'] }}" class="hover:underline">{{ $user['username'] }}</a>
                        <button href="#" data-user-id="{{ $user['id'] }}" class="follow-btn ml-[8px] text-sm font-normal text-blue-500 hover:text-blue-800 transition-all">follow</button>
                    </h3>
                    <p class="text-sm">Reputation: {{ $user['reputation'] }}</p>
                    <div class="user-tags">
                        <!-- Assuming tags data exists -->
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">example-tag</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- New Users Tab -->
    <div id="new-users" class="tab-content hidden">
        <div class="user-grid">
            @foreach ($users->take(5) as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="#" class="hover:underline">{{ $user['username'] }}</a>
                    </h3>
                    {{-- <p class="text-sm">Joined: {{ $user['created_at']->format('M d, Y') }}</p> --}}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Voters Tab -->
    <div id="voters" class="tab-content hidden">
        <div class="user-grid">
            <p>No data available for voters.</p>
        </div>
    </div>
</div>

@include('utils.trie')

<script>
    let users = <?php echo json_encode($users) ?>;

    const trie = new Trie();

    for (let i = 0; i < users.length; i++) { //Masukkan data ke Node"
        trie.insert(users[i]['username'].toLowerCase())
    }

    function searchInput() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const resultsDiv = document.getElementById('searchResult');
        if (input.length > 0) {
            const results = trie.search(input);
            const matchingUsers = users.filter(user => results.includes(user.username.toLowerCase()));

            resultsDiv.innerHTML = matchingUsers.map(user => `
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="${user.image || 'https://via.placeholder.com/50'}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="/${user.id}" class="hover:underline">${user.username}</a>
                        <button href="#" class="follow-btn ml-[8px] text-sm font-normal text-blue-500 hover:text-blue-800 transition-all">follow</button>
                    </h3>
                    <p class="text-sm">Reputation: ${user.reputation}</p>
                    <div class="user-tags">
                        <span class="tag">example-tag</span>
                    </div>
                </div>
            </div>
        `).join('');
        } else {
            resultsDiv.innerHTML = `
            @foreach ($users as $user)
            <div class="user-card border-2 border-[--purple] rounded-lg">
                <img src="{{ $user['image'] ?? 'https://via.placeholder.com/50' }}" alt="Profile Picture" class="user-image">
                <div class="user-info">
                    <h3 class="font-semibold">
                        <a href="/{{ $user['id'] }}" class="hover:underline">{{ $user['username'] }}</a>
                        <button href="#" data-user-id="{{ $user['id'] }}" class="follow-btn ml-[8px] text-sm font-normal text-blue-500 hover:text-blue-800 transition-all">follow</button>
                    </h3>
                    <p class="text-sm">Reputation: {{ $user['reputation'] }}</p>
                    <div class="user-tags">
                        <!-- Assuming tags data exists -->
                        {{-- @foreach ($user['tags'] as $tag) --}}
                        <span class="tag">example-tag</span>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
            @endforeach
            `;
        }

    }
    document.addEventListener('DOMContentLoaded', () => {
        // click event listener semua follow buttons
        document.querySelectorAll('.follow-btn').forEach(button => {
            button.addEventListener('click', async (e) => {
                e.preventDefault();

                const userId = button.getAttribute('data-user-id');

                try {
                    const response = await fetch("{{ route('nembakFollow') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id: userId })
                    });

                    const result = await response.json();

                    if (result.ok) {
                        button.textContent = 'Following';
                        button.classList.add('text-gray-500');
                        button.disabled = true; // gabisa multiple clicks
                    } else {
                        alert(result.message || 'Failed to follow user.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while trying to follow the user.');
                }
            });
        });
    });
    
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