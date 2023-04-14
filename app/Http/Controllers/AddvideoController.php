<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addvideo;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class AddvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addvideo = Addvideo::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($addvideo),
            'data' => $addvideo,
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
                    $file->move(public_path() . '/uploads/addvideo/', $fileName);
                    $image= public_path() . '/uploads/addvideo/' . $fileName;
                } 
              
                $addvideo = new Addvideo ;
                $addvideo->chanel = $request->input('chanel');
                $addvideo->id_video = $request->input('id_video');
                $addvideo->image = $image;
                $addvideo->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    
                    'data' => $addvideo,
                ], 201);
            }
    }

    public function getDetail($id)
    {
        $addvideo = Addvideo::find($id);
        if ($addvideo) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                'data' => $addvideo,
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
           
            $chanel = $request->chanel;
            $id_video = $request->id_video;
            $image = $request->image;

            //if there img here
            if ($request->image != null) {
                $file = $request->file('image');

                $oldFile = Page2::where('id', $id)->value('image');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/addvideo/', $fileName);
                $image = public_path() . '/uploads/addvideo/' . $fileName;

               
            }
           
            $addvideo = Addvideo::find($id);
            $addvideo->chanel = $chanel ? $chanel : $addvideo->chanel;
            $addvideo->id_video = $id_video ? $id_video : $addvideo->id_video;
            $addvideo->image = $image ? $image : $addvideo->image;
            $addvideo->save();

            if ($page2) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $addvideo,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $addvideo,
                ], 400);
            }
        }
    
    }

    public function delete($id)
    {
         
        $addvideo = Addvideo::find($id);
        $addvideo->delete();

        if ($addvideo) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus Data.',
                'data' => $addvideo,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => ' tidak ada Data.',
                'data' => $addvideo,
            ], 400);
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
