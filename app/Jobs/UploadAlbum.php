<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;


class UploadAlbum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $photos;

    public function __construct(Array $photos)
    {
        $this->photos = $photos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->photos as $photo) {
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
