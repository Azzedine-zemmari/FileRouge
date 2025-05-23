<x-app>
    @if(session('success'))
    <div id="alert" class="mb-4 p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div id="alert" class="mb-4 p-4 text-red-800 bg-red-100 border border-red-300 rounded-lg">
        {{ session('error') }}
    </div>
    @endif
    <!-- filter -->
    <section class="mt-10 relative">
        <div class="flex justify-center items-center">
            <a href="{{route('events')}}" class=" font-Kadwa text-4xl font-bold text-center">All Events</a>
        </div>
        <!-- all events -->
        <div class="flex items-center justify-center space-x-4 overflow-x-auto whitespace-nowrap">
            @if(isset($categories))
            @foreach($categories as $categorie)
            <a href="{{route('event.filtrage',['category'=>$categorie->nom])}}">{{$categorie->nom}}</a>
            @endforeach
            @endif
        </div>
    </section>
    <div class="max-w-6xl mx-auto my-3">
        <form action="{{route('event.search')}}" method="POST" class=" flex justify-end">
            @csrf
            <div class="relative">
                <input type="text" placeholder="search" name="name" class=" py-2 px-4 rounded-full bg-[#E7D8C9] text-[#1E1812] bg-opacity-30 opacity-70">
                <img src="{{asset('/images/icons/searchsvg.svg')}}" class="absolute top-3 right-3 w-4 h-4" alt="">
            </div>
        </form>
    </div>
<!-- all events -->
<section class="max-w-6xl mx-auto mt-10">
    @if(count($data) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($data as $event)
            <div class="bg-white shadow-md rounded-lg">
                <img src="{{ asset($event->image) }}" class="w-full h-64 object-cover" alt="">
                <div class="p-4">
                    <a href="{{ $event->deleted_at === null ? route('eventDetails', $event->ID) : '' }}" class="text-sm font-semibold md:text-lg">{{ $event->nom }}</a>
                    <p class="text-xs md:text-sm mb-4">{{ $event->description }}</p>
                    @if($event->deleted_at !== null)
                        <p class="text-sm text-red-600">Deleted by organizer</p>
                    @elseif(Auth::check() && Auth::user()->role_id === 4)
                            @if(!$eventPurchaseService->checkBuy($event->ID))
                                <div class="flex justify-end">
                                    <form action="{{ route('processTransaction', $event->ID) }}" method="POST">
                                    @csrf
                                    <button class="bg-[#E7826B] hover:text-[#d6715b] text-white text-sm px-3 py-2">Buy</button>
                                    </form>
                                </div>
                            @else
                            <p class="text-sm text-green-600">Already Purchased</p>
                            @endif
                    @else
                        <p class="text-sm text-gray-600">
                            <a href="{{ route('login') }}" class="text-[#d6715b] hover:underline">Login</a> to buy
                        </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg p-10 text-center">
            <div class="flex flex-col items-center justify-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-2xl font-semibold text-gray-700 mb-2">No Events Found</h3>
                <p class="text-gray-500 mb-6">There are currently no events available to display.</p>
            </div>
        </div>
    @endif
    <div class="flex justify-end my-2">
        {{$data->links()}}
    </div>
</section>
    <script>
        const alert = document.getElementById('alert');
        if (alert) {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }
    </script>
</x-app>