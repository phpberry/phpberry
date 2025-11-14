<!DOCTYPE html>
<html>
<head>
    <?php
    require 'config/bootstrap.php';
    
    use App\Libraries\Pagination;
    // require 'config/seo.php';
    ?>
</head>
<body>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 0;
$per_page = 10;
$reload = basename($_SERVER['PHP_SELF'], ".php");

$pageHandle = new MY_Mpage();
$total_results = $pageHandle->countCountries();
$paginateHandle = new Pagination();
list($show_page, $tpages, $total_pages, $start, $end) = $paginateHandle->paginate_data($page, $total_results, $per_page);

echo "<table class='table table-bordered'>";
echo "<thead><tr><th>country code</th> <th>Country Name</th></tr></thead>";
$allCountries = $pageHandle->allCountries($start, $per_page);
foreach ($allCountries as $val) {
    echo '<tr>';
    echo '<td>' . $val->ccode . '</td>';
    echo '<td>' . $val->country . '</td>';
    echo "</tr>";
}
echo "</table>";
if ($total_pages > 1) {
    $pagemenu = $paginateHandle->paginate($reload, $show_page, $total_pages, $get = false);
    echo $pagemenu;
}
?>
</body>
</html>