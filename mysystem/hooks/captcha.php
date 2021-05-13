<?php
//if(basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__)){header("Location: 404");}
// capcha is an img code so auto executr code in comment

/* code in your file
<img id="CPcaptcha" src="<?php echo HOOKS_URL;?>captcha"/>
<button onclick="document.getElementById('CPcaptcha').src='<?php echo HOOKS_URL;?>captcha'">Refresh</button>*/
session_start();
$string = '';
$characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
$charactersLength = count($characters) - 1;
$randomString = '';
for ($i = 0; $i < 5; $i++) {
    $string .= $characters[mt_rand(0, $charactersLength - 1)];
}
$_SESSION['captcha'] = $string;
$dir = 'captcha_fonts/';
$image = imagecreatetruecolor(165, 50);
$color = imagecolorallocate($image, 255, 255, 255);// color
$white = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // background color white
imagefilledrectangle($image, 0, 0, 399, 99, $white);
// random number 1 or 2
$num = rand(1, 2);
if ($num == 1) {
    $font = "Walkway_Black_RevOblique.ttf"; // font style
    imagettftext($image, 30, 0, 10, 40, $color, $dir . $font, $_SESSION['captcha']);
} else {
    $font = "D3Craftism.ttf";// font style
    imagettftext($image, 25, 0, 10, 40, $color, $dir . $font, $_SESSION['captcha']);
}
header("Content-type: image/png");
imagepng($image);
?>