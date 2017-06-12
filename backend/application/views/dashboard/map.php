

<article>

    <div class="col-md-12">
        <div class="carding">
            <div id="map" style="width: 100%;height: 500px;">

            </div>
        </div>
    </div>

</article>
<script>
    $(document).ready(function(){
        map = new GMaps({
            el: "#map",
            lat: 1.5002396,
            lng: 124.8720195,
            zoom: 13
        });

        $.get(base_url("index.php/dashboard/api_ambil_laporan"),function(response){
            console.log(response);
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
                        window.location.href = base_url("index.php/dashboard/urus/"+item.idlaporan_masyarakat);
                    }
                });
            });
        });

    });
</script>