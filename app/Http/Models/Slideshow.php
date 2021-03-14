<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = 'slideshows';

    public function getSlide(){
        return Slideshow::all();
    }

    public function getSlideshowByID($id)
    {
        return Slideshow::find($id);
    }

    public function storeSlideshow($title, $content, $imgSlideshow)
    {
        $slideshow = new Slideshow();
        $slideshow->title = $title;
        $slideshow->content = $content;
        $slideshow->img_slideshow = $imgSlideshow;;
        $slideshow->save();
        return true;
    }

    public function updateSlideshow($id, $title, $content, $imgSlideshow)
    {
        $slideshow = Slideshow::find($id);;
        $slideshow->title = $title;
        $slideshow->content = $content;
        if ($imgSlideshow != null) {
            $slideshow->img_slideshow = $imgSlideshow;
        }
        $slideshow->save();
        return true;
    }

    public function deleteSlidehow($id)
    {
        Slideshow::destroy($id);
    }
}
