<?php 
$uri = 'http://';
$uri .= $_SERVER['HTTP_HOST'];
$uri.='/atig/login.php';

echo "<script type=\"text/javascript\">";
echo "window.location.replace('" . $uri . "')";
echo "</script>";
?>

 