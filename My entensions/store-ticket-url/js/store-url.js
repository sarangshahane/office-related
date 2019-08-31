// document.body.style.border = "5px solid red";

function get_current_page_url (){

	var page_url = window.location.href;

	return page_url;
}


function store_ticket_url_in_file(textFile){
	
	alert('In store_ticket_url_in_file function = '+textFile);

	// const fs = require('fs');
  
	// Data which will write in a file.
	var data = textFile;
	  
	// Write data in 'Output.txt' .
	alert('Data = '+data);

	// file = fopen("C:/xampp/htdocs/sarang/store-ticket-url/files/Output.txt", 3);// opens the file for writing

	// alert('file = '+file);

	// fwrite(file, data);

	var {Cc, Ci} = require("chrome");

    var txt = "my file contents";

    var file = Cc["@mozilla.org/file/directory_service;1"].getService(Ci.nsIProperties).get("ProfD", Ci.nsIFile);
    file.append("Output.txt");
    var fs = Cc["@mozilla.org/network/file-output-stream;1"].createInstance(Ci.nsIFileOutputStream);
    fs.init(file, 0x02 | 0x08 | 0x20, 0664, 0); // write, create, truncate
    fs.write(txt, txt.length);
    fs.close();
}


var textFile = null,
  makeTextFile = function (text) {
    var data = new Blob([text], {type: 'text/plain'});

    // If we are replacing a previously generated file we need to
    // manually revoke the object URL to avoid memory leaks.
    if (textFile !== null) {

      window.URL.revokeObjectURL(textFile);
    }

    textFile = window.URL.createObjectURL(data);

    // returns a URL you can use as a href

    alert(textFile);
    store_ticket_url_in_file(textFile);
  };

// makeTextFile();


// var url  = 'https://script.google.com/macros/s/abcdefghijklmnopqrstuvwxyz1234567890/exec',
//     page_url = window.location.href;;

$(window).load(function(){
    // e.preventDefault();
    alert();
    var my_data = {
    'task_link': window.location.href
    };

    jQuery.ajax({
        url: 'http://script.google.com/macros/s/AKfycbxKDc_Lj7_8sirAOoS27ReFskUkF2KwB2Tci8WJUi5PC5SlaQR8/exec',
        crossDomain: true,
        method: "GET",
        dataType: "jsonp",
        data: my_data,
        headers: {
                 "accept": "application/json",
                 "Access-Control-Allow-Origin":"*"
             }
      })
});

//window.whenloaded = 
