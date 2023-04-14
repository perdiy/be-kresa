<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video1;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class Video1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video1 = Video1::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($video1),
            'data' => $video1,
        ], 200);
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
    public function getDetail($id)
    {
        $video1 = Video1::find($id);
        if ($video1) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $video1,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => '',
            ], 400);
        }
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
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Kiriman data tidak sesuai.',
                'data' => $validator->errors(),
            ], 401);
        } else {
            $link = $request->link;
            $thumb = $request->thumb;
            $title = $request->title;
            $desc = $request->desc;
            $title_section1 = $request->title_section1;
            $desc_section1 = $request->desc_section1;
            $title_section2 = $request->title_section2;
            $desc_section2 = $request->desc_section2;
            $title_section3 = $request->title_section3;
            $desc_section3 = $request->desc_section3;
            $imageanimasi = $request->imageanimasi;

            
          

            $video1 = Video1::find($id);
            $video1->link = $link ? $link : $video1->link;
            $video1->thumb = $thumb ? $thumb : $video1->thumb;
            $video1->title = $title ? $title : $video1->title;
            $video1->desc = $desc ? $desc : $video1->desc;
            $video1->title_section1 = $title_section1 ? $title_section1 : $video1->title_section1;
            $video1->desc_section1 = $desc_section1 ? $desc_section1 : $video1->desc_section1;
            $video1->title_section2 = $title_section2 ? $title_section2 : $video1->title_section2;
            $video1->desc_section2 = $desc_section2 ? $desc_section2 : $video1->desc_section2;
            $video1->title_section3 = $title_section3 ? $title_section3 : $video1->title_section3;
            $video1->desc_section3 = $desc_section3 ? $desc_section3 : $video1->desc_section3;
            $video1->imageanimasi = $imageanimasi ? $imageanimasi : $video1->imageanimasi;
            $video1->save();

            if ($video1) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $video1,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $video1,
                ], 400);
            }
        }
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
