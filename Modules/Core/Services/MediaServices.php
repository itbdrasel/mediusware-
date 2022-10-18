<?php

namespace Modules\Core\Services;

use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Storage;
use Modules\Core\Facades\Auth;


class MediaServices{

    public function __construct(){

    }

    /***
     * Check whether the path is valid or not
     * Null path assume as the root.
     **/
    public function isPath($path)
    {
        if($path) return Storage::exists($path); // true or false
        elseif($path === null) return true; // assume the root
        else return false;

    }


    /***
     * Check whether the user is authorized to access the directory
     * @param String $path - requested path
     *
     * @return Boolean.
     **/
    public function verifyPath($path)
    {
        $userBasePath[0] =0;
        if($path) $userBasePath = explode('/', urldecode($path));
        $user = Auth::getUser();
        $profileDir = $user->directory;
        $role = $user->roles->first();
        if ($role->active_directory == 1 && ($profileDir != $userBasePath[0]) || ($role->active_directory == 1 && empty($profileDir))){
            return false;
        }else{
            return true;
        }
    }



    /***
     * sanitise directory name
     **/
    public function cleanName($fileName, $fileExt): string
    {
       return  Str::slug(pathinfo($fileName, PATHINFO_FILENAME)).'.'.$fileExt;
    }


    /***
     * create folder directory
     **/
    public function createFolder($folderName)
    {
        if( !Storage::exists($folderName) ){
            $makeDir = Storage::makeDirectory($folderName);

            if( !$makeDir ){
                throw new Exception('Directory not created for '.$folderName.' name.');
            }
        }else{
            throw new Exception('The directory '.$folderName.' is already exist.');
        }
        return $makeDir;
    }


    public function copyFile(){
        //
    }

    //
    public function moveFile(){

    }

    /***
     * Delete file or directory
     **/
    public function delete($path, $name){
        //dd($namePath);
        $namePath = $path.$name;
        if( Storage::exists($namePath) ){

            if(is_file(Storage::path($namePath))) {

                //for image file delete from temp first
                if($this->isImage($namePath))
                    $extension  = pathinfo(Storage::url($namePath), PATHINFO_EXTENSION);
                    $filename   = pathinfo(Storage::url($namePath), PATHINFO_FILENAME);
                    $temFile    = $path.'.tmp/'.base64_encode($filename).'.'.$extension;
                    Storage::delete($temFile);
                    $delete = Storage::delete($namePath);

            }else $delete = Storage::deleteDirectory( $namePath);

            if( !$delete ) throw new Exception('This item '.$namePath.' can not be deleted.');
        }else{
            throw new Exception('The directory '.$namePath.' is not exist.');
        }
        return $delete;
    }




    /***
     * Rename file or directory
     **/
    public function rename($newName, $oldName, $path){

        if( Storage::exists($path.$oldName) ){

            if(is_file(Storage::path($path.$oldName))){
                $extension = pathinfo($path.$oldName, PATHINFO_EXTENSION);
                $filename   = pathinfo(Storage::url($oldName), PATHINFO_FILENAME);
                $reName = Storage::move($path.$oldName, $path.$newName.'.'.$extension);
                //manage thumbnail
                if($this->isImage($path.$newName.'.'.$extension)){
                    $temFile = $path.'.tmp/'.base64_encode($filename).'.'.$extension;
                    Storage::delete($temFile);
                    $this->generateThumbnail($path.$newName.'.'.$extension, $path,$path.'.tmp/', 80, 50);
                }

            }else{
                $reName = Storage::move($path.$oldName, $path.$newName);
            }

            if( !$reName ){
                throw new Exception('Directory not created for '.$path.$newName.' name.');
            }
        }else{
            throw new Exception('The directory '.$path.$oldName.' is not exist.');
        }
        return $reName;
    }


    /***
     * Media Manager Breadcrumb
     **/
    public function breadcrumb($path, $baseUrl):string
    {
        $newPath = '';
        $folders = [];

        if($path) $folders = array_filter(explode('/', $path), 'strlen');

        $breadcrumb = "<li><a style='text-decoration: none!important;' href='".url($baseUrl)."'><span class='fa fa-home'></span>  </a> </a></li>";
        $counter = 1;
        foreach($folders as $dir){

           if($counter == count($folders) ){
            $newPath .= $dir;
            $breadcrumb .= "<li> <li> <i class=\"fa fa-angle-double-right\"></i> ".$dir."</li>";
           }else{
            $newPath .= $dir.'/';
            $breadcrumb .= "<li> <i class=\"fa fa-angle-double-right\"></i> <a href='".url($baseUrl)."?path=".urlencode($newPath)."'>  ".$dir."</a> </li>";
           }
           $counter++;
        }

        return $breadcrumb = "<ul>".$breadcrumb."</ul>";
    }

    /* * *
    * isImage() - check the file is image or not.
    * @param filepath.
    * @return Boolean
    */

    public function isImage($namePath){

        $mimeType = mime_content_type(Storage::path($namePath));

        if(substr($mimeType, 0, 5) === 'image') return true;
        else return false;
    }


    /* * *
     * generateThumbnail()
     * @param $sourcFile with file path and name
     * @param $desPath without file name
     */

    public function generateThumbnail($sourcFile, $path, $desPath, $width, $height, $quality = ''){

        $pathInfo = pathinfo($sourcFile);
        $quality = $quality ? $quality : 100;
        if($desPath == $path.'.tmp/'){
            //tmp not exist, create one.
            if(!Storage::exists($desPath)) Storage::makeDirectory($desPath);
            $fileName = base64_encode($pathInfo['filename']).'.'.$pathInfo['extension'];
        }else $fileName = $pathInfo['filename'].'-'.$width.'x'.$height.'.'.$pathInfo['extension'];

        if($this->isImage($sourcFile)) {

            $imageData = Image::make(Storage::path($sourcFile))->resize($width, $height);
            $imageData->save(Storage::path($desPath.$fileName), $quality);
        }
    }


     /* * *
     * removeThumbnail()
     * @param $sourcFile with file path and name
     * @param $dir without file name
     */

    public function removeThumbnail($filePath,$path, $dir){

        //$pathInfo = pathinfo($filePath);

        if($dir == $path.'.tmp/') $filePath = $path.'.tmp/'.base64_encode($filePath);
        else $filePath = $dir.$filePath;

        //if($this->isImage($filePath)) {
            Storage::delete($filePath);
        //}
    }




}
