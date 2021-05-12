/* 
<script src="js/master.js" type="text/javascript"></script>
this function includes all necessary js files for the application 
*/
var arr = window.location.href.split("/");
var domain = arr[0] + "//" + arr[2];
var ScriptName = [ 
					"assets/myFile1.js",
					"assets/myFile2.js",
				 ];

function includeJs(file, index) {    
    var script  = document.createElement('script');
  	script.src  = file;
  	script.type = 'text/javascript';
  	script.defer = true;
  	document.getElementsByTagName('body').item(0).appendChild(script);
}		

ScriptName.forEach(includeJs);