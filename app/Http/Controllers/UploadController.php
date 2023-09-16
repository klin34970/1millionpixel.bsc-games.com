<?php

namespace App\Http\Controllers;

use App\Models\Upload;

class UploadController extends Controller
{
    /**
     * @param $upload
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showUpload($upload){
        $upload = decrypt($upload);
        return response()->download(storage_path('app') . '/' . $upload->file . '/' . $upload->name, null, [], null);
    }

    /**
     * @param $upload
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showUploadShortUrl(Upload $upload){
        return response()->download(storage_path('app') . '/' . $upload->file . '/' . $upload->name, null, [], null);
    }

    /**
     * @param $upload
     */
    public function destroyUpload($upload){
        $upload = decrypt($upload);
        $upload->uploadable->deleteUpload(true);
        return back(303)->with('status', 'upload-deleted');
    }
}
