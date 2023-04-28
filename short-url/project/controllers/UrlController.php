<?php

namespace Project\Controllers;
use \Core\Controller;
use \Project\Models\Url;
use \Project\Services\UrlService;

class UrlController extends Controller
{
public function index() {
    $this->title = 'ShortUrl';
    return $this->render('url/index');
}

public function post() {
    $this->title = 'ShortUrl';
    $url = new Url();
    $isUrlExists = $url->findByLongUrl($_POST['URL']);
    if (empty($isUrlExists)) {
        $encryptParts = UrlService::getTwoEncryptParts($_POST['URL'], 8);
        $url->saveUrl($_POST['URL'], $encryptParts['partOne'], $encryptParts['partTwo']);
        UrlService::addShortUrlToCookie($_POST['URL'], $encryptParts['partOne']);
        header('Location: /');
    }
    $expiry_timestamp = strtotime($isUrlExists['expiry_at']);
    $current_timestamp = time();
    if ($expiry_timestamp - $current_timestamp <= 0) {
        $encryptParts = UrlService::getTwoEncryptParts($_POST['URL'], 8);
        $url->updateUrl($_POST['URL'], $encryptParts['partOne'], $encryptParts['partTwo']);
        UrlService::addShortUrlToCookie($_POST['URL'], $encryptParts['partOne']);
        header('Location: /');

    }
    UrlService::addShortUrlToCookie($_POST['URL'], $isUrlExists['first_encrypt_part']);
    header('Location: /');
}

public function redirect($params) {
    $shortUrl = $params['shortUrl']; // логика если не найдено
    if (empty($shortUrl)) {
        header("Location: /");
        die();
    }
    $url = new Url();
    $result = $url->findByShortUrl($shortUrl); // логика если не найдено
    if (empty($result)) {
        header("Location: /"); // хотя по хорошему кншн сделать отдельные странички для этого
        die();
    }
    $redirectUrl = $result['long_url'];
    //var_dump($redirectUrl);
    header("Location: $redirectUrl", true, 301);
    die();
}
}