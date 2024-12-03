<?php

use Carbon\Carbon;

if(!function_exists('saveImg')){
    function saveImg($requestFieldName, $savePath)
    {
            $file = request()->file($requestFieldName);
            $originalName =$file->getClientOriginalName(); //name.extension
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $timestamp = Carbon::now()->format('YmdHis');
            $newFileName = pathinfo($originalName, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $extension; // nameTime.extension
            return $path = $file->storeAs($savePath, $newFileName);

    }
}
