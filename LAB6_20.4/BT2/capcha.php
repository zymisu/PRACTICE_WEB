<?php
include "function.php";

// Tạo chuỗi captcha
$alphabet = "aaAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789";
$captcha  = makeCaptcha($alphabet, 8);

// Lưu session để kiểm tra bên index.php
session_start();
$_SESSION['captcha'] = $captcha;

// Xuất SVG (không cần GD)
header("Content-Type: image/svg+xml");
header("Expires: -1");
header("Cache-Control: no-store,no-cache,must-revalidate");
header("Pragma: no-cache");

$chars   = str_split($captcha);
$x       = 10;
$letters = "";
foreach ($chars as $ch) {
    $y   = rand(28, 40);
    $rot = rand(-15, 15);
    $letters .= "<text x='$x' y='$y' transform='rotate($rot,$x,$y)' font-size='26' font-family='Arial' font-weight='bold' fill='#ffff00'>$ch</text>\n";
    $x += 22;
}

echo "<svg xmlns='http://www.w3.org/2000/svg' width='200' height='50'>";
echo "<rect width='200' height='50' fill='#000000'/>";
echo "<line x1='0' y1='25' x2='200' y2='20' stroke='#444' stroke-width='1'/>";
echo "<line x1='0' y1='15' x2='200' y2='40' stroke='#333' stroke-width='1'/>";
echo $letters;
echo "</svg>";