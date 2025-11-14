<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)) {
    header("Location: 404");
}
/*******************************************************************
 * add  to your header in head tag for seo and comment it
 *******************************************************************/
$company = "phpberry";
$description = "description";
$jsmsg = true;
$seo = true;
/*******************************************************************
 * add  to your header in head tag for seo
 *******************************************************************/

$current = basename($_SERVER['SCRIPT_FILENAME'], ".php");
$title = ucwords(str_replace("-", " ", str_replace("_", " ", $current)));
?>
<title><?php echo $current == "index" ? "Home" : $title; ?> | <?php echo $company; ?></title>
<?php if (!$seo) { ?>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW"> <?php } ?>
<meta name="google-site-verification" content=""/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<meta name="keywords" itemprop="keywords" content=""/>
<meta name="description" content="<?php echo $description; ?>"/>
<meta name="copyright" content="Copyright &copy <?php echo date("Y") . '-' . $company ?>"/>
<meta name="<?php echo $company; ?>-site" content="">
<meta name="<?php echo $company; ?>-google+" content="">
<meta name="<?php echo $company; ?>-facebook" content="">
<meta name="<?php echo $company; ?>-twitter" content="">
<meta name="<?php echo $company; ?>-linkedin" content="">


<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?php echo $company; ?>">
<meta itemprop="description" content="<?php echo $description; ?>">
<meta itemprop="image" content="http://www.example.com/image.jpg">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="<?php echo $company; ?>">
<meta name="twitter:title" content="<?php echo $title . ' | ' . $company; ?>">
<meta name="twitter:description" content="<?php echo $description; ?>">
<meta name="twitter:creator" content="@author_handle">
<meta name="twitter:image" content="http://www.example.com/image.jpg">

<!-- Open Graph data -->
<meta property="og:title" content="<?php echo $title . ' | ' . $company; ?>"/>
<meta property="og:type" content="article"/>
<meta property="og:url" content="http://www.example.com/"/>
<meta property="og:image" content="http://example.com/image.jpg"/>
<meta property="og:description" content="<?php echo $description; ?>"/>
<meta property="og:site_name" content="<?php echo $company; ?>"/>

<!-- author details -->
<meta name="author" content="">
<meta name="author-site" content="">
<meta name="author-google+" content="">
<meta name="author-facebook" content="">
<meta name="author-twitter" content="">
<meta name="author-linkedin" content="">
<?php if ($jsmsg) { ?>
    <noscript>
        <style type="text/css">
            body {
                visibility: hidden;
            }
        </style>
        <div style="visibility: visible;font-size: 200%;color: red;">
            <center>
                " JavaScript is disabled in your browser."<br>
                " Please enable JavaScript in your browser <br>OR<br> upgrade to a JavaScript-capable browser to visit
                for <?php echo $company; ?>. "
            </center>
        </div>
    </noscript>
<?php } ?>