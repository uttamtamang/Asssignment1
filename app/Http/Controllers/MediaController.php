<?php

namespace App\Http\Controllers;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    //
    protected $image_dir = 'uploads/medias';

    public function uploadFile($file, $dir)
    {
        $file_extension = $file->getClientOriginalExtension();
        $file_name=md5(time()) . '.' . $file_extension;
        $file->move($dir, $file_name);
        return $file_name;
    }

    public function addmedia()
    {
        $req = request();
        $form_req = $req->all();

        $medias = new Media();

        if (request()->hasFile('image')) {
            $file_name = $this->uploadFile(request()->file('image'), $this->image_dir);
            $medias->image = $file_name;
        }

        $medias->company_id= $form_req['company_id'];
        $status=$medias->save();
        // dd($medias);
        return redirect()->to('companies')->withSuccess('New Media had been added!!');

    }

     public function getMedia(){
        // $medias = new Media();
        $medias= DB::table('media')->get();
        return redirect()->to('companies',[
            'medias' => $medias
        ]
            );
    }
}
