<?php

namespace App\Services;

class MediaService
{
    public static function upload_media($request, $field_name, $folder){

        if(!$request->hasFile($field_name)) {
            logger()->error("$field_name name not found in request." );
            throw  new \Exception('file ');
        }

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

    public static function delete_meedoa($media_path)
    {
        if (file_exists(public_path($media_path))) {
            unlink(public_path($media_path));
            logger()->info('Previous media deleted: ' . $media_path);
        }
    }
}