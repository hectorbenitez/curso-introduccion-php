<?php

namespace App\Traits;


trait HasDefaultImage
{
    public function getImage(string $altText) {
        if (!$this->image) {
            return "https://ui-avatars.com/api/?name=$altText&size=255";
        }
        return $this->image;
    }
}