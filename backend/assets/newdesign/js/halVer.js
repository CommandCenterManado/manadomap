$(document).ready(function(){


	$(".hapus").on("click",function(){
		swal({
			title: "Konfirmasi",
			text: "Apakah anda yakin ingin menghapus item ini?",
			type: "warning",
			showCancelButton: true
		},function(){
			// TO:DO // redirect api hapus
		});
	});

	$(".tutup").on("click",function(){
		$("body").removeClass("popup-active");
	});

});