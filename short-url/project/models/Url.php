<?php
namespace Project\Models;
use \Core\Model;

class Url extends Model
{
    public function findByLongUrl($longUrl) {
        return $this->findOne("SELECT * from ShortUrl WHERE long_url='$longUrl'");
    }

    public function findByShortUrl($shortUrl) {
        return $this->findOne("SELECT * from ShortUrl WHERE first_encrypt_part='$shortUrl'");
    }

    public function saveUrl($longURL, $firstEncryptPart, $secondEncryptPart) {
        $created_at_date = date("Y-m-d", time());
        $expiry_at_date = date("Y-m-d", time() + (7 * 24 * 60 * 60));
        return $this->insertOne("INSERT INTO ShortUrl (id, long_url, first_encrypt_part, 
                      second_encrypt_part, created_at, expiry_at) 
VALUES (NULL, '$longURL', '$firstEncryptPart', '$secondEncryptPart', '$created_at_date', '$expiry_at_date')");
    }

    public function updateUrl($longURL, $firstEncryptPart, $secondEncryptPart) {
        $expiry_at_date = date("Y-m-d", time() + (7 * 24 * 60 * 60));
        return $this->updateOne("UPDATE ShortUrl SET first_encrypt_part='$firstEncryptPart'
second_encrypt_part='$secondEncryptPart' expiry_at='$expiry_at_date' WHERE long_url='$longURL'");
    }
}