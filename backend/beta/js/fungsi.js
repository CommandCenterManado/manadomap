function init_map(el) {

    map = new GMaps({
            el: el,
            lat: 1.5002396,
            lng: 124.8720195,
            zoom: 13,
            mapTypeControl: false,
            zoomControl: false
        });

        map.addMarker({
            lat: 1.5002396,
            lng: 124.8720195,
            draggable: true,
            dragend: function(location) {
                loc = location.latLng;
                lat = loc.lat();
                lng = loc.lng();
                $("#lat").val(lat);
                $("#lng").val(lng);
            }
        });

}