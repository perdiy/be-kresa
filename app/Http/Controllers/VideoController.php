<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($video),
            'data' => $video,
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
        $video = Video::find($id);
        if ($video) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $video,
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
            $title = $request->title;
            $desc = $request->desc;
            $title_section1 = $request->title_section1;
            $desc_section1 = $request->desc_section1;
            $title_section2 = $request->title_section2;
            $desc_section2 = $request->desc_section2;
            $title_section3 = $request->title_section3;
            $desc_section3 = $request->desc_section3;
            $image1 = $request->image1;
            $image2 = $request->image2;
            $image3 = $request->image3;
            $image4 = $request->image4;
            $image5 = $request->image5;
            $imageanimasi = $request->imageanimasi;

            //if there img here
            if ($request->vid != null) {
                $file = $request->file('vid');

                $oldFile = video::where('id', $id)->value('vid');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/', $fileName);
                $vid = public_path() . '/uploads/video/' . $fileName;

               
            }
           //image1
            if ($request->image1 != null) {
                $file = $request->file('image1');

                $oldFile = video::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image1/', $fileName);
                $image1 = public_path() . '/uploads/video/image1/' . $fileName;
            }

            //image2
            if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = video::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image2/', $fileName);
                $image2 = public_path() . '/uploads/video/image2/' . $fileName;
            }
            //image3
            if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = video::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image3/', $fileName);
                $image2 = public_path() . '/uploads/video/image3/' . $fileName;
            }

             //image4
             if ($request->image4 != null) {
                $file = $request->file('image4');

                $oldFile = video::where('id', $id)->value('image4');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image4/', $fileName);
                $image4 = public_path() . '/uploads/video/image4/' . $fileName;
            }

             //image5
             if ($request->image4 != null) {
                $file = $request->file('image5');

                $oldFile = video::where('id', $id)->value('image5');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/image5/', $fileName);
                $image5 = public_path() . '/uploads/video/image5/' . $fileName;
            }

             //imageanimasi
             if ($request->image4 != null) {
                $file = $request->file('imageanimasi');

                $oldFile = video::where('id', $id)->value('imageanimasi');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/video/imageanimasi/', $fileName);
                $imageanimasi = public_path() . '/uploads/video/imageanimasi/' . $fileName;
            }

            $video = Video::find($id);
            $video->title = $title ? $title : $video->title;
            $video->desc = $desc ? $desc : $video->desc;
            $video->title_section1 = $title_section1 ? $title_section1 : $video->title_section1;
            $video->desc_section1 = $desc_section1 ? $desc_section1 : $video->desc_section1;
            $video->title_section2 = $title_section2 ? $title_section2 : $video->title_section2;
            $video->desc_section2 = $desc_section2 ? $desc_section2 : $video->desc_section2;
            $video->title_section3 = $title_section3 ? $title_section3 : $video->title_section3;
            $video->desc_section3 = $desc_section3 ? $desc_section3 : $video->desc_section3;
            $video->image1 = $image1 ? $image1 : $video->image1;
            $video->image2 = $image2 ? $image2 : $video->image2;
            $video->image3 = $image3 ? $image3 : $video->image3;
            $video->image4 = $image3 ? $image4 : $video->image4;
            $video->image5 = $image3 ? $image5 : $video->image5;
            $video->imageanimasi = $image3 ? $imageanimasi : $video->imageanimasi;
            $video->save();

            if ($video) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $video,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $video,
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
