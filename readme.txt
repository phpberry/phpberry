1) first open  C:\wamp\bin\apache\apache2.4.9\conf\httpd.conf and find "rewrite_module" Remove # in this line (# is used as comment so just remove comment from this line)

if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}

add this line in all files which have to restrict direct use

you can on off seo in seo.php in config folder

when u call files via php like requrie , include file add.php in last 

hooks folder are added in that capcha and aftertime file exist