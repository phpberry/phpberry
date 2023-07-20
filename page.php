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
$page = $_GET['page'] ?? 0;
$per_page = 10;
$reload = basename($_SERVER['PHP_SELF'], '.php');

$pageHandle = new MyMPage();
$total_results = $pageHandle->countCountries();
$paginateHandle = new CpLPagination();
[$show_page, $tPages, $total_pages, $start, $end] = $paginateHandle->paginateData($page, $total_results, $per_page);

echo "<table class='table table-bordered'>";
echo '<thead><tr><th>country code</th> <th>Country Name</th></tr></thead>';
$allCountries = $pageHandle->allCountries($start, $per_page);
foreach ($allCountries as $val) {
    echo '<tr>';
    echo '<td>' . $val->ccode . '</td>';
    echo '<td>' . $val->country . '</td>';
    echo '</tr>';
}
echo '</table>';
if ($total_pages > 1) {
    $pageMenu = $paginateHandle->paginate($reload, $show_page, $total_pages, $get = false);
    echo $pageMenu;
}
?>
</body>
</html>