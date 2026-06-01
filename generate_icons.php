<?php
$sizes = [72, 96, 128, 144, 152, 192, 384, 512];

foreach ($sizes as $size) {
    $img = imagecreatetruecolor($size, $size);
    $bg = imagecolorallocate($img, 59, 130, 246); // #3B82F6
    $textColor = imagecolorallocate($img, 255, 255, 255);
    
    imagefill($img, 0, 0, $bg);
    
    $fontSize = $size / 2;
    $text = 'R';
    $bbox = imagettfbbox($fontSize, 0, __DIR__ . '/arial.ttf', $text);
    if (!$bbox) {
        // Fallback - draw simple text
        $x = ($size - strlen($text) * $fontSize) / 2;
        $y = ($size + $fontSize) / 2;
        imagestring($img, 5, $x, $y, $text, $textColor);
    } else {
        $x = ($size - ($bbox[2] - $bbox[0])) / 2;
        $y = ($size - ($bbox[1] - $bbox[7])) / 2;
        imagettftext($img, $fontSize, 0, $x, $y, $textColor, __DIR__ . '/arial.ttf', $text);
    }
    
    imagepng($img, "public/icon-{$size}.png");
    imagedestroy($img);
    echo "Generated icon-{$size}.png\n";
}
