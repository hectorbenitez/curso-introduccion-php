<?php

namespace App\Traits;


trait HasDefaultImage
{
    public function getImage($altText) {
        if (!$this->image) {
            return "https://ui-avatars.com/api/?name=$altText&size=160";
        }

        return $this->image;
    }
}