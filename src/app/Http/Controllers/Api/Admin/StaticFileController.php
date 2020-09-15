<?php

namespace VCComponent\Laravel\File\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class StaticFileController extends BaseController
{

    public function __construct()
    {
        if (config('static-file.auth_middleware.admin.middleware') !== '') {
            $this->middleware(
                config('static-file.auth_middleware.admin.middleware'),
                ['except' => config('static-file.auth_middleware.admin.except')]
            );
        }
    }

    public function index(Request $request)
    {
        if (!$request->file); {
            $file  = $request->file;
            $check = '.blade.php';
            if (strpos($file, $check) > 0 && is_file('../resources/views/' . $file)) {
                return   response()->file('../resources/views/' . $file);
            } else if (is_dir($file)) {
                $data =   scandir('../resources/views/' . $file);
                return $data;
            }
        }
        $data =   scandir('../resources/views');
        return $data;
    }

    public function update(Request $request)
    {
        if (!$request->file); {
            $file  = '../resources/views/' . $request->file;
            $findme = '.blade.php';
            $data =  $request->content;
            if (strpos($file, $findme) > 0 && is_file($file)) {
                $fileOpen = fopen($file, 'w');
                fwrite($fileOpen, $data);
                fclose($fileOpen);
                return response()->file($file);
            } else {
                throw new \Exception('Không tìm thấy file');
            }
        }
        throw new \Exception('Không tìm thấy file');
    }
}
