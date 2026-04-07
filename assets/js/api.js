$(document).ready(function(){
runAPI('test');

});


	function runAPI(val){
		var postdata =
			{
			  "shipments": [
			    {
			      "pmn": {
			        "client_name1": "Ms. Contact Person",
			        "client_name2": "Globe Telecom",
			        "client_addr1": "#123 ABC St. Greenhills",
			        "client_addr2": " San Juan, Jose St.",
			        "client_addr3": "Paranaque",
			        "client_addr4": "Metro Manila",
			        "client_zip": "1700",
			        "client_telfax": null,
			        "client_email": "test@gmail.com",
			        "client_contact": "09321234567",
			        "client_mobile": "09321234567",
			        "ship_acct_num": "1000019645",
			        "cons_acct_num": null,
			        "cons_name": "Juan dela Cruz",
			        "ship_to": "Test",
			        "ship_to_addr1": "Zamboanga",
			        "ship_to_addr2": "zamboanga Pitogo",
			        "ship_to_addr3": "ZAMBOANGA DEL SUR",
			        "ship_to_addr4": "PROVINCIAL",
			        "ship_to_zip": "7033",
			        "ship_to_tel": "8791234",
			        "ship_to_email": "test@gmail.com",
			        "ship_to_mobile": "09171234567",
			        "shp_val": 100,
			        "shp_wt": 25,
			        "shp_dim": 25,
			        "acct_num": "1000019645",
			        "bill_acct_num": "1000019645",
			        "tp_acct_num": "",
			        "svc_type": "EXPDTD",
			        "pay_type": "BILSHP",
			        "contents": "Cellphone",
			        "batch_num": null,
			        "acc_cour": null,
			        "outlet_acct_num": "",
			        "dropoff_loc": "",
			        "pack_num": 1,
			        "cust_billgrp": "",
			        "client_addr_class": "C",
			        "ship_to_add_class": "R",
			        "collection_amount": ""
			      },
			      "packages": [
			        {
			          "pkg_wt": 25,
			          "pkg_type": "DD00000004",
			          "pkg_length": "60",
			          "pkg_width": "30",
			          "pkg_height": "90"
			        }
			      ],
			      "reference_number": [
			        {
			          "cref_num": "0001-12345678"
			        }
			      ]
			    }
			  ]
			}

			// $.ajax({
			//     type: "POST",
			//     url: "https://tracking.air21.com.ph/api_test/pmn/globetel",
			//     // The key needs to match your method's input parameter (case-sensitive).
			//     data: JSON.stringify(postdata),
			//     contentType: "application/json; charset=utf-8",
			//     dataType: "json",
			//     success: function(data){alert(data);},
			//     error: function(errMsg) {
			//         console.log(errMsg);
			//     }
			// });
	}