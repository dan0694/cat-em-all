@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<style>
    .modal {
        transition: opacity 0.25s ease;
    }

    body.modal-active {
        overflow-x: hidden;
        overflow-y: visible !important;
    }

</style>
@endsection
<x-app-layout>
    <div class="bg-white shadow max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 m-5">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit your cat details
        </h2>
        <form method="POST" id="edit" action="{{ route('update', $cat->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <x-label for="name" :value="__('Name')" />

                <input id="name" type="text" name="name" value="{{$cat->name}}" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="mt-4">
                <select name="breed" id="breed"
                    class="appearance-none block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($breeds as $breed)
                    <option value="{{$breed->id}}" @if($breed->id === $cat->breed->id) selected @endif>{{$breed->name}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-label for="description" :value="__('Description')" />

                <textarea id="description" type="text" name="description" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{$cat->description}}
                </textarea>
            </div>
            <div class="mt-4">
                <x-label for="birthday" :value="__('Birthday')" />

                <input id="birthday" type="date" name="birthday" value="{{$cat->birthday}}" required
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            </div>

            <div class="mt-4">
                <x-label for="gender" :value="__('Gender')" />
                <select name="gender" id="gender"
                    class="appearance-none block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="male" @if($cat->gender === "male") selected @endif>Male
                    </option>
                    <option value="female" @if($cat->gender === "female") selected @endif>Female
                    </option>
                </select>
            </div>

            <div class="mt-4 flex items-center justify-center bg-grey-lighter">
                <label
                    class="w-64 flex flex-col items-center px-4 py-6 text-gray-800 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-gray-300 hover:text-white">
                    <x-upload></x-upload>
                    <span class="mt-2 text-base leading-normal">Update your cat's photo</span>
                    <input onchange="updateLabel()" id="picture" type='file' name="file" class="hidden" />
                </label>
            </div>
            <div class="ml-4">
                <label id="fileLabel" class="ml-8 text-gray-500 text-sm">{{$cat->image->title}}</label>
            </div>
           
            <div class="mt-4">
                <x-label for="map" class="mb-2" value="Click on the map where your cat is" />
                <div id="map" style="height: 240px; width:100%">
                </div>
                <input id="location" type="hidden" name="location" :value="{{$cat->location}}" required
                    class="block mt-1 w-1/2 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ url()->previous() }}" title="Back"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <x-back></x-back>
                </a>
                <x-button class="ml-4 hover:text-green-400" title="Save" form="edit">
                    <x-add></x-add>
                </x-button>
                <button title="Delete" type="button"
                    class="ml-4 modal-open inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-200 disabled:opacity-25 transition ease-in-out duration-150">
                    <x-delete></x-delete>
                </button>
            </div>

        </form>


        <form method="POST" id="delete" action="{{ route('destroy', $cat->id) }}">
            @csrf
            @method('DELETE')
            <div
                class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center" style="z-index: 9999">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                <div
                    class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                    <div
                        class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>

                    <div class="modal-content py-4 text-left px-6">
                        <div class="flex justify-between items-center pb-3">

                            <p class="text-2xl font-bold">Delete this Cat</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex justify left">
                            <span
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </span>
                            <p class="ml-2">Are you sure you want to delete this cat? <span class="italic">(This action
                                    is irreversible)</span></p>
                        </div>

                        <div class="flex justify-end pt-2">
                            <a
                                class="modal-close px-4 bg-transparent p-3 rounded-lg text-dark-500 hover:bg-gray-100 hover:text-dark-400 mr-2">Back</a>
                            <button type="submit"
                                class="px-4 bg-red-500 p-3 rounded-lg text-white hover:bg-red-400">Delete</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>



    </div>


</x-app-layout>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
<script>
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
        openmodal[i].addEventListener('click', function (event) {
            event.preventDefault()
            toggleModal()
        })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
        closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function (evt) {
        evt = evt || window.event
        var isEscape = false
        if ("key" in evt) {
            isEscape = (evt.key === "Escape" || evt.key === "Esc")
        } else {
            isEscape = (evt.keyCode === 27)
        }
        if (isEscape && document.body.classList.contains('modal-active')) {
            toggleModal()
        }
    };


    function toggleModal() {
        const modal = document.querySelector('.modal')
        modal.classList.toggle('opacity-0')
        modal.classList.toggle('pointer-events-none')
    }

    var mymap = L.map('map').setView([{{$cat->location}}], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{env("MAPBOX_ACCESS_TOKEN")}}'
    }).addTo(mymap);

    var marker = L.marker([{{$cat->location}}]).addTo(mymap);
    marker.bindPopup("<b>{{$cat->name}}</b><br>{{$cat->breed->name}}").openPopup();
    
    var newLocation = L.popup();
    function onMapClick(e) {
        var location = document.getElementById("location");
        location.value = e.latlng.toString();
        newLocation
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

