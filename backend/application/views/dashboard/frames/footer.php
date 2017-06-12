</div>
<footer>

</footer>
<script>
    $(document).ready(function(){
        $("#jenis_laporan").on("change",function(){
            hal = $(this).val();
            window.location.href = base_url("index.php/dashboard/form/"+hal);
        });
        $("[data-toggle='tooltip']").tooltip();
    });
</script>
</body>
</html>