<?php


use App\Models\Variant;
use Intervention\Image\Facades\Image;

if(!function_exists('fileUpload'))
{
    function fileUpload($img, $path, $user_file_name = null, $width = null, $height = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if (isset($user_file_name) && $user_file_name != "" && file_exists($path . $user_file_name)) {
            unlink($path . $user_file_name);
        }
        // saving image in target path
        $imgName = uniqid() . time() . '.' . $img->getClientOriginalExtension();
        $imgPath = public_path($path . $imgName);
        // making image
        $makeImg = Image::make($img)->orientate();
        if ($width != null && $height != null && is_int($width) && is_int($height)) {
            $makeImg->fit($width, $height);
        }
        if ($makeImg->save($imgPath)) {
            return $imgName;
        }
        return false;
    }
}

if(!function_exists('AdminProfilePicture'))
{
    function AdminProfilePicture()
    {
        return 'upload_files/admin_profile/';
    }
}

if(!function_exists('product_image'))
{
    function product_image()
    {
        return 'upload_files/product_image/';
    }
}

if(!function_exists('AdminProfileShow'))
{
    function AdminProfileShow()
    {
        return Auth::guard('admin')->user()->where('email','superadmin@gmail.com')->first();
    }
}

if(!function_exists('VariantShow'))
{
    function VariantShow()
    {
        return Variant::get();
    }
}


