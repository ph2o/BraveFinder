/******/ (() => { // webpackBootstrap
    /******/ 	"use strict";
    var __webpack_exports__ = {};
    /*!***********************************************************************!*\
      !*** ../demo1/src/js/custom/apps/user-management/users/list/table.js ***!
      \***********************************************************************/


    var EvaluationList = function () {
        // Define shared variables
        var table0 = document.getElementById('evaluation_list_0');
        var table1 = document.getElementById('evaluation_list_1');
        var datatable0;
        var datatable1;

        // Private functions
        var initUserTable0 = function () {
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable0 = $(table0).DataTable({
                "info": false,
                'order': [],
                "pageLength": 20,
                responsive: true,
                "lengthChange": false,
                'columnDefs': [
                    { orderable: false, targets: 3 }, // Disable ordering on column 6 (actions)
                ]
            });
        }
        var initUserTable1 = function () {
            // Init datatable --- more info on datatables: https://datatables.net/manual/
            datatable1 = $(table1).DataTable({
                "info": false,
                'order': [],
                "pageLength": 20,
                "lengthChange": false,
                'columnDefs': [
                    { orderable: false, targets: 3 }, // Disable ordering on column 6 (actions)
                ]
            });
        }

        // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
        var handleSearchDatatable = () => {
            const filterSearch0 = document.querySelector('[data-kt-user-table-filter="search"]');
            filterSearch0.addEventListener('keyup', function (e) {
                datatable0.search(e.target.value).draw();
            });
            const filterSearch1 = document.querySelector('[data-kt-user-table-filter="search"]');
            filterSearch1.addEventListener('keyup', function (e) {
                datatable1.search(e.target.value).draw();
            });
        }

        return {
            // Public functions
            init: function () {
                if (!table0) {
                    return;
                }

                initUserTable0();
                initUserTable1();
                handleSearchDatatable();
            }
        }
    }();

// On document ready
    KTUtil.onDOMContentLoaded(function () {
        EvaluationList.init();
    });
    /******/ })()
;
//# sourceMappingURL=table.js.map