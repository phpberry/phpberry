<?php

declare(strict_types=1);

require 'config/bootstrap.php';

use App\Models\Dynamic;
use App\Libraries\Json;

?>
<!DOCTYPE html>
<html>
<head>
    <?php
    require BASE_PATH . 'config/meta.php';
    ?>
</head>
<body>
<img id="CPcaptcha" src="<?php echo HOOKS_URL; ?>captcha"/>
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
$fatchfield = array(
    'fname',
    'lname',
);
$wherefield = array(
    'id' => 15
);
$dynamicHandle = new Dynamic();

$dynamicList = $dynamicHandle->select($table);
var_dump($dynamicList);

$jsonHandle = new Json();
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
  $dynamicHandle=new Dynamic();
  $dynamicList=$dynamicHandle->join($fatchfield,$compare);*/
$table = 'helloworld';
$con = 'OR';
$wherefield = array(
    'fname' => 'dipesh',
    'lname' => 'sukhia',
);
$dynamicHandle = new Dynamic();
$dynamicList = $dynamicHandle->count($table, $wherefield, $con);
var_dump($dynamicList);
?>
<?php
require HOOKS_PATH . 'ZoomInOut.php';

echo time() . round(microtime(TRUE));

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
