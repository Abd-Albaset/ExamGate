<?php

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

if(!function_exists('saveImg')){
    /**
     * @param UploadedFile $file
     * @param $savePath
     * @return false|string
     */
    function saveImg(UploadedFile $file , $savePath)
    {
            $originalName =$file->getClientOriginalName(); //name.extension
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $timestamp = Carbon::now()->format('YmdHis');
            $newFileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $extension; // nameTime.extension
            return $file->storeAs($savePath, $newFileName);
    }
}
