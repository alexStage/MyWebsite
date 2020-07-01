<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use App\Photo;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Redirect;
use Validator;
use App\Jobs\UploadAlbum;

class AlbumController extends Controller
{

    //upload photos
    public function upload($request, $album){
        if($request->hasFile('photos')){ 
            foreach ($request->photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $name = now().$photoName;
                $filename = $photo->move(public_path('storage/photos/'),$name);
                    Photo::create([
                        'name' => $name,
                        'album_id' =>$album->id,
                        ]);
            }
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::with('user','photos','comments')->simplePaginate(8);
  	    return view('albums.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
        
            'title' => 'required',
            'content' => 'required',
            'photos' => 'required',

        ]);
        
        $album = Album::create([
            'title'=> $request->title,
            'content'=>$request->content,
            'user_id'=> Auth::user()->id,
        ]);

        $this->upload($request, $album);

        //if($request->hasFile('photos')){
        //    foreach($request->photos as $photo){
        //        $photos = $request->photos; 
        //       $this->dispatch(new UploadAlbum($photos));
        //    }
        //}
           
        Session::flash('success', 'Album créé avec succès'); 
        return redirect(route('albums.index'));
      
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $album = Album::with('user','photos')->find($id);
        $comments = Comment::with('user')->where('album_id', '=', $id);
        return view('albums.show',compact('album', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::with('user','photos')->find($id);
        return view('albums.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'photos' => 'required',
        ]);

        if($request->hasFile('photos')){ 
            foreach ($request->photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $name = now().$photoName;
                $filename = $photo->move(public_path('storage/photos/'),$name);
                    Photo::create([
                        'name' => $name,
                        'album_id' =>$id,
                        ]);
            }
        } 

        Session::flash('success', 'photos ajoutées');
        return redirect(route('albums.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        $photos = DB::table('photos')->where('album_id', $album->id);
        $photos->delete();
        Session::flash('success', 'album supprimé');
        return redirect(route('albums.index'));
    }

    public function comment(Album $album, Request $request){
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'album_id' => $album->id,
            'content' => $request->content,
        ]);

        return redirect(route('albums.index'));
    }
}
