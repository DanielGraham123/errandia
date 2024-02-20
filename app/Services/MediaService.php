<?php

namespace App\Services;
use Illuminate\Support\Facades\File;

class MediaService
{
    public static  function has_file($request, $field_name)
    {
        if(!$request->hasFile($field_name)) {
            logger()->error("$field_name name not found in request." );
            throw  new \Exception('file ');
        }
    }
    public static function upload_media($request, $field_name, $folder): string
    {

        self::has_file($request, $field_name);

        $relative_path = public_path("uploads/$folder/");
        $media_file = $request->file($field_name);

        if (!file_exists($media_file)) {
            mkdir($relative_path, 0777, true);
        }

        $filename =  time()  . '.' . $media_file->getClientOriginalExtension();
        $media_file->move($relative_path, $filename);

        logger()->info("media file successfully uploaded");
        return $relative_path . $filename;
    }
    public static function delete_media($media_path): void
    {
        if (file_exists(public_path($media_path))) {
            // File::delete(public_path($media_path));
            unlink(public_path($media_path));
            logger()->info('Previous media deleted: ' . $media_path);
        }
    }
}