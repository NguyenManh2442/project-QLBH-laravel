<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Throwable;

class SlideShowController extends Controller
{
    protected $slideshow;

    public function __construct(Slideshow $slideshow)
    {
        $this->slideshow = $slideshow;
    }

    // func showSlideshowManager
    public function showSlideshowManager()
    {
        $slideshow = $this->slideshow->getSlide();
        return view('slideshow.show_slideshow', compact('slideshow'));
    }

    // func createSlideshow
    public function createSlideshow() {
        return view('slideshow.form_slideshow');
    }

    // func storeSlideshow
    public function storeSlideshow(Request $request) {
        $fileImg = $request->image;
        $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
        $fileImg->move('img', $fileName);

        $title = $request->title;
        $content = $request->content;
        $imgSlideshow = $fileName;

        try {
                $this->slideshow->storeSlideshow($title, $content, $imgSlideshow);
        } catch (Throwable $exception) {
            flash('Thêm mới slideshow thất bại!')->error();
            return redirect()->route('slideshow.slideshowManagement');
        }
        flash('Thêm mới slideshow thành công!')->success();
        return redirect()->route('slideshow.slideshowManagement');
    }

    // func editSlideshow
    public function editSlideshow($id)
    {
        $slideshow = $this->slideshow->getSlideshowByID($id);
        return view('slideshow.form_slideshow', compact('slideshow'));
    }

    // func updateSlideshow
    public function updateSlideshow($id, Request $request){
        if ($request->hasFile('image')) {
            $fileImg = $request->image;
            $fileName =time() . "_" . rand(0,9999999) . "_" . md5(rand(0,9999999)) . $fileImg->getClientOriginalName();
            $fileImg->move('img', $fileName);
        } else {
            $fileName = null;
        }
            $title = $request->title;
            $content = $request->content;
            $imgSlideshow = $fileName;

        try {
            $this->slideshow->updateSlideshow($id, $title, $content, $imgSlideshow);
        } catch (Throwable $exception) {
            flash('Update slideshow thất bại!')->error();
            return redirect()->route('slideshow.slideshowManagement');
        }
        flash('Update slideshow thành công!')->success();
        return redirect()->route('slideshow.slideshowManagement');
    }

    // func deleteSlideshow
    public function deleteSlideshow($id) {
        try {
            $this->slideshow->deleteSlidehow($id);
        } catch (Throwable $exception) {
            flash('Xóa thất bại!')->error();
            return redirect()->route('slideshow.slideshowManagement');
        }
        flash('Xóa thành công!')->success();
        return redirect()->route('slideshow.slideshowManagement');
    }
}
