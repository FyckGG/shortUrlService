<?php
namespace Project\Services;
class UrlService
{
public static function getTwoEncryptParts($url, $splitIndex) {
    $encryptUrl = md5($url);
    //echo $encryptUrl;
    $encryptPartOne = substr($encryptUrl, 0, $splitIndex);
    $encryptPartTwo = substr($encryptUrl, $splitIndex, strlen($encryptUrl) - 1);

    return ['partOne'=> $encryptPartOne,
        'partTwo' => $encryptPartTwo];
}

public static function addShortUrlToCookie($longUrl, $shortUrl) {
    if (empty($_COOKIE['shortUrls'])) {
        setcookie('shortUrls', json_encode([$shortUrl => $longUrl]), time() + 3600);
    }

    else {
        $shortUrls = json_decode($_COOKIE['shortUrls'], true);
        //echo('fv');
        $shortUrls[$shortUrl] = $longUrl;
        $shortUrls = array_reverse($shortUrls);
        setcookie('shortUrls', json_encode($shortUrls), time() + 3600);
    }
}
}