<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\MediaAsset;
use Illuminate\Http\Request;

class MediaAssetController extends Controller
{

    private function processUpload(Request $request, MediaAsset $media)
    {
        if($request->hasFile('file') === false){
            throw new \Exception('no image uploaded');
        }
        $filename = microtime().'.png';
        $path = "/img/media/$filename";
        $image = \Image::make($request->file('file'))
            ->widen(1000, function ($constraint){
                $constraint->upsize();
            })
            ->encode('png')
            ->save(public_path().$path);

        $media->image = $path;
    }
    private function formatForRedactor(MediaAsset $media)
    {
        return [
            'thumb'=>$media->image,
            'url'=>\URL::to('/').$media->image,
            'title'=>'',
            'id'=>$media->id,
        ];
    }

    public function getImages(Request $request)
    {
        $client = $request->client;

        $media = $client
            ? MediaAsset::where('deleted',0)
                ->where('client_id',$client)
                ->orderBy('created_at','DESC')
                ->get()
            : MediaAsset::where('deleted',0)
                ->orderBy('created_at','DESC')
                ->get();

        return $media->map(function($m){
            return $this->formatForRedactor($m);
        });
    }
    
    public function upload(Request $request)
    {
        $media = new MediaAsset();
        $this->processUpload($request, $media);
        $media->client_id = $request->client;
        $media->save();
        return $this->formatForRedactor($media);
    }

    public function uploadFile(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = microtime().'.'.$file->getClientOriginalExtension();
            $path = "/files/$filename";
            \Storage::disk('public')->put($path, $file);
        }
        return [
            'url'=>\URL::to('/').$path,
             'id'=>$filename
        ];
    }

    public function softDelete($id)
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
}
