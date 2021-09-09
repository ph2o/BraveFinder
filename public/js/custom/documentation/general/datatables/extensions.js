/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!*****************************************************************************!*\
  !*** ../demo1/src/js/custom/documentation/general/datatables/extensions.js ***!
  \*****************************************************************************/


// Class definition
var KTDatatablesExtensions = function () {
    // Private functions

    var _initExample1 = function() {
        var t = $('#kt_datatable_example_1').DataTable();
        var counter = 1;
    
        $('#kt_datatable_example_1_addrow').on( 'click', function () {
            t.row.add( [
                counter +'.1',
                counter +'.2',
                counter +'.3',
                counter +'.4',
                counter +'.5'
            ] ).draw( false );
    
            counter++;
        } );
    
        // Automatically add a first row of data
        $('#kt_datatable_example_1_addrow').click();
    }

    // Public methods
    return {
        init: function () {
            _initExample1();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTDatatablesExtensions.init();
});

/******/ })()
;
//# sourceMappingURL=extensions.js.map