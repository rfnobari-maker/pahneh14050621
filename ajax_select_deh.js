// Multiple select lists - http://coursesweb.net/ajax/

// function used to remove the next lists already displayed when it chooses other options
function removeLists(colid) {
  var z = 0;
  // removes data in elements with the id stored in the "ar_cols" variable
  // starting with the element with the id value passed in colid
  for(var i=1; i<ar_cols.length; i++) {
    if(ar_cols[i]==null) continue;
    if(ar_cols[i]==colid) z = 1;
    if(z==1) document.getElementById(preid+ar_cols[i]).innerHTML = '';
  }
}
// sends data to a php file, via POST, and displays the received answer
function ajaxReq(col, wval) {
  removeLists(col);           // removes the already next selects displayed

  // if the value of wval is not '- - -' and '' (the first option)
  if(wval!='- - -' && wval!='') {
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');  // XMLHttpRequest instance
    var php_file = 'select_deh.php';     // path and name of the php file

    // create pairs index=value with data that must be sent to server
    var  data_send = 'col='+col+'&wval='+wval;

    request.open("POST", php_file, true);			// set the request

    document.getElementById(preid+col).innerHTML = '...بارگذاری ';   // display a loading notification

    // adds a header to tell the PHP script to recognize the data as is sent via POST
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(data_send);	      	// calls the send() method with data_send

    // Check request status
    // If the response is received completely, will be added into the tag with id value of "col"
    request.onreadystatechange = function() {
      if (request.readyState==4) {
        document.getElementById(preid+col).innerHTML = request.responseText;
      }
    }
  }
}