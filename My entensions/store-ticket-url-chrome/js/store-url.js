chrome.runtime.onInstalled.addListener(function() {
    
    chrome.storage.sync.set({color: '#3aa757'}, function() {
      console.log("The color is green.");
    });

    // Code to tell the browser to open a popup
    chrome.declarativeContent.onPageChanged.removeRules(undefined, function() {
      chrome.declarativeContent.onPageChanged.addRules([{
        conditions: [new chrome.declarativeContent.PageStateMatcher({
          pageUrl: {hostEquals: 'developer.chrome.com'},
        })
        ],
            actions: [new chrome.declarativeContent.ShowPageAction()]
      }]);
    });
    // Code to tell the browser to open a popup

});


/*$(window).load(function(){
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
});*/

//window.whenloaded = 
