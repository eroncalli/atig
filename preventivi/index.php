<?php 
$uri = 'http://';
$uri .= $_SERVER['HTTP_HOST'];
$uri.='/atig/preventivi/preventivi.php';

echo "<script type=\"text/javascript\">";
echo "window.location.replace('" . $uri . "')";
echo "</script>";
?>

 