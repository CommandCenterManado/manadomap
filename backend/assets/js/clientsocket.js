var socket = io.connect("http://localhost:7001");
const audio = new Audio(base_url("assets/audio/alert.mp3"));
audio.loop = true;
var count = 0;


socket.on("laporanbaru",function(data){

    $.get(base_url("index.php/dashboard/ambil_satu_laporan/"+data.idlaporan_masyarakat),function(response){

        console.log(response);

        laporan = response.laporan;
        user = response.user;

        if(user.bagian != "root") {
            if(user.idkategori_laporan == laporan.idkategori_laporan || user.idkecamatan == laporan.idkecamatan || user.idkelurahan == laporan.idkelurahan) {
                notify();
            }
        } else {
            notify();
        }


    });


});


function notify(){
    count++;
    $("#counter").html(count);
    $("#notif").addClass("red");
    audio.play();
}

$(document).ready(function(){
    $("#notif").on("click",function(){
        window.location.reload();
    })
})