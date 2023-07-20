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
$fatchfield = [
    'fname',
    'lname',
];
$wherefield = [
    'id' => 15,
];
$dynamicHandle = new CP_Mdynamic();

$dynamicList = $dynamicHandle->select($table);
var_dump($dynamicList);

$jsonHandle = new CP_Ljson();
$jsonList = $jsonHandle->Tojson($dynamicList);
var_dump($jsonList);

$jsonobjList = $jsonHandle->jsonToObject($jsonList);
var_dump($jsonobjList);

$jsonobjList = $jsonHandle->jsonToArray($jsonList);
var_dump($jsonobjList);

?>

<?php

/*  $fatchfield = array(
      'table1' => array("f11", "f12","f13"),
      'table2' => array("f21", "f22","f23"),
  );
  $compare = array(
      'table1' => "f11",
      'table2' => "f21",
  );
  $dynamicHandle=new CP_Mdynamic();
  $dynamicList=$dynamicHandle->join($fatchfield,$compare);*/
$table = 'helloworld';
$con = 'OR';
$wherefield = [
    'fname' => 'dipesh',
    'lname' => 'sukhia',
];
$dynamicHandle = new CP_Mdynamic();
$dynamicList = $dynamicHandle->count($table, $wherefield, $con);
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
