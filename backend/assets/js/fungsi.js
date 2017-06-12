function base_url(subdir) {
    return "http://localhost/laporan_revisi/" + subdir;
}

function update_map(lat,lng) {

    lat = (lat == 0 || lat == undefined) ? 1.493416 : lat;
    lng = (lng == 0 || lng == undefined) ? 124.891966 : lng;

    $("#latlngpicker").locationpicker({
        location: {
            latitude: lat,
            longitude: lng
        },
        locationName: "",
        radius: 500,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: [],
        mapOptions: {},
        scrollwheel: true,
        inputBinding: {
            latitudeInput: null,
            longitudeInput: null,
            radiusInput: null,
            locationNameInput: null
        },
        enableAutocomplete: false,
        enableAutocompleteBlur: true,
        autocompleteOptions: null,
        addressFormat: 'postal_code',
        enableReverseGeocode: true,
        draggable: true,
        onchanged: function(currentLocation, radius, isMarkerDropped) {
            console.log(currentLocation);
            $("#latitude").val(currentLocation.latitude);
            $("#longitude").val(currentLocation.longitude);
        },
        onlocationnotfound: function(locationName) {},
        oninitialized: function (component) {},
        markerIcon: undefined,
        markerDraggable: true,
        markerVisible : true
    });


    $("#latitude").val(lat);
    $("#longitude").val(lng);
}
