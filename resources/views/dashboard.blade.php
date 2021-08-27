<x-app-layout>
    
    <x-alert></x-alert>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg relative">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-center text-4xl uppercase">These are all your cats</h1>
                    @if ($cats->count() > 0)
                    <div class="text-center">
                        <a href="{{route('map')}}" class="w-100 fill-current inline-flex items-center px-12 py-2 m-1  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Show them on the map
                            <x-map2></x-map2>
                        </a>
                    </div>
                   
                    <div class="flex flex-wrap -mx-4">
                   
                        @foreach ($cats as $cat)
                        <!--Cards -->

                        <div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 p-4">
                            <div class=" block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
                                <div class="relative pb-48 overflow-hidden">
                                    <img class="absolute inset-0 h-full w-full object-cover"
                                        src="{{($cat->image) ? $cat->image->url : URL::asset('/img/cat.png') }}" alt="">
                                </div>
                                <div class="p-4">
                                    <h1 class="mt-2 mb-2  font-bold capitalize">{{$cat->name}}</h1>
                                    <p class="text-md mb-1 uppercase">{{$cat->breed->name}}</p>
                                    <p class="text-sm mb-1 capitalize">{{$cat->gender}}</p>
                                    <p class="italic text-sm normal-case">{{$cat->description}}</p>
                                    <div class="mt-3 flex items-center">
                                        <span class="text-sm font-semibold">
                                            <x-cake></x-cake>
                                        </span>&nbsp;<span class="font-bold text-xl">{{$cat->birthday}}</span>
                                    </div>
                                </div>

                                <div class="p-4 flex justify-center">
                                    <a href="{{route('locate', $cat->id)}}" title="Locate"
                                        class=" fill-current inline-flex items-center px-12 py-2 m-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <x-map></x-map>
                                    </a>
                                    <a href="{{route('edit', $cat->id)}}" title="Edit"
                                        class=" fill-current inline-flex items-center px-12 py-2 m-1  bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        <x-cog></x-cog>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center">
                        <h1>Oh... it's empty</h1>
                        <div class="mt-3 flex justify-center">
                            <x-cat></x-cat>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <x-add-button></x-add-button>
    </div>
</x-app-layout>
