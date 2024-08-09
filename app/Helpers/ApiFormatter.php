<?php

namespace App\Helpers;
// namespace digunakan untuk menentukan lokasi folder dari file ini

// class = nama class
class ApiFormatter {
    // variabel struktur data yang akan ditampilkan di response postman 
    protected static $response = [
        "status" => NULL,
        "message" => NULL,
        "data" => NULL,
    ];

    public static function sendResponse($status, $message, $data = null) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);

        
        if (!function_exists('app_path')) {
            /**
             * Get the path to the application folder.
             *
             * @param  string $path
             * @return string
             */
            function app_path($path = '')
            {
                return app()->basePath('app') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
            }
        }


    }
    // status : http status code 
    // message : desc http status code 
    // data : hasil yang diambil dari db

}
