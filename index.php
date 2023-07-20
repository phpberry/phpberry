<?php

declare(strict_types=1);

require 'config/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require BASE_PATH . 'config/meta.php';
?>
    <title>phpberry</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</head>
<body>
<img id="CPcaptcha" src="<?php echo HOOKS_URL; ?>captcha" alt=""/>
<button onclick="document.getElementById('CPcaptcha').src='<?php echo HOOKS_URL; ?>captcha'">Refresh</button>
<p id="demo"></p>


<?php
echo segment(0);
// var_dump($_SERVER);
//   $time = 1; //min
// $file = BASE_URL.'512';
// require HOOKS_PATH.'aftertime.php';

$table = 'helloworld';
$con = 'OR';
$fetchField = [
    'fname',
    'lname',
];
$whereField = [
    'id' => 15,
];
$dynamicHandle = new CpMDynamic();

$dynamicList = $dynamicHandle->select($table);
var_dump($dynamicList);

$jsonHandle = new CpLJson();
$jsonList = $jsonHandle->Tojson($dynamicList);
var_dump($jsonList);

$jsonobjList = $jsonHandle->jsonToObject($jsonList);
var_dump($jsonobjList);

$jsonobjList = $jsonHandle->jsonToArray($jsonList);
var_dump($jsonobjList);

?>

<?php

/*  $fetchField = array(
      'table1' => array("f11", "f12","f13"),
      'table2' => array("f21", "f22","f23"),
  );
  $compare = array(
      'table1' => "f11",
      'table2' => "f21",
  );
  $dynamicHandle=new CpMDynamic();
  $dynamicList=$dynamicHandle->join($fetchField,$compare);*/
$table = 'helloworld';
$con = 'OR';
$whereField = [
    'fname' => 'dipesh',
    'lname' => 'sukhia',
];
$dynamicHandle = new CpMDynamic();
$dynamicList = $dynamicHandle->count($table, $whereField, $con);
var_dump($dynamicList);
?>
<?php
require HOOKS_PATH . 'ZoomInOut.php';

echo time() . round(microtime(true));

?>
<button onclick="toggleFullScreen()">Zoom in Zoom Out</button>

<script type="text/javascript">
    $(document).ready(function () {
        setInterval(function () {
            console.clear();
        }, 1000 * 60 * 0.1);
    });
</script>
</body>
</html>
