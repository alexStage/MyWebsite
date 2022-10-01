<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Etiquette;
use App\Album;
use App\Voyage;
use App\Pays as PaysModel;
use App\User;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        //affecte les variables
        $countrieID = $request->input('countrieID');
        $countrieTitle = $request->input('countrieTitle');
        $albumTitle = $request->input('albumTitle');
        $albumDescription = $request->input('albumDescription');
        $userId = $request->user()->id;
        $voyageId = $request->input('voyageId');
        $allowedfileExtension=['jpg','png','jpeg', 'JPG', 'JPEG', 'PNG'];

        //récupère le pays, le voyage et l'utilisateur
        $pays = PaysModel::where('identifiant', '=' ,$countrieID)->first();
        $voyage = Voyage::where('id', '=' ,$voyageId)->first();
        $user = User::where('id', '=' ,$userId)->first();

        //associations
        $voyage->pays()->save($pays);
        $voyage->users()->save($user);

        //crée le nouvel album
        $album = Album::create([
            'title' => $albumTitle,
            'description' => $albumDescription,
            'user_id' => $userId,
            'pays_id' => $pays->id,
            'voyage_id' => $voyageId
        ]);

        $albumId = $album->id;
        $slug = $userId.'/'.$albumId;
        foreach ($request->files as $photo) {
            foreach($photo as $photal){
            $photoName = $photal->getClientOriginalName();
            $extension = $photal->getClientOriginalExtension();
            $slugComplet = 'archive/'.$slug.'/'.$photoName;
            $check=in_array($extension,$allowedfileExtension);
            if($check){
                Storage::disk('archives')->putFileAs($slug, $photal, $photoName);
                $photoModel = Photo::create([
                    'pays_id' => $pays->id,
                    'name' => $photoName,
                    'slug' => $slugComplet,
                    'user_id' => $userId,
                    'album_id' => $albumId,
                ]);
    
                //réduit le poids de la photo
                $img=\Image::make($photal);
                $img->save(\public_path($slugComplet), 50);
                }
            }
        } 

        //renvoie les pays visités lors de ce voyage
        $pays = $voyage->pays()->get();
        return $pays;
    }

    public function search(){
        $etiquettes = Etiquette::all();
        //$array =[];
        //foreach($etiquettes as $etiquette){
            //$count = $etiquette->has('photos')->count();
            //$count = Photo::where(function ($query) use($etiquette) {
             //   $query->whereHas('etiquettes', function ($subquery) use($etiquette) {
            //        $subquery->where('etiquette_id', $etiquette);
            //    });
            //})->count();
            //array_push($array,[$etiquette ,$count]);
        //}
        return view('search.photos', compact('etiquettes'));
    }

    public function searchByTag(Request $request){
        $etiquettes = $request->etiquettes;
        /* $photos = Photo::whereHas('etiquettes', function($q) use($etiquettes) {
                $q->whereIn('etiquette_id', $etiquettes);
        })->select('slug')->get(); */

        $photos = Photo::where(function ($query) use($etiquettes) {
            foreach($etiquettes as $etiquette){
            $query->whereHas('etiquettes', function ($subquery) use($etiquette) {
                $subquery->where('etiquette_id', $etiquette);
            });
        }
        })->select('slug')->get();

        return $photos;
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

    public function supprPhoto(Request $request){
        //$photo = substr($request->photos,8);
        //Storage::disk('archives')->delete($photo);
        //return "bite";
        $photo = Photo::where('slug', $request->photos)->get();
        $photo->albums()->detach();
        $photo->etiquettes()->detach();
        $photo->user()->detach();
        $photo->comments()->detach();
        $photo->delete();
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
