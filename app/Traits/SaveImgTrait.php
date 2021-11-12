<?php
namespace App\Traits;

trait SaveImgTrait
{
    function saveimg($photo,$name_folder, $name_disk)
    {
       
        
        $photo->storeAs($name_folder, $photo->getClientOriginalName(), $disk = $name_disk);
        $name_photo = $photo->getClientOriginalName();
        return $name_photo;

    }
}