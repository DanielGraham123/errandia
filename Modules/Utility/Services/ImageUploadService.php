<?php
/**
 * Created by PhpStorm.
 * User: Dengun_Guru
 * Date: 2/9/2021
 * Time: 10:18 PM
 */

namespace Modules\Utility\Services;


//use Illuminate\Support\Facades\Config;
//use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;

class ImageUploadService
{
    private $utilityService;

    public function __construct(UtilityService $utilityService)
    {
        $this->utilityService = $utilityService;
    }

    public function uploadFile($request, $request_param, $bucket)
    {
        $base_dir = config("filesystems.disks.public.root") . "/" . $bucket;
        $upload_file = $request[$request_param];
        $filename = $this->utilityService->generateRandSlug() . "_" . time() . '.' . $upload_file->extension();
        $path = $bucket . "/" . $filename;

        $img = Image::make($upload_file->path());
        $img->resize(350, 400)->save($base_dir . '/' . $filename);
        return $path;
    }
//, function ($constraint) {
//    $constraint->aspectRatio();
//}

    public function uploadHomeSlider($request, $request_param, $bucket)
    {
        $base_dir = config("filesystems.disks.public.root") . "/" . $bucket;
        $upload_file = $request[$request_param];
        $filename = $this->utilityService->generateRandSlug() . "_" . time() . '.' . $upload_file->extension();
        $path = $bucket . "/" . $filename;
        $img = Image::make($upload_file->path());
        $img->resize(812, 384)->save($base_dir . '/' . $filename);
        return $path;
    }

    public function deleteFile($file_path)
    {
        //check if file path exist
        if (Storage::disk('public')->exists($file_path)) {
            //delete file
            return Storage::disk('public')->delete($file_path);
        }
    }
}
