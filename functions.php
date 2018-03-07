<?php
function getRandomBytes($nbBytes = 32)
{
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if (false !== $bytes && true === $strong) {
        return $bytes;
    }
    else {
        throw new \Exception("Unable to generate secure token from OpenSSL.");
    }
}
function generateInviteCode($length){
    $invcode = substr(preg_replace("/[^a-z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
return $invcode;
}

function getRandomPw($nbBytes = 32)
{
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if (false !== $bytes && true === $strong) {
        return $bytes;
    }
    else {
        throw new \Exception("Unable to generate secure token from OpenSSL.");
    }
}

function generatePassword($length_pw){
    $password = substr(preg_replace("/[^A-Za-z0-9]/", "", base64_encode(getRandomPw($length_pw+1))),0,$length_pw);
return $password;
}


?>