$(document).ready(function(){

    var onTraffic = false;

    $.get(base_url("index.php/dashboard/api_ambil_laporan"),function(response){
        ltlng = [];
        $.each(response,function(index,item){
            if(item.status == "dilapor") {
                marker = base_url("assets/img/red.png");
            } else if(item.status == "proses") {
                marker = base_url("assets/img/yellow.png");
            } else {
                marker = base_url("assets/img/blue.png");
            }
            map.addMarker({
                lat: item.latitude,
                lng: item.longitude,
                icon: marker,
                click: function(e){
                    config_popup(item);
                }
            });
            ltlng.push(new google.maps.LatLng(item.latitude,item.longitude));
        });
//            map.fitLatLngBounds(ltlng);
    });

    $("#idkecamatan").on("change",function(){

        if($(this).val() !== "") {

            $.get(base_url("index.php/dashboard/api_ambil_kelurahan/" + $(this).val()),function(response){
                if(response.status == "ok") {
                    kelurahan = $("#idkelurahan");
                    kelurahan.html("");
                    kelurahan.append("<option value='all'>Semua Kelurahan</option>");
                    response.data.forEach(function(item){
                        kelurahan.append("<option value='"+item.idkelurahan+"'>"+item.nama_kelurahan+"</option>");
                    });
                }
            })

        }

    });

    $("#filter_form input,#filter_form select").on("change",function(){
        var queryString = $("#filter_form").serialize();

        $.get(base_url("index.php/dashboard/api_ambil_laporan/filter/?"+queryString),function(response){
            map.removeMarkers();
            ltlng = [];
            $.each(response,function(index,item){
                if(item.status == "dilapor") {
                    marker = base_url("assets/img/red.png");
                } else if(item.status == "proses") {
                    marker = base_url("assets/img/yellow.png");
                } else {
                    marker = base_url("assets/img/blue.png");
                }
                map.addMarker({
                    lat: item.latitude,
                    lng: item.longitude,
                    icon: marker,
                    click: function(e){
                        //window.location.href = base_url("index.php/dashboard/urus/"+item.idlaporan_masyarakat);
                        config_popup(item);
                    }
                });
                ltlng.push(new google.maps.LatLng(item.latitude,item.longitude));
            });
//                map.fitLatLngBounds(ltlng);
        });

    });

    $(document).keypress("q",function(e){
        if(e.ctrlKey) {
            if(!onTraffic){
                buat_notif("Tampilan traffic aktif!",true);
                map.addLayer("traffic");
                onTraffic = true;
            } else {
                buat_notif("Tampilan traffic nonaktif!",true);
                map.removeLayer("traffic");
                onTraffic = false;
            }
            setTimeout(function(){ $(".notif-box").fadeOut(300); },3000);
        }
    });


    map = new GMaps({
        el: "#map",
        lat: 1.5002396,
        lng: 124.8720195,
        zoom: 13,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.VERTICAL_BAR,
            position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        zoomControl: false
    });

	$("#dashboard-map #nav-main-button").on("click",function(){
		$("#nav-main-wrap").toggleClass("nav-main-container-active");
	});

	$("#dashboard-map #filter-button").on("click",function(){
		$("#filter-wrap").toggleClass("nav-main-container-active");
	});

    var retro = [{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"stylers":[{"saturation":-17},{"gamma":0.36}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}];

    var dark = [{"featureType":"all","elementType":"geometry","stylers":[{"saturation":"0"},{"lightness":"0"},{"visibility":"on"},{"gamma":"1"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#e0e9f2"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"off"},{"color":"#000000"},{"lightness":"0"}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text","stylers":[{"visibility":"simplified"},{"saturation":"-100"},{"lightness":"-43"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#5a5858"},{"lightness":"0"},{"visibility":"on"},{"weight":"1.00"},{"gamma":"1"},{"saturation":"-54"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#6a6969"},{"lightness":"0"}]},{"featureType":"poi.attraction","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.attraction","elementType":"geometry.fill","stylers":[{"visibility":"off"}]},{"featureType":"poi.attraction","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"geometry.fill","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#698577"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"invert_lightness":true}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"},{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"lightness":"0"},{"color":"#474747"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":"0"},{"weight":0.2},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"invert_lightness":true}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"},{"saturation":"-100"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.fill","stylers":[{"color":"#a1a1a1"},{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"lightness":"0"},{"visibility":"on"},{"color":"#474747"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#454545"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"saturation":"-80"},{"lightness":"42"},{"color":"#989898"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"saturation":"-100"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#474747"},{"lightness":"0"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"lightness":"8"},{"color":"#909090"}]},{"featureType":"road.local","elementType":"labels.icon","stylers":[{"saturation":"-100"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#6d6d6d"},{"lightness":"0"},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#616e74"},{"lightness":"0"}]}];

    map.addStyle({
        styleMapName: "Unsaturated Brown",
        styles: retro,
        mapTypeId: "retro"
    });
    map.addStyle({
        styleMapName: "Dark",
        styles: dark,
        mapTypeId: "dark"
    });

    var jam = new Date().getHours();

    if(jam > 18) {
        map.setStyle("dark");
    } else {
        map.setStyle("retro");
    }


});