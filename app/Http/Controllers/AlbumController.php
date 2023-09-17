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
use Storage;

class AlbumController extends Controller
{   

    //upload les photos de l'album nouvellement créé par la fonction store
    public function upload($request, $album){
        $albumId = $album->id;
        $userId = $request->user()->id;
        $slug = $userId.'/'.$albumId;
        if($request->hasFile('photos')){
            foreach ($request->photos as $photo) {
                $photoName = $photo->getClientOriginalName();
                $slugComplet = 'archive/'.$slug.'/'.$photoName;
                $name = $album->id;
                Storage::disk('archives')->putFileAs($slug, $photo, $photoName);
                $photoModel = Photo::create([
                    'name' => $photoName,
                    'slug' => $slugComplet,
                    'user_id' => $userId,
                ]);

                //réduit le poids de la photo
                $img=\Image::make($photo);
                $img->save(\public_path($slugComplet), 50);
                
                //lie la photo à l'album dans la table album_photo
                $album->photos()->save($photoModel);
            }
        }   
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
           
        Session::flash('success', 'Album créé avec succès'); 
        return redirect(route('albums.index'));
      
    }


    /**
     * affiche la liste des albums
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $albums = Album::with('user','photos','comments')->simplePaginate(8);
  	    return view('albums.index', compact('albums'));
    }

    /**
     * renvoie au formulaire de création d'album
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('albums.create');
    }

    
    /**
     * affiche l'album sélectionné
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
     * affiche le formulaire de modification d'album
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
            'title' => 'required',
            'content' => 'required',
        ]);

        $album = DB::table('albums')
              ->where('id', $request->album)
              ->update([
                  'title' => $request->title,
                  'description' => $request->content,
              ]);

        Session::flash('success', 'description modifiée');
        return redirect(route('albums.index'));
    }

    /**
     * supprimer un album
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {   
        $album->delete();
        $photos_album = DB::table('album_photo')->where('album_id', $album->id);
        $photos_album->delete();
        Session::flash('success', 'album supprimé');
        return redirect('/');
    }

    //crée un commentaire sur un album
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

    public function jscomment(Request $request){
        request()->validate([
            'content' => ['required'],
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'album_id' => 1,
            'content' => $request->content,
        ]);

        return "Votre commentaire a bien été ajouté";

    }


    
}
