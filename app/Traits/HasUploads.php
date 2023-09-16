<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use App\Services\Upload\Filename;

trait HasUploads
{
    protected $route;

    public function updateUpload($file){

        $this->deleteUpload(true);

        $original_name = $file->getClientOriginalName();
        $mimetype = $file->getClientMimeType();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();


        $path = $this->getTable() . '/' . $this->id . '/uploads/';
        $filename = $this->snake($original_name, $extension);

        Storage::disk('local')->putFileAs($path, $file, $filename);

        $position = $this->uploads()->count();
        $this->uploads()->create([
            'uploadable_id' => $this->id,
            'original_name' => $this->clean($original_name),
            'name'          => $filename,
            'type'          => $mimetype,
            'size'          => $size,
            'file'          => $path,
            'position'      => $position,
        ]);
    }

    /**
     * @param bool $force
     */
    public function deleteUpload($force = false){
        $upload = $this->uploads()->first();
        if($upload) {
            if ($force) {
                Storage::disk('local')->delete($upload->file . '/' . $upload->name);
                $upload->forceDelete();
            } else {
                $upload->delete();
            }
        }
    }

    /**
     * @return mixed
     */
    public function getUploadAttribute(){
        return $this->uploads()->count();
    }

    public function getUploadHashAttribute(){
        $upload = $this->uploads()->first();
        return encrypt($upload);
    }

    /**
     * @return mixed
     */
    public function getUploadUrlAttribute(){
        $upload = $this->uploads()->first();
        return $upload && $this->route
            ? route($this->route, encrypt($upload))
            : $this->defaultUploadUrl();
    }

    /**
     * @param $route
     */
    public function setUploadRoute($route){
        $this->route = $route;
        return $this;
    }

    /**
     * @return string
     */
    protected function defaultUploadUrl(){
        return 'https://ui-avatars.com/api/?name='.urlencode($this->name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * @param string $name
     * @param string $extension
     * @return string
     */
    protected function snake(string $name, string $extension): string{
        return md5(time() . $name) . '.' . $extension;
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function clean($name){
        return filter_var($name, FILTER_SANITIZE_STRING);
    }
}
