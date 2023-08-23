<?php

namespace App\Http\Controllers;

use App\Models\VideoTestimony;
use App\Models\Category;
use App\Http\Requests\StoreVideoTestimoniesRequest;
use App\Http\Requests\UpdateVideoTestimoniesRequest;

class VideoTestimoniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video_testimonies =  new VideoTestimony();
        return $video_testimonies->all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoTestimoniesRequest $request)
    {




        $testimonies = [];
        $testimonies['categories_id'] = $request->categories_id;



       // get video
       $video = $request->video_testimonies;
       $video_extension = $video->extension();
       $video_path = $video->storeAs('storage', time().'.'.$video_extension);


       // save video path
       $testimonies['video_testimonies'] = $video_path;

       // get image
        $image = $request->image;

        $image_extension = $image->extension();
        $path = $image->storeAs('storage', time().'.'.$image_extension);


        // save image path
        $testimonies['image'] = $path;

       try{
        $id  = VideoTestimonies::insertGetId($testimonies);
       $video_testimonies = VideoTestimonies::where('id', '=', $id)->first();


        // get the category the video belongs to
        if($id)
        {
            $cat = VideoTestimonies::find($id)->category;


            return response([
                'video_testimonies'=>  $video_testimonies,
                'url'=> url("/video_/$cat->id"),
            ], 200);
        }

       }catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }


    }

    /**
     * Display the specified resource.
     */
    public function showCategory($videoTestimonies)
    {
        try{
            $vid = VideoTestimonies::find($videoTestimonies);
            return $vid->category;
        }catch(\Throwable $th){
           return response([
            'status'=> 'failed',
            'message'=>$th->getMessage()
           ]);
        }

    }

    public function showVideo($videoTestimonies)
    {
        try{
            $vid = VideoTestimonies::find($videoTestimonies)->first();
            return $vid;
        }catch(\Throwable $th){
           return response([
            'status'=> 'failed',
            'message'=>$th->getMessage()
           ]);
        }

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoTestimonies $videoTestimonies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoTestimoniesRequest $request, VideoTestimonies $videoTestimonies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoTestimonies $videoTestimonies)
    {
        //
    }
}
