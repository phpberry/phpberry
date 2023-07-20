<?php

declare(strict_types=1);

if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    header('Location: 404');
}
/*
 * TIME ZONE
 */
date_default_timezone_set('Asia/Kolkata');
/*
 * COMPRESS HTML OUTPUT
 */
$isCompressOutput = false;
if ($isCompressOutput) {
    require_once CP_HOOK_PATH . 'CP_Hcompress.php';
}
/*
 * PHP to ASP.NET WITH ERROR REPORTING
 */
$isPhpToAspError = false;
if ($isPhpToAspError) {
    header('X-Powered-By: ASP.NET');
}
/*
 * EXECUTION TIME
 */
$isExecutionTIme = false;
if ($isExecutionTIme) {
    require_once CP_HOOK_PATH . 'CP_Hexecutionconfig.php';
}
/*
 * SEO
 ******************************************************************
 * add this line in to head part
 * $company="phpberry";
 * $jsmsg=true;
 * $seo = true;
 * require BASE_PATH.'config/meta.php';
 */
/*
 * Json API HEADER
 ******************************************************************
 * add this line in to head part
 * require BASE_PATH.'config/json_api_header.php';
 */
/*
 * DEVELOPER TOOLS DISABLE
 ******************************************************************
 * add this line in to head part
 * require_once CP_HOOK_PATH.'CP_HdeveloperOptionBlock.php';
 */
