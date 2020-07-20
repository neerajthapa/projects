<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{









//upload items images starts ==================================================	
    public function image_upload_items(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
        		   $extension = $request->file('file')->getClientOriginalExtension();
         		   $dir = 'images/items/';
         		   $filename = uniqid() . '_' . time() . '.' . $extension;
         		   $request->file('file')->move($dir, $filename);
          		   $path = public_path().'/images/items';
         		   $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'700' , $extension);
                   $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageItems($filename)
    {
        File::delete('images/items'.$filename);
    }








//upload users images starts ================================================== 
    public function image_upload_users(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/users/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/users';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
                    $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageUsers($filename)
    {
        File::delete('images/users'.$filename);
    }




	
	//upload categories images starts ================================================== 
    public function image_upload_categories(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/categories/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/categories';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
                    $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageCategories($filename)
    {
        File::delete('images/categories'.$filename);
    }


	
	//upload tags images starts ================================================== 
    public function image_upload_tags(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/tags/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/tags';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
                   $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageTags($filename)
    {
        File::delete('images/tags'.$filename);
    }

	
	
	//upload logo images starts ================================================== 
    public function image_upload_logo(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/logo/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/logo';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
                    $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageLogo($filename)
    {
        File::delete('images/logo'.$filename);
    }

	
	

//upload stores images starts ================================================== 
    public function image_upload_stores(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/stores/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/stores';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'800' , $extension);
                   $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageStores($filename)
    {
        File::delete('images/stores'.$filename);
    }

	
	
	//upload banners images starts ================================================== 
    public function image_upload_banners(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/banners/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/banners';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
                    $d['filename'] = $filename;
                   return $d;
         }
    }

    public function deleteImageBanners($filename)
    {
        File::delete('images/banners'.$filename);
    }


	
	//upload coupons images starts ================================================== 
    public function image_upload_coupons(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
               $extension = $request->file('file')->getClientOriginalExtension();
               $dir = 'images/coupons/';
               $filename = uniqid() . '_' . time() . '.' . $extension;
               $request->file('file')->move($dir, $filename);
                 $path = public_path().'/images/coupons';
               $thumb_name = "thumb-".$filename;                     
                   $this->make_thumb($path.'/'.$filename,$path.'/'.$thumb_name,'400' , $extension);
				   $d['filename'] = $filename;
                   return $d;
         }
    }

     public function deleteImageCoupons($filename)
    {
        File::delete('images/coupons'.$filename);
    }





public function make_thumb($src, $dest, $desired_width , $ext) 
{
    /* read the source image */
  if($ext == 'webp')
  {
    $source_image = @imagecreatefromwebp(@$src);
    $width = @imagesx($source_image);
    $height = @imagesy($source_image);
  }

    if($ext == 'jpg' || $ext == 'jpeg')
  {
    $source_image = @imagecreatefromjpeg(@$src);
    $width = @imagesx($source_image);
    $height = @imagesy($source_image);
  }

    if($ext == 'png')
  {
    $source_image = @imagecreatefrompng(@$src);
    $width = @imagesx($source_image);
    $height = @imagesy($source_image);
  }

   /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desired_height = floor($height * ($desired_width / $width));
    /* create a new, "virtual" image */
    $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
    /* copy source image at a resized size */
    imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
    /* create the physical thumbnail image to its destination */
    imagejpeg($virtual_image, $dest);
}
 
 


}