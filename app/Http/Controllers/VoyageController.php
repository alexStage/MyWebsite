<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pays;
use App\Voyage;
use App\Album;
use App\Photos;
use Session;
use App\Pays as PaysModel;
use Illuminate\Support\Facades\DB;

class VoyageController extends Controller
{
    
    public function index(){
        $voyages = Voyage::with('users', 'pays', 'albums')->simplePaginate(8);
        return view('voyages.index', compact('voyages'));
    }


    public function create(){
        $pays = Pays::all()->pluck('title', 'id');
        return view('voyages.create', compact('pays'));
    }

    public function destroy(Voyage $voyage){
        $voyage->delete();
        $voyage->pays()->detach();
        $voyage->users()->detach();
        $albums = $voyage->albums()->get();
        foreach($albums as $album){
            $album->delete();
        }
        Session::flash('success', 'Votre voyage a bien été supprimé');
        return redirect(route('accueil'));
    }

    public function edit(){
        return true;
    }

    public function show($id){
        $voyage = Voyage::with('users','albums', 'pays')->find($id);
        return view('voyages.show',compact('voyage'));
    }

    public function store(Request $request){

        $voyage = Voyage::create([
            'title' => $request->title,
            'description' => $request->description,
            'dateDeDebut' => $request->dateDebut,
            'dateDeFin' => $request->dateFin,
        ]); 
        return $voyage->id;
        
/*        foreach($request->albums as $albumInfos){
            //récupère l'utilisateur
            $userId = $request->user()->id;
            //récupère le pays
            $paysId = $albumInfos['countrieId'];
            $pays = DB::table('pays')->where('identifiant', $paysId)->first();

            //crée l'album
            $album = Album::create([
                'user_id' => $userId,
                'voyage_id' => $voyage->id,
                'pays_id' => $pays->id,
                'title' => $albumInfos['albumTitle'],
                'description' => $albumInfos['albumDescription']
            ]);

            //gère les photos
            $albumId = $album->id;
            $slug = $userId.'/'.$albumId;
           
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
        } */
    }
}
