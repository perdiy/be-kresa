<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video5;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class Video5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video5 = Video5::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($video5),
            'data' => $video5,
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
        $video5 = Video5::find($id);
        if ($video5) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $video5,
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

            
           //image1
            if ($request->thumb != null) {
                $file = $request->file('thumb');
                $oldFile = video5::where('id', $id)->value('thumb');
                File::delete($oldFile);
                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image1/', $fileName);
                $thumb = public_path() . '/uploads/video/image1/' . $fileName;
            }

             

             //imageanimasi
             if ($request->imageanimasi != null) {
                $file = $request->file('imageanimasi');

                $oldFile = video5::where('id', $id)->value('imageanimasi');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/imageanimasi/', $fileName);
                $imageanimasi = public_path() . '/uploads/video/imageanimasi/' . $fileName;
            }

            $video5 = Video5::find($id);
            $video5->link = $link ? $link : $video5->link;
            $video5->thumb = $thumb ? $thumb : $video5->thumb;
            $video5->title = $title ? $title : $video5->title;
            $video5->desc = $desc ? $desc : $video5->desc;
            $video5->title_section1 = $title_section1 ? $title_section1 : $video5->title_section1;
            $video5->desc_section1 = $desc_section1 ? $desc_section1 : $video5->desc_section1;
            $video5->title_section2 = $title_section2 ? $title_section2 : $video5->title_section2;
            $video5->desc_section2 = $desc_section2 ? $desc_section2 : $video5->desc_section2;
            $video5->title_section3 = $title_section3 ? $title_section3 : $video5->title_section3;
            $video5->desc_section3 = $desc_section3 ? $desc_section3 : $video5->desc_section3;
            $video5->imageanimasi = $imageanimasi ? $imageanimasi : $video5->imageanimasi;
            $video5->save();

            if ($video5) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $video5,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $video5,
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
