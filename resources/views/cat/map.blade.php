@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
@endsection

<x-app-layout>
    <div class="w-full p-4">
        <div class=" block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
            <h2 class="text-center mt-4 font-semibold text-xl text-gray-800 leading-tight">Track your cats!</h2>
            <div id="map" style="height: 420px; width:96%; margin-left:2%; margin-top:4%">
            </div>
            <div class="p-4 flex justify-center">
                <a href="{{ url()->previous() }}" title="Back"
                    class=" fill-current inline-flex items-center px-12 py-2 m-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <x-back></x-back>
                </a>
            </div>
        </div>
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

    var cats = @JSON($cats);
    cats.forEach(cat => {
        if (cat.location) {
            locationArr = cat.location.split(',');
            var marker = L.marker([parseFloat(locationArr[0]), parseFloat(locationArr[1])]).addTo(mymap);
            var url = cat.image ? cat.image.url : "/img/cat.png"
            marker.bindPopup("<b>"+cat.name+"</b><br>"+cat.breed.name+"<img src='"+url+"'>").openPopup();
            var popup = L.popup();
        }
    });

</script>
