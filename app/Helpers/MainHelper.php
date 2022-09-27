<?php

if (!function_exists('jam_menit')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function jam_menit($waktu){
        if(($waktu>0) && ($waktu<60)){
            $lama=number_format($waktu,2)." detik";
            return $lama;
        }
        if(($waktu>60) && ($waktu<3600)){
            $detik=fmod($waktu,60);
            $menit=$waktu-$detik;
            $menit=$menit/60;
            $lama=$menit." Menit ".number_format($detik,2)." detik";
            return $lama;
        }
        elseif($waktu >3600){
            $detik=fmod($waktu,60);
            $tempmenit=($waktu-$detik)/60;
            $menit=fmod($tempmenit,60);
            $jam=($tempmenit-$menit)/60;
            $lama=$jam." Jam ".$menit." Menit ".number_format($detik,2)." detik";
            return $lama;
        }
    }
}

if (!function_exists('printJenisUjian')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function printJenisUjian($str)
    {
        if ($str == "QZ") {
            return "Quiz";
        } elseif ($str == "UH") {
            return "Ulangan Harian";
        } elseif ($str == "UTS") {
            return "Ujian Tengah Semester";
        } elseif ($str == "UAS") {
            return "Ujian Akhir Semester";
        }

    }
}

if (!function_exists('array_to_object')) {

    /**
     * Convert Array into Object in deep
     *
     * @param array $array
     * @return
     */
    function array_to_object($array)
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('empty_fallback')) {

    /**
     * Empty data or null data fallback to string -
     *
     * @return string
     */
    function empty_fallback ($data)
    {
        return ($data) ? $data : "-";
    }
}

if (!function_exists('create_button')) {

    function create_button ($action, $model)
    {
        $action = str_replace($model, "", $action);

        return [
            'submit_text' => ($action == "update") ? "Update" : "Submit",
            'submit_response' => ($action == "update") ? "Updated." : "Submited.",
            'submit_response_notyf' => ($action == "update") ? "Data ".$model." updated successfully" : "Data ".$model." added successfully"
        ];
    }
}
