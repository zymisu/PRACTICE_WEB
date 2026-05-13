<?php
function setPNGHeader() {
    header("Content-Type: image/png");
    header("Expires: -1");
    header("Cache-Control: no-store,no-cache,must-revalidate");
    header("Pragma: no-cache");
}

function makeCaptcha($source, $len) {
    $c = "";
    for ($i = 0; $i < $len; $i++)
        $c .= substr($source, rand(0, strlen($source) - 1), 1);
    return $c;
}

function makePNGCaptcha($captcha) {
    $img = imagecreate(200, 50);
    imagecolorallocate($img, 0, 0, 0);          // nền đen
    $color = imagecolorallocate($img, 255, 255, 0); // chữ vàng

    // dùng imagestring thay imagettftext (không cần file font TTF)
    imagestring($img, 5, 10, 15, $captcha, $color);

    imagepng($img);
    imagedestroy($img);
}