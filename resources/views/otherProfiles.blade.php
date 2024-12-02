@extends('layout')
@section('content')
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
    <div class="text-gray-900 min-h-screen p-6">
        <!-- Main Content -->
        <div class="w-full bg-white rounded-lg p-6 shadow-lg">
            <!-- Profile Header -->
            <div class="flex items-center flex-col sm:flex-row sm:space-x-4">
                <img src="https://via.placeholder.com/100" alt="Profile Picture" class="w-20 h-20 rounded-full">
                <div class="mt-6 sm:mt-0">
                    <h2 class="text-[#7494ec] text-2xl font-bold text-center sm:text-left">Naren Murali</h2>
                </div>
            </div>
            <!-- Edit Profile and Followers -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-center mt-4">
                <!-- Followers Count -->
                <div class="text-center">
                    <h3 class="text-[#7494ec] text-lg font-bold">1.2k</h3>
                    <p class="text-gray-500 text-sm">Followers</p>
                </div>
                <!-- Edit Profile Button -->
                <div class="text-center sm:text-right">
                    <button class="px-4 py-2 bg-[#7494ec] text-white rounded-lg hover:bg-[#7494ec] transition">
                        Follow
                    </button>
                </div>
            </div>
            <!-- Content Sections -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 mt-6">
                <!-- Stats Section -->
                <div class="col-span-1 lg:col-span-3">
                    <div class="border border-[#7494ec] shadow-lg p-4 rounded-lg bg-white">
                        <h2 class="text-[#7494ec] text-lg font-bold">Stats</h2>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <div class="text-[#7494ec]">Reputations</div>
                        </div>
                    </div>
                </div>
                <!-- About and Other Sections -->
                <div class="col-span-1 lg:col-span-9">
                    <!-- About Section -->
                    <div>
                        <h3 class="text-[#7494ec] text-xl font-bold">About</h3>
                        <div class="mt-3 flex flex-wrap space-x-3 text-white">
                            <span class="px-3 py-1 bg-[#7494ec] text-sm rounded">angular</span>
                            <span class="px-3 py-1 bg-[#7494ec] text-sm rounded">html</span>
                            <span class="px-3 py-1 bg-[#7494ec] text-sm rounded">css</span>
                            <span class="px-3 py-1 bg-[#7494ec] text-sm rounded">javascript</span>
                        </div>
                    </div>
                    <!-- Achievements Section -->
                    <div class="border border-[#7494ec] shadow-lg p-4 rounded-lg bg-white mt-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-[#7494ec] text-lg font-bold">Achievements</h2>
                            <a href="#" class="text-[#633F92] text-sm hover:underline">View All</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                            <div class="bg-[#7494ec] rounded p-4">
                              <div class="flex items-center">
                                <i class="fa-solid fa-medal text-4xl mr-2 text-[#FEE101]"></i>
                                <div>
                                  <h4 class="text-white text-lg font-bold">5</h4>
                                  <p class="text-white text-xs">Gold Achievements</p>
                                </div>
                               
                              </div>
                               
                            </div>
                            <div class="bg-[#633F92] rounded p-4">
                              <div class="flex items-center">
                                <i class="fa-solid fa-medal text-4xl mr-2 text-[#D7D7D7]"></i>
                                <div>
                                  <h4 class="text-white text-lg font-bold">5</h4>
                                  <p class="text-white text-xs">Silver Achievements</p>
                                </div>
                               
                              </div>
                            </div>
                            <div class="bg-[#7494ec] rounded p-4">
                              <div class="flex items-center">
                                <i class="fa-solid fa-medal text-4xl mr-2 text-[#824A02]"></i>
                                <div>
                                  <h4 class="text-white text-lg font-bold">5</h4>
                                  <p class="text-white text-xs">Bronze Achievements</p>
                                </div>
                               
                              </div>
                        </div>
                    </div>
                    <!-- Top Tags Section -->
                    <div class="border-2 border-[#7494ec] shadow-lg rounded-lg p-4 mt-6">
                      <h3 class="text-[#7494ec] text-xl font-bold">Top Tags</h3>
                      <ul class="mt-4 space-y-2">
                          <li class="flex justify-between">
                              <span>angular</span>
                              <span>1,850 score</span>
                          </li>
                          <li class="flex justify-between">
                              <span>javascript</span>
                              <span>631 score</span>
                          </li>
                          <li class="flex justify-between">
                              <span>typescript</span>
                              <span>483 score</span>
                          </li>
                          <li class="flex justify-between">
                              <span>css</span>
                              <span>467 score</span>
                          </li>
                      </ul>
                  </div>
                  
                    <!-- Top Posts Section -->
                    <h2 class="mt-6 mb-2 text-[#7494ec] text-xl font-bold">Top Posts</h2>
                    <div class="border border-[#7494ec] shadow-lg rounded-lg p-4">
                       
                        <!-- Post 1 -->
                        <div class="flex flex-col sm:flex-row items-start border-b border-[#7494ec] pb-4 mb-4">
                            <div class="flex-1 mt-4 sm:mt-0 sm:ml-4">
                                <a href="#" class="text-[#633F92] font-medium hover:underline">
                                    How does JVM Clojure store captured environments of closures under the hood?
                                </a>
                                <div class="flex mt-3 items-center">
                                    <button class="px-3 py-1 bg-[#7494ec] text-white rounded-lg hover:bg-[#7494ec] transition mr-3">
                                        Like
                                    </button>
                                    <span class="text-sm text-gray-400">12 Likes</span>
                                </div>
                            </div>
                        </div>
                        <!-- Post 2 -->
                        <div class="flex flex-col sm:flex-row items-start border-b border-[#7494ec] pb-4 mb-4">
                          <div class="flex-1 mt-4 sm:mt-0 sm:ml-4">
                              <a href="#" class="text-[#633F92] font-medium hover:underline">
                                  How does JVM Clojure store captured environments of closures under the hood?
                              </a>
                              <div class="flex mt-3 items-center">
                                  <button class="px-3 py-1 bg-[#7494ec] text-white rounded-lg hover:bg-[#7494ec] transition mr-3">
                                      Like
                                  </button>
                                  <span class="text-sm text-gray-400">12 Likes</span>
                              </div>
                          </div>
                      </div>
                       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
