<?php

declare(strict_types=1);

require 'config/bootstrap.php';
// require 'config/seo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>phpberry</title>
</head>
<body>
<?php
$valHandle = new CpLValidation();

$str = $valHandle->required('hjh');
echo $str;

$str = $valHandle->alpha('asd');
echo $str;

$str = $valHandle->alphanumeric('asd12');
echo $str;

$str = $valHandle->numeric('123');
echo $str;

$str = $valHandle->alpha_space('asd kll ');
echo $str;

$str = $valHandle->email('dipesh.sukhia@gmail.com');
echo $str;

$str = $valHandle->url('http://fgdfgf');
echo $str;

$str = $valHandle->minlength('dipesh', 6);
echo $str;

$str = $valHandle->length_range('dipesh', 2, 6);
echo $str;
$str = $valHandle->equalTo('dipesh', 'dipesh');
echo $str;
?>
</body>
</html>