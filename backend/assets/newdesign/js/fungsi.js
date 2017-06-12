function base_url(subdir) {
    return "http://localhost/laporan_revisi/" + subdir;
}

function init_map(el,center) {
    pusat = {lat: 1.5002396,lng: 124.8720195};
    if(center != undefined) {
        pusat.lat = center.lat;
        pusat.lng = center.lng;
    }
    map = new GMaps({
            el: el,
            lat: pusat.lat,
            lng: pusat.lng,
            zoom: 13,
            mapTypeControl: false,
            zoomControl: false
        });

    map.addMarker({
        lat: pusat.lat,
        lng: pusat.lng,
        draggable: true,
        dragend: function(location) {
            loc = location.latLng;
            lat = loc.lat();
            lng = loc.lng();
            $("#lat,.lat").val(lat);
            $("#lng,.lng").val(lng);
        }
    });

    $("#lat,.lat").val(pusat.lat);
    $("#lng,.lng").val(pusat.lng);

}

function config_popup(l) {
    $("#myModal").modal("show");
    $("#detil-proses,#detil-selesai").hide();
    $("#tindakan_wr").show();
    $("#buat").prop("disabled",false);

    for(var prop in l) {
        if(l.hasOwnProperty(prop)) {
            $("#table-info td#"+prop).html(l[prop]);
        }
    }
    $("#table-info #status").val(l["status"]);
    $("#table-info #idlaporan_masyarakat").val(l["idlaporan_masyarakat"]);

    if(l["status"] == "proses") {
        $("#detil-selesai").hide();
        $("#detil-proses").show();
        $("#table-info #status").html("" +
            "<option value='selesai'>Selesai</option>");
        $("#file_respon_proses_wr img").prop("src",base_url("assets/uploads/respon/"+l["file_respon_proses"]));
    } else if(l["status"] == "selesai") {
        $("#detil-selesai,#detil-proses").show();
        $("#table-info #status").html("" +
            "<option value='selesai'></option>");
        $("#file_respon_proses_wr img").prop("src",base_url("assets/uploads/respon/"+l["file_respon_proses"]));
        $("#file_respon_selesai_wr img").prop("src",base_url("assets/uploads/respon/"+l["file_respon_selesai"]));
        $("#tindakan_wr").hide();
        $("#buat").prop("disabled",true);
    } else {
        $("#table-info #status").html("" +
            "<option value='proses'>Dalam Proses</option>" +
            "<option value='selesai'>Selesai</option>");
    }
    $("#statusText").html(l["status"]);

}


function buat_card(l) {
    var card_baru="";
    card_baru += "<div class=\"col-lg-4\">";
    card_baru += "						<div class=\"card new\">";
    card_baru += "							<div class=\"card-image-wrapper\">";
    card_baru += "								<div class=\"card-image\">";
    card_baru += "									<img src=\"" + base_url("assets/uploads/laporan/")+l.file_attach + "\"/>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "							<div class=\"card-info-wrapper\">";
    card_baru += "								<div class=\"card-info\">";
    card_baru += "									<h4><a href=\"#\">" + l.nomor_laporan + "<\/a><\/h4>";
    card_baru += "									<ul class=\"list-group\">";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "											<i class=\"glyphicon glyphicon-map-marker\"><\/i>";
    card_baru += "											" + l.nama_kecamatan + " - " + l.nama_kelurahan;
    card_baru += "										<\/li>";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "											<i class=\"glyphicon glyphicon-time\"><\/i>";
    card_baru += "											Beberapa detik lalu";
    card_baru += "										<\/li>";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "                                            <i class='" + l.icon + "'></i>";
    card_baru += "										<\/li>";
    card_baru += "									<\/ul>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "							<div class=\"card-action-wrapper\">";
    card_baru += "								<div class=\"card-action\">";
    card_baru += "                                    <button class=\"btn btn-default card-action-button tangani\" data-l='" + JSON.stringify(l) + "'>Tangani<\/button>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "						<\/div>";
    card_baru += "					<\/div>";

    return card_baru;
}

function buat_card_verif(l) {
    var card_baru="";
    card_baru += "<div class=\"col-lg-4\">";
    card_baru += "						<div class=\"card new\">";
    card_baru += "							<div class=\"card-image-wrapper\">";
    card_baru += "								<div class=\"card-image\">";
    card_baru += "									<img src=\""+ base_url("assets/uploads/laporan/") + l.file_attach +"\"\/>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "							<div class=\"card-info-wrapper\">";
    card_baru += "								<div class=\"card-info\">";
    card_baru += "									<h4>" + l.nomor_laporan + "<\/h4>";
    card_baru += "									<ul class=\"list-group\">";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "											<i class=\"glyphicon glyphicon-map-marker\"><\/i>";
    card_baru += "                                            " + l.nama_kecamatan + " - " + l.nama_kelurahan;
    card_baru += "										<\/li>";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "											<i class=\"glyphicon glyphicon-time\"><\/i>";
    card_baru += "                                            Beberapa detik lalu";
    card_baru += "										<\/li>";
    card_baru += "										<li class=\"list-group-item\">";
    card_baru += "                                            <i class=\"" + l.icon + "\"><\/i>";
    card_baru += "										<\/li>";
    card_baru += "									<\/ul>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "							<div class=\"card-action-wrapper\">";
    card_baru += "								<div class=\"card-action\">";
    card_baru += "									<div class=\"btn-group btn-group-justified\">";
    card_baru += "										<div class=\"btn-group\">";
    card_baru += "											<button class=\"btn btn-default btn-lg approve\" data-l='" + JSON.stringify(l) + "'>Approve<\/button>";
    card_baru += "										<\/div>";
    card_baru += "										<div class=\"btn-group\">";
    card_baru += "											<button class=\"btn btn-default btn-lg hapus\">Hapus<\/button>";
    card_baru += "										<\/div>";
    card_baru += "									<\/div>";
    card_baru += "								<\/div>";
    card_baru += "							<\/div>";
    card_baru += "						<\/div>";
    card_baru += "					<\/div>";

    return card_baru;
}

function logout() {

    swal({
        title: "Konfirmasi",
        type: "info",
        text: "Apakah anda yakin ingin keluar dari sistem?",
        showCancelButton: true
    },function(){
        $.get(base_url("index.php/dashboard/api_logout"),function(response){
            window.location.href = base_url("index.php/login");
        })
    });

}

function buat_notif(msg,type,autohide) {
    var cls = (type) ? "btn-success" : "btn-danger";
    $("#notif").html("");
    $("#notif").append(
        "<div class='notif-box " + cls + "'>" +
        "   <b><i class='glyphicon glyphicon-bell'></i>&nbsp;"+msg+"</b>" +
        "</div>"
    );
    if(autohide){
        setTimeout(function(){ $(".notif-box").fadeOut(); },3000);
    }
}

function ping(url,timeout,succ,err) {


    $.Ping(url,timeout).done(function (success, url, time, on) {
        succ(arguments);
    }).fail(function (failure, url, time, on) {
        err(arguments);
    });

}