<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page4;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class Page4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page4 = Page4::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($page4),
            'data' => $page4,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validator->fails()) {
            return Response([
                'success' => false,
                'message' => 'file yang diperbolehkan .jpeg, .png dan .jpg dengan ukuran maksimum 10MB.',
            ], 400);
        } else
             {
                if ($request->image != null) {
                    $file = $request->file('image');
    
                    $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/page4/', $fileName);
                    $fileLocation = public_path() . '/uploads/page4/' . $fileName;
                } else {
                    $fileLocation = public_path() . '/uploads/image_dev.png';
                }
                // $data = Pelatihan::create(request()->all());
                $page4 = new Page4 ;
                $page4->title = $request->input('title');
                $page4->desc = $request->input('desc');
                $page4->image = $fileLocation;
                $page4->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    
                    'data' => $page4,
                ], 201);
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
            $image1 = $request->image1;
            $image2 = $request->image2;
            $image3 = $request->image3;

            //image1
            if ($request->image1 != null) {
                $file = $request->file('image1');

                $oldFile = Page4::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page4/image1/', $fileName);
                $image1 = public_path() . '/uploads/page4/image1/' . $fileName;
            }
           
             //image2
             if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = Page4::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page4/image2/', $fileName);
                $image2 = public_path() . '/uploads/page4/image2/' . $fileName;
            }

             //image3
             if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Page4::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page4/image3/', $fileName);
                $image3 = public_path() . '/uploads/page4/image3/' . $fileName;
            }
            $page4 = Page4::find($id);
            $page4->title = $title ? $title : $page4->title;
            $page4->desc = $desc ? $desc : $page4->desc;
            $page4->image1 = $image1 ? $image1 : $page4->image1;
            $page4->image2 = $image2 ? $image2 : $page4->image2;
            $page4->image3 = $image3 ? $image3 : $page4->image3;
            $page4->save();

            if ($page4) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $page4,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $page4,
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
    public function getDetail($id)
    {
        $page4 = Page4::find($id);
        if ($page4) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $page4,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => '',
            ], 400);
        }
    }
    public function destroy($id)
    {
        //
    }
}
