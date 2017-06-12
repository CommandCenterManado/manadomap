$(document).ready(function(){

	$("#dashboard-map #nav-main-button").on("click",function(){
		$("#nav-main-wrap").toggleClass("nav-main-container-active");
	});

	$("#dashboard-map #filter-button").on("click",function(){
		$("#filter-wrap").toggleClass("nav-main-container-active");
	});

})