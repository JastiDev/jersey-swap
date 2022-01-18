<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Intervention\Image\ImageManagerStatic as Image;
use PHPUnit\Framework\Test;

class ADTestimonials extends Controller
{
    public function index(){
        $testimonials = Testimonials::all();
        return view('admin.testimonials.all',[
            'testimonials' => $testimonials
        ]);
    }
    public function singleView($id){
        $testimonial = Testimonials::findOrfail($id);
        return view('admin.testimonials.single',[
            'testimonial' =>$testimonial
        ]);
    }
    public function postView(){
        return view('admin.testimonials.add');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:100',
            'designation' => 'required|max:100',
            'description' => 'required|max:500',
            'avatar' =>'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageName = null;
        if($request->has('avatar')){
            $imageName = uniqid().$request->avatar->extension();
            $img = Image::make($request->avatar->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/testimonials').'/'.$imageName);
        }
        
        $testimonial = null;
        if($imageName==null){
            $testimonial = Testimonials::create([
                "name" => trim($request->name),
                "designation" => trim($request->designation),
                "description" => $request->description,
            ]);
        }
        else{
            $testimonial = Testimonials::create([
                "name" => trim($request->name),
                "designation" => trim($request->designation),
                "description" => $request->description,
                "avatar" => $imageName
            ]);
        }

        return redirect('admin/testimonials/'.$testimonial->id)->with('success','Testimonial successfully added!');
    }
    public function update(Request $request){
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:100',
            'designation' => 'required|max:100',
            'description' => 'required|max:500',
            'avatar' =>'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageName = null;
        if($request->has('avatar')){
            $imageName = uniqid().$request->avatar->extension();
            $img = Image::make($request->avatar->path());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/testimonials').'/'.$imageName);
        }
        if($imageName==null){
            Testimonials::where("id",$request->id)
            ->update([
                "name" => trim($request->name),
                "designation" => trim($request->designation),
                "description" => $request->description,
            ]);
        }
        else{
            $testimonial_temp = Testimonials::find($request->id);
            @unlink($testimonial_temp->avatar);
            Testimonials::where("id",$request->id)
            ->update([
                "name" => trim($request->name),
                "designation" => trim($request->designation),
                "description" => $request->description,
                "avatar" => $imageName
            ]);
        }
        return back()
               ->with('success','Testimonial has been updated!');
    }
    public function delete(Request $Request,$id){
        $testimonial = Testimonials :: findOrfail($id);
        @unlink($testimonial->avatar);
        $testimonial->delete();
        return redirect('/admin/testimonials')->with('success','Testimonial deleted successfully!');
    }
}
