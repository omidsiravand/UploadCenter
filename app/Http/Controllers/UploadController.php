<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UploadCenterRequest;
use App\Models\Upload;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class UploadController extends Controller
{
 
    public function index()
    {
        $uploads= Upload::paginate('5');
        return view('upload.index',compact('uploads'));
        
    }

  
    public function create()
    {
        return view('upload.create');
    }

  
    public function store(UploadCenterRequest $request)
    {
        $file= $request->file('image');
        $image="";
        if(!empty($file)){
            $image=sha1(time()).".". $file->getClientOriginalExtension();
            $defaultpath='images/upload';
            $customepath=$request->input('custom_path');
            $destinationPath=!empty($customepath)?$customepath:$defaultpath;

            if(!file_exists($destinationPath)){
                 mkdir($destinationPath, 0777, true); 
            }
            $file->move($destinationPath,$image);
        }
       Upload::create([
        'image'=>$image,
       ]);
       $imageUrl = asset('images/upload/'.$image);
       if($request->wantsJson()){
        return response()->json([
            'message'=>'عکس با موفقیت اپلود شد',
            'imageurl'=>$imageUrl
        ],201);
       }
       session()->flash('create','فایل شما با موفیقت بارگذاری شد');
       return back();

    }

  
    public function destroy(string $id)
    {
        $deleteimage=Upload::findOrFail($id)->image;
        if(file_exists('images/upload/'.$deleteimage)){
            unlink('images/upload/'.$deleteimage);
        }

        Upload::destroy($id);
        session()->flash('delete','عکس با موفقیت حذف شد');
        return back();
    }
}
