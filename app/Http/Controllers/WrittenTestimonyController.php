<?php

namespace App\Http\Controllers;

use App\Models\WrittenTestimony;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWrittenTestimonyRequest;
use App\Http\Requests\UpdateWrittenTestimonyRequest;

class WrittenTestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return WrittenTestimony::all();
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
    public function addWrittenTestimony(StoreWrittenTestimonyRequest $request)
    {
        //
        $writtenTestimony = $request->validated();

        // check for authenticated user
        if(!Auth::check())
        {
            return response([
                'error'=>'Not Authenticated',
                'success'=>false
            ],304);
        }
        // add authenticated user to the associative array
        $writtenTestimony+= ['users_id'=>Auth::user()->id, 'created_at'=>now(), 'updated_at'=>now()];

        try{
            $insertTestimony = WrittenTestimony::insert($writtenTestimony);

            return response([
                'success'=>true,
                'response'=>$insertTestimony,
            ],200);
         }catch(\Throwable $e){
           return $e->getMessage();
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(WrittenTestimony $writtenTestimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WrittenTestimony $writtenTestimony)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWrittenTestimonyRequest $request, WrittenTestimony $writtenTestimony)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WrittenTestimony $writtenTestimony)
    {
        //
    }
}
