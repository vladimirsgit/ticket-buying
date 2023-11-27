<?php

function generateEmailToken($email){
    $randomString = bin2hex(openssl_random_pseudo_bytes(16));

}