<!DOCTYPE html>
<html>
<head>
    <?php
    require 'config/bootstrap.php';
    // require 'config/seo.php';  
    ?>
</head>
<body>
<?php
$str = '<script>
$( document ).ready(function() {
    console.log( "ready!" );
});
</script>';
$secHandle = new CP_Lsecurity();
$result = $secHandle->script($str);
echo $result;
?>
</body>
</html>