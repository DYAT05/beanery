/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.3.0
*/

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		
		$('.datatable-default').dataTable( {
			"order": [],
			lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		});
		}

	$(function() {
		datatableInit();
	});


	var datatableInit2 = function() {

		
		$('#datatable-default').dataTable( {
			"order": [],
			lengthMenu: [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		});
		}

	$(function() {
		datatableInit2();
	});
}).apply( this, [ jQuery ]);