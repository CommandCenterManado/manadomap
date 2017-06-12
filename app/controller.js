(function () {
    'use strict';

    angular
        .module('manado.map')
        .controller('mainBodyController', mainBodyController);

    mainBodyController.inject = ['$rootScope', '$scope', 'kmlService', 'ngGeoxml', 'NgMap', 'baseService'];
    function mainBodyController($rootScope, $scope, kmlService, ngGeoxml, NgMap, baseService) {
        var vm = this;
        vm.mapInit = mapInit;

        activate();

        ////////////////

        function activate() { }

        function mapInit(map) {
            kmlService.setKml('manado.kml');
        }
    }
})();

(function () {
    'use strict';

    angular
        .module('manado.map')
        .controller('quickMenuController', quickMenuController);

    quickMenuController.inject = ['$rootScope', '$scope', 'getData', 'kmlService'];
    function quickMenuController($rootScope, $scope, getData, kmlService) {
        var vm = this;

        activate();

        vm.setKml = setKml;
        vm.prosesAmbilDataKelurahan = false;
        vm.ambilDataKelurahan = ambilDataKelurahan;
        $scope.$on('ambilDataKelurahanStart', function (e, a) {
            vm.prosesAmbilDataKelurahan = true;
        })
        $scope.$on('ambilDataKelurahanSuccess', function (e, a) {
            vm.prosesAmbilDataKelurahan = false;
        })

        ////////////////

        function activate() {
            getDataKecamatan()
                .then(function (respon) {
                    vm.kecamatan = respon;
                })
        }

        function ambilDataKelurahan(idkecamatan) {
            getDataKelurahan(idkecamatan)
                .then(function (respon) {
                    vm.kelurahan = respon;
                })
        }

        function getDataKecamatan() {
            return getData.kecamatan()
                .then(function (respon) {
                    return respon;
                })
        }
        function getDataKecamatanById(idkecamatan) {
            return getData.kecamatanById(idkecamatan)
                .then(function (respon) {
                    return respon;
                })
        }
        function getDataKelurahan(idkecamatan) {
            $scope.$emit('ambilDataKelurahanStart');
            return getData.kelurahan(idkecamatan)
                .then(function (respon) {
                    $scope.$emit('ambilDataKelurahanSuccess');
                    return respon;
                })
        }
        function getDataKelurahanById(idkelurahan) {
            return getData.kelurahanById(idkelurahan)
                .then(function (respon) {
                    return respon;
                })
        }

        function setKml(type, id) {
            if (type == 'kec') {
                getDataKecamatanById(id)
                    .then(function (respon) {
                        kmlService.setKml(respon.kml);
                    })
            } else if (type == 'kel') {
                getDataKelurahanById(id)
                    .then(function (respon) {
                        kmlService.setKml(respon.kml);
                    })
            } else if (type == 'all') {
                kmlService.setKml('manado.kml');
            }
        }
    }
})();