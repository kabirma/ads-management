<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    function getImageSize(){
        $imagePath = $this->media;

        if (file_exists($imagePath)) {
            $size = getimagesize($imagePath);
            if(is_array($size) && count($size)){
                $width = $size[0];
                $height = $size[1];
                echo "Image resolution: {$width} x {$height}";
            }else{
                echo "Image not found!";
            }
        } else {
            echo "Image not found!";
        }
    }
}
