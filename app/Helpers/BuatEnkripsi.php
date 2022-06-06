<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('Enkripsi')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function Enkripsi(string $s)
    {
        return Crypt::encrypt($s);
    }
}

if (!function_exists('Dekripsi')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function Dekripsi(string $s)
    {
        try {
            $decrypted = Crypt::decrypt($s);
            return $decrypted;
        } catch (Exception $es) {
            return false;
        }
    }
}
