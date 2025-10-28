<?php
declare(strict_types=1);

session_start();

$allowedRefDomain = $_SERVER['HTTP_HOST'];
$referer = $_SERVER['HTTP_REFERER'] ?? '';

if (!str_contains($referer, $allowedRefDomain)) {
    header('Content-Type: text/html');
    http_response_code(204);
    echo "<h1>Clever... Very clever...</h1>";
    exit;
}

$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$code = '';
for ($i = 0; $i < 5; $i++) {
    $code .= $characters[random_int(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $code;

$width = 200;
$height = 70;
$image = imagecreatetruecolor($width, $height);

$bgColor = imagecolorallocate($image, 255, 255, 255);
imagefill($image, 0, 0, $bgColor);

for ($i = 0; $i < 8; $i++) {
    $lineColor = imagecolorallocate($image, rand(100,255), rand(100,255), rand(100,255));
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lineColor);
}

for ($i = 0; $i < 10; $i++) {
    $circleColor = imagecolorallocate($image, rand(100,255), rand(100,255), rand(100,255));
    imageellipse($image, rand(0, $width), rand(0, $height), rand(5, 20), rand(5, 20), $circleColor);
}

for ($i = 0; $i < 600; $i++) {
    $dotColor = imagecolorallocate($image, rand(100,255), rand(100,255), rand(100,255));
    imagesetpixel($image, rand(0, $width), rand(0, $height), $dotColor);
}

$fontPath = __DIR__ . '/font.otf';
$spacing = 30;
$x = 15;

for ($i = 0; $i < strlen($code); $i++) {
    $angle = rand(-30, 30);
    $fontSize = rand(18, 34);
    $y = rand(35, 60);
    $pink = imagecolorallocate($image, 255, 20, 147);

    if ($i > 0 && rand(1, 1000) <= 334) {
        $x -= rand(3, 8);
    }

    imagettftext($image, $fontSize, $angle, $x, $y, $pink, $fontPath, $code[$i]);
    $x += $spacing;
}

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
