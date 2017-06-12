$(document).ready(function(){

    window.audio = new Audio(base_url("assets/newdesign/audio/alert.mp3"));
    window.audio.loop = true;

    window.audio_kebersihan = new Audio(base_url("assets/newdesign/audio/alert_kebersihan.mp3"));
    window.audio_kebersihan.loop = true;

    try {

        siapkan_live_notif();
        track_nodejs_server();

    } catch(e) {
        buat_notif("Node.js server tidak jalan. Live notification terhenti");
        track_nodejs_server();
        window.socket = null;
    }


});

function siapkan_live_notif() {
    window.socket = io.connect("http://localhost:7001");

    window.socket.on("laporanfixed",function(data){

        $.get(base_url("index.php/dashboard/api_ambil_satu_laporan/"+data.idlaporan_masyarakat),function(laporan){

            $.get(base_url("index.php/dashboard/api_ambil_pengguna"),function(user){

                console.log(user);
                console.log(laporan);


                if(user.bagian != "walikota" && user.bagian != "root" && user.bagian != "ccenter") {

                    if(user.idkategori_laporan == laporan.idkategori_laporan || user.idkecamatan == laporan.idkecamatan || user.idkelurahan == laporan.idkelurahan) {
                        if(laporan.idkategori_laporan == 1) {
                            window.audio_kebersihan.play();
                        } else {
                            window.audio.play();
                        }
                        var card = buat_card(laporan);
                        $("#laporan_card_wrap").prepend(card);
                    }

                } else {
                    if(laporan.idkategori_laporan == 1) {
                        window.audio_kebersihan.play();
                    } else {
                        window.audio.play();
                    }
                    var card = buat_card(laporan);
                    $("#laporan_card_wrap").prepend(card);

                }

            });

        });

    });

    window.socket.on("laporanpublik",function(data){

        $.get(base_url("index.php/dashboard/api_ambil_satu_laporan/"+data.idlaporan_masyarakat),function(laporan){

            $.get(base_url("index.php/dashboard/api_ambil_pengguna"),function(user){

                if(user.bagian == "ccenter" || user.bagian == "root" || user.bagian == "walikota") {

                    if(laporan.idkategori_laporan == 1) {
                        window.audio_kebersihan.play();
                    } else {
                        window.audio.play();
                    }


                    var card = buat_card_verif(laporan);
                    $("#laporan_verif_card").prepend(card);
                }

            });
        });


    });
}

function track_nodejs_server() {
    setInterval(function(){
        ping("http://localhost:7001/?id=" + makeid() + "&",1000,function(res){
            buat_notif("Live notifikasi aktif!",true);
            console.log("Succ : ",res);
        },function(err){
            buat_notif("Live notifikasi terputus! Mencoba terhubung..",false);
            console.warn("Err : ",err);
        });
    },1000);
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 60; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

$.extend($, {
    Ping: function Ping(url, timeout) {
        timeout = timeout || 1500;
        var timer = null;

        return $.Deferred(function deferred(defer) {

            var img = new Image();
            img.onload = function () { success("onload"); };
            img.onerror = function () { success("onerror"); };

            var start = new Date();
            img.src = url += ("?cache=" + +start);
            timer = window.setTimeout(function timer() { fail(); }, timeout);

            function cleanup() {
                window.clearTimeout(timer);
                timer = img = null;
            }

            function success(on) {
                cleanup();
                defer.resolve(true, url, new Date() - start, on);
            }

            function fail() {
                cleanup();
                defer.reject(false, url, new Date() - start, "timeout");
            }

        }).promise();
    }
});