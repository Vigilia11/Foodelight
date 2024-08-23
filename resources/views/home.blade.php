<x-app-layout>
    <div class="py-12 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="mb-5 ">
                <div class="">                  
                    <div>   
                        <span class="hidden">{{ $top4BestSellerNumber = 1 }}</span>
                        <div id="default-carousel" class="relative w-full" data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-96 overflow-hidden rounded-lg md:h-96 z-10">
                                @foreach($top4BestSellers as $bestSeller)
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                    <div class="absolute z-10 block h-96 w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                        <div class="w-full grid grid-cols-2">
                                            <div class="flex items-center justify-center h-96">
                                                <div class="">
                                                    <h1 class="text-black text-7xl font-extrabold text-center">{{ $bestSeller->dish }}</h1>   
                                                    <h1 class="text-2xl font-extrabold text-black font-sans text-center">BEST SELLER</h1>
                                                    <h1 class="text-black text-2xl font-extrabold text-center">#{{ $top4BestSellerNumber }}</h1>
                                                    <span class="hidden">{{ $top4BestSellerNumber++ }}</span>
                                                </div>
                                            </div>
                                            <div>
                                                <img src="{{ asset('images/dishes/'.$bestSeller->image) }}" alt="" class="w-full h-96">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                @endforeach
                                
                            </div>
                            
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mb-20 ">
                <span class="hidden">{{ $top10BestSellerNumber = 1 }}</span>
                <div class="grid grid-flow-row grid-cols-5 gap-1">
                    @foreach($top10BestSellers as $top10BestSeller)
                    <div class="h-48 relative">
                        <div class="absolute top-0 left-0 z-10 leading-3 p-1">
                            <h6 class="font-extrabold text-gray-800">#{{ $top10BestSellerNumber++ }} {{ $top10BestSeller->dish }}</h6>
                        </div>
                        <img src="{{ asset('images/dishes/'.$top10BestSeller->image) }}" alt="" class="w-full h-full">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-20">
                <div class="grid grid-cols-5 mb-2">
                    <div class="flex items-center col-span-3">
                        <div class="px-4">
                            <h1 class="text-7xl font-extrabold text-black tracking-wider">Most Requested</h1>
                            <h1 class="text-3xl text-gray-800 font-extrabold tracking-wider">Dishes & Drinks</h1>
                        </div>
                    </div>
                    <div class="h-80 bg-gray-200 col-span-2">
                        <div id="request-carousel" class="relative w-full" data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-80 overflow-hidden rounded-lg md:h-80">
                                @foreach($requests as $carouselrequest)
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                    <img src="{{ asset('images/dishes/'.$carouselrequest->image) }}" alt="" class="w-full h-80">                                    
                                </div>
                                @endforeach
                                
                            </div>
                            
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>
                                
                    </div>
                </div>
                <span class="hidden">{{ $RequestNumber = 1 }}</span>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($requests as $request)
                        <div class="h-56 bg-gray-200 relative">
                            <div class="absolute top-0 left-0 leading-3 p-1">
                                <h6 class="text-sm font-bold text-gray-800">#{{ $RequestNumber++ }} {{ $request->dish }}</h6>                                                   
                            </div>
                            <div class="absolute bottom-2 right-0">
                                <div class="py-2 px-3 min-w-28"  style="background-color:rgb(255,255,255,0.8);">
                                    <h6 class="text-sm font-bold text-gray-800 text-center">{{ $request->totalRequest }} requested</h6>
                                </div>
                                                             
                            </div>
                            <img src="{{ asset('images/dishes/'.$request->image) }}" alt="" class="w-full h-full">                                    
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-20">
                <div class="grid grid-cols-5 mb-2">
                    <div class="flex items-center col-span-3">
                        <div class="px-4">
                            <h1 class="text-7xl font-extrabold text-black tracking-wider">Top Favorites</h1>
                            <h1 class="text-3xl text-gray-800 font-extrabold tracking-wider">Dishes & Drinks</h1>
                        </div>
                    </div>
                    <div class="h-80 bg-gray-200 col-span-2">
                        <div id="favorite-carousel" class="relative w-full" data-carousel="slide">
                            <!-- Carousel wrapper -->
                            <div class="relative h-80 overflow-hidden rounded-lg md:h-80">
                                @foreach($favorites as $carouselfavorite)
                                <div class="hidden duration-1000 ease-in-out" data-carousel-item>
                                    <img src="{{ asset('images/dishes/'.$carouselfavorite->image) }}" alt="" class="w-full h-80">                                    
                                </div>
                                @endforeach
                                
                            </div>
                            
                            <!-- Slider controls -->
                            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                    </svg>
                                    <span class="sr-only">Previous</span>
                                </span>
                            </button>
                            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                    </svg>
                                    <span class="sr-only">Next</span>
                                </span>
                            </button>
                        </div>
                                
                    </div>
                </div>
                <span class="hidden">{{ $favoriteNumber = 1 }}</span>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($favorites as $favorite)
                        <div class="h-56 bg-gray-200 relative">
                            <div class="absolute top-0 left-0 leading-3 p-1">
                                <h6 class="text-sm font-bold text-black">#{{ $favoriteNumber++ }} {{ $favorite->dish }}</h6>                                                   
                            </div>
                            <div class="absolute bottom-2 right-0">
                                <div class="py-2 px-3 min-w-28"  style="background-color:rgb(255,255,255,0.8);">
                                    <h6 class="text-sm font-bold text-gray-800 text-center">{{ $favorite->totalFavorite }} users</h6>
                                </div>
                                                             
                            </div>
                            <img src="{{ asset('images/dishes/'.$favorite->image) }}" alt="" class="w-full h-full">                                    
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
