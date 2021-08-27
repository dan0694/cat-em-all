@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
@endsection

<x-app-layout>
    <div class="p-10">
        <div class="w-full p-4">
            <div class=" block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
                <div class="relative pb-48 overflow-hidden">
                    <img class="absolute inset-0 h-full w-full object-cover"
                        src="{{($cat->image) ? $cat->image->url : URL::asset('/img/cat.png') }}" alt="">
                </div>
                <div class="p-4">
                    <h1 class="mt-2 mb-2  font-bold capitalize">{{$cat->name}}</h1>
                    <p class="italic mb-1 text-sm normal-case">{{$cat->description}}</p>
                    <p class="text-md mb-1 upercase">{{$cat->breed->name}}</p>
                    <p class="italic mb-2 text-sm normal-case">{{$cat->breed->description}}</p>
                    <div class="mt-3 flex items-center">
                        <span class="text-sm font-semibold">
                            <x-cake></x-cake>
                        </span>&nbsp;<span class="font-bold text-xl">{{$cat->birthday}}</span>
                    </div>
                </div>
                <div id="map" style="height: 320px; width:90%; margin-left:5%">
                </div>

                <div class="p-4 flex justify-center">
                    <a href="{{ url()->previous() }}" title="Back"
                        class=" fill-current inline-flex items-center px-12 py-2 m-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        <x-back></x-back>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
    var mymap = L.map('map').setView([{{$cat->location}}], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env("MAPBOX_ACCESS_TOKEN")}}'
    }).addTo(mymap);

    var cat = @JSON($cat);
    if (cat.location) {
            locationArr = cat.location.split(',');
            var marker = L.marker([parseFloat(locationArr[0]), parseFloat(locationArr[1])]).addTo(mymap);
            marker.bindPopup("<b>"+cat.name+"</b><br>"+cat.breed.name+"<img src='"+cat.image.url+"'>").openPopup();
            var popup = L.popup();
        }
</script>
