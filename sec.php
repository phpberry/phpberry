<!DOCTYPE html>
<html>
<head>
    <?php
    require 'config/bootstrap.php';
    
    use App\Libraries\Security;
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
$secHandle = new Security();
$result = $secHandle->script($str);
echo $result;
?>
</body>
</html>