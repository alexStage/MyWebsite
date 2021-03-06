<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Storage;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('admin.photos', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('photos')){ 
            $allowedfileExtension=['pdf','jpg','png','docx','jpeg'];
            $files = $request->file('photos');
            foreach($files as $file){
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                //dd($check);
                if($check){
                        foreach ($request->photos as $photo) {
                            $filename = $photo->store('photos');
                            Photo::create([
                                'name' => $filename,
                                'album_id' =>$album->id,
                            ]);
                        }
                } 
            }
        Session::flash('success', 'Album créer avec succès'); 
        return redirect(route('albums.index'));
        }else{
            echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';

        }
    }

    // public function majTablePhoto(){
    //     $files = Storage::disk('archives')->allFiles();
    //     DB::table('photos')->delete();
    //     foreach($files as $file){

    //         $slug = "archive/".$file;
    //         $array = explode("/", $file);
    //         $name = $array[count($array) - 1];
            
    //         DB::table('photos')->updateOrInsert([
    //             'name'=> $name,
    //             'slug'=> $slug,
    //         ]);

    //     }
    //     Session::flash('success', 'Base de données mise à jour');
    //     return Redirect::back();
    // }

    public function majTablePhoto(){
        $files = Storage::disk('archives')->allFiles();
        $photos = Photo::all();

        foreach($photos as $photo){
            $slug = $photo->slug;
            $array = explode("/", $slug);
            array_shift($array);
            $name = implode("/", $array);
            if(Storage::disk('archives')->missing($name)){
                $photo->delete();
            }
        }

        foreach($files as $file){

            $slug = "archive/".$file;
            $array = explode("/", $file);
            $name = $array[count($array) - 1];

            DB::table('photos')->updateOrInsert([
                'name'=> $name,
                'slug'=> $slug,
            ]);

        }

        return redirect(route('admin.photos'));
    }

    public static function isUpToDate(){
        $files = Storage::disk('archives')->allFiles();
        $photos = Photo::all();
        $countMissing= 0;
        $countToDelete= 0;

        foreach($photos as $photo){
            $slug = $photo->slug;
            $array = explode("/", $slug);
            array_shift($array);
            $name = implode("/", $array);
            if(Storage::disk('archives')->missing($name)){
                $countToDelete +=1;
            }
        }

        foreach($files as $file){
            $array = explode("/", $file);
            $name = end($array);
            if(DB::table('photos')->where('name', $name)->doesntExist()){
                $countMissing +=1;
            }
        }

        $array = [
            'missing' => $countMissing,
            'toDelete' => $countToDelete, 
        ];

        return $array;
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        Session::flash('success', 'Photo supprimée'); 
        return Redirect::back();
    }

    public function comment(Photo $photo){
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'photo_id' => $photo->id,
            'content' => $request->content,
        ]);

        return redirect(route('albums.index')); //changer albums.index quand j'aurai créé le photo.index
    }

}
