var myInterval = setInterval(refreshpage,1 * 500000);
function rand(){return Math.round(Math.random()*100000)}

//Function to create an XMLHttp Object.
function getxmlhttp (){
//Create a boolean variable to check for a valid Microsoft ActiveX instance.
var xmlhttp = false;
//Check if we are using Internet Explorer.
try {
//If the JavaScript version is greater than 5.
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
//If not, then use the older ActiveX object.
try {
//If we are using Internet Explorer.
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
//Else we must be using a non-Internet Explorer browser.
xmlhttp = false;
}
}
// If we are not using IE, create a JavaScript instance of the object.
if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}


function refreshpage (){
//Get an XMLHttpRequest object for use.
var xmlhttp = getxmlhttp();
xmlhttp.open("GET", "/refresh?"+rand());
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
}
}
xmlhttp.send(null);
}
