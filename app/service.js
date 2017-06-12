(function () {      //  Base Service
	'use strict';

	angular
		.module('manado.map')
		.service('baseService', baseService);

	baseService.inject = ['$rootScope', '$window', '$http'];
	function baseService($rootScope, $window, $http) {
		var vm = this;
		vm.baseURL = $window.location.origin + $window.location.pathname;
		vm.baseAPI = vm.baseURL + 'backend/index.php/api';
		vm.user = {
			login: userLogin
		}
		////////////////

		function userLogin() {
			return $http.post(vm.baseAPI + '/login', { 'username': 'walikota', 'password': 'walikota' });
		}
	}
})();

(function () {      //  get Data
	'use strict';

	angular
		.module('manado.map')
		.factory('getData', getData);

	getData.inject = ['$http', 'baseService'];
	function getData($http, baseService) {
		var service = {
			kecamatan: kecamatan,
			kecamatanById: kecamatanById,
			kelurahan: kelurahan,
			kelurahanById: kelurahanById
		};

		return service;

		////////////////
		function kecamatan() {
			return $http.get(baseService.baseAPI + '/ambil_kecamatan')
				.then(getSuccess)
				.catch(getError('Tidak bisa mengambil data Kecamatan'))
		}
		function kecamatanById(idkecamatan) {
			return $http.get(baseService.baseAPI + '/ambil_kecamatan_by_id/' + idkecamatan)
				.then(getSuccess)
				.catch(getError('Tidak bisa mengambil data Kecamatan'))
		}
		function kelurahan(idkecamatan) {
			return $http.get(baseService.baseAPI + '/ambil_kelurahan/' + idkecamatan)
				.then(getSuccess)
				.catch(getError('Tidak bisa mengambil data Kelurahan'))
		}
		function kelurahanById(idkecamatan) {
			return $http.get(baseService.baseAPI + '/ambil_kelurahan_by_id/' + idkecamatan)
				.then(getSuccess)
				.catch(getError('Tidak bisa mengambil data Kelurahan'))
		}

		//  Handler
		function getSuccess(respon) {
			return respon.data;
		}
		function getError(error) {
			return { success: false, msg: error };
		}
	}
})();

(function () {      //  kml Instance
	'use strict';

	angular
		.module('manado.map')
		.factory('kmlService', kmlService);

	kmlService.inject = ['NgMap', 'ngGeoxml', '$rootScope', 'baseService'];
	function kmlService(NgMap, ngGeoxml, $rootScope, baseService) {
		var service = {
			instance: [],
			setKml: setKml
		};

		$rootScope.$on('mapInitialized', function (e, map) {
			if (map) {
				map.setOptions({
					streetViewControl: false,
					zoomControl: true,
					zoomControlOptions: {
						position: google.maps.ControlPosition.TOP_LEFT
					},
					mapTypeControl: true,
					mapTypeControlOptions: {
						position: google.maps.ControlPosition.TOP_CENTER
					},
					styles: [
						{
							"elementType": "labels",
							"stylers": [
								{ "visibility": "off" },
								{ "color": "#f49f53" }
							]
						},
						{
							"featureType": "landscape",
							"stylers": [
								{ "color": "#f9ddc5" },
								{ "lightness": -7 }
							]
						},
						{
							"featureType": "road",
							"stylers": [
								{ "color": "#813033" },
								{ "lightness": 43 }
							]
						},
						{
							"featureType": "poi.business",
							"stylers": [
								{ "color": "#645c20" },
								{ "lightness": 38 }
							]
						},
						{
							"featureType": "water",
							"stylers": [
								{ "color": "#1994bf" },
								{ "saturation": -69 },
								{ "gamma": 0.99 },
								{ "lightness": 43 }
							]
						},
						{
							"featureType": "road.local",
							"elementType": "geometry.fill",
							"stylers": [
								{ "color": "#f19f53" },
								{ "weight": 1.3 },
								{ "visibility": "on" },
								{ "lightness": 16 }
							]
						},
						{ "featureType": "poi.business" },
						{
							"featureType": "poi.park",
							"stylers": [
								{ "color": "#645c20" },
								{ "lightness": 39 }
							]
						},
						{
							"featureType": "poi.school",
							"stylers": [
								{ "color": "#a95521" },
								{ "lightness": 35 }
							]
						},
						{},
						{
							"featureType": "poi.medical",
							"elementType": "geometry.fill",
							"stylers": [
								{ "color": "#813033" },
								{ "lightness": 38 },
								{ "visibility": "off" }
							]
						},
						{}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {},
						{ "elementType": "labels" },
						{
							"featureType": "poi.sports_complex",
							"stylers": [
								{ "color": "#9e5916" },
								{ "lightness": 32 }
							]
						},
						{},
						{
							"featureType": "poi.government",
							"stylers": [
								{ "color": "#9e5916" },
								{ "lightness": 46 }
							]
						},
						{
							"featureType": "transit.station",
							"stylers": [
								{ "visibility": "off" }
							]
						},
						{
							"featureType": "transit.line",
							"stylers": [
								{ "color": "#813033" },
								{ "lightness": 22 }
							]
						},
						{
							"featureType": "transit",
							"stylers": [
								{ "lightness": 38 }
							]
						},
						{
							"featureType": "road.local",
							"elementType": "geometry.stroke",
							"stylers": [
								{ "color": "#f19f53" },
								{ "lightness": -10 }
							]
						},
						{}, {}, {}
					]
				})
				if (service.instance.length == 0) {
					var parser = new ngGeoxml.parser({
						map: map,
						processStyles: true,
						singleInfoWindow: true,
						suppressInfoWindows: false,
						afterParse: function (doc) {
							console.log(doc);
							angular.forEach(doc[0].placemarks, function (v) {
								var min = 0;
								var max = 2;
								var rand = Math.floor(Math.random() * (max - min + 1)) + min;
								var color = ['#d63d32','#eb8853','#2282e6'];
								v.polygon.fillColor = color[rand];
								v.polygon.fillOpacity = '0.25';
								v.polygon.strokeColor = 'white';
								v.polygon.strokeWeight = '1';
								v.polygon.strokeOpacity = '1';
							})
						}
					})
					service.instance.push(parser);
				}
			}
		})

		return service;

		function setKml(kml) {
			var kmlUrl = baseService.baseURL + 'geokml/' + kml;
			if (service.instance.length != 0) {
				angular.forEach(service.instance[0].docs, function (v) {
					service.instance[0].hideDocument(v);
				})
				if (!service.instance[0].docsByUrl[kmlUrl]) {
					service.instance[0].parse(kmlUrl);
				} else {
					var doc = service.instance[0].docsByUrl[kmlUrl];
					service.instance[0].showDocument(doc);
					NgMap.getMap()
						.then(function (map) {
							map.fitBounds(doc.bounds);
						})
				}
			}
		}
	}
})();

(function () {
	'use strict';

	angular
		.module('manado.map')
		.factory('ngGeoxml', ngGeoxml);

	ngGeoxml.inject = [];
	function ngGeoxml() {
		return geoXML3;
	}
})();
