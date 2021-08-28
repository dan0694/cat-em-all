@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
@endsection

<x-app-layout>
    <div class="bg-white shadow max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 m-5">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add a new cat!
        </h2>
        <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>
            <div class="mt-4">
                <x-label for="breed" :value="__('Breed')" />
                <select name="breed" id="breed"
                    class="appearance-none block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($breeds as $breed)
                    <option value="{{$breed->id}}">{{$breed->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <textarea id="description"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text" name="description" required autocomplete="new-description"></textarea>
            </div>
            <div class="mt-4">
                <x-label for="birthday" :value="__('Birthday')" />

                <x-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" required
                    autocomplete="new-birthday" />
            </div>

            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />
                <select name="gender" id="gender"
                    class="appearance-none block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="mt-4 flex items-center justify-center bg-grey-lighter">
                <label
                    class="w-64 flex flex-col items-center px-4 py-6 text-gray-800 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-gray-300 hover:text-white">
                    <x-upload></x-upload>
                    <span class="mt-2 text-base leading-normal">Select a pic of your cat</span>
                    <input onchange="updateLabel()" id="picture" type='file' name="file" class="hidden" />
                </label>
            </div>
            <div class="ml-4">
                <label id="fileLabel" class="ml-8 text-gray-500 text-sm"></label>
            </div>

            <div class="mt-4">
                <x-label for="map" class="mb-2" value="Click on the map where your cat is" />
                <div id="map" style="height: 240px; width:100%">
                </div>
                <input  id="location" type="hidden" name="location" :value="old('location')" required
                    class="block mt-1 w-1/2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ url()->previous() }}" title="Back"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <x-back></x-back>
                </a>
                <x-button class="ml-4 hover:text-green-400" title="Save">
                    <x-add></x-add>
                </x-button>
            </div>


        </form>
    </div>


</x-app-layout>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
    var mymap = L.map('map').setView([9.909434, -83.999661], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env("MAPBOX_ACCESS_TOKEN")}}'
    }).addTo(mymap);

    var popup = L.popup();
    function onMapClick(e) {
        var location = document.getElementById("location");
        location.value = e.latlng.toString();
        popup
            .setLatLng(e.latlng)
            .setContent("Your cat location is: " + e.latlng.toString())
            .openOn(mymap);
    }

    mymap.on('click', onMapClick);

    function updateLabel(){
        var name = document.getElementById('picture').files[0].name;
        document.getElementById('fileLabel').textContent = name;
    }

</script>
