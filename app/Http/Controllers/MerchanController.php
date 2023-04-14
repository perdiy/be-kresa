<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchan;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class MerchanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $merchan = Merchan::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($merchan),
            'data' => $merchan,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
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

                $oldFile = Merchan::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/merchan/image1/', $fileName);
                $image1 = public_path() . '/uploads/merchan/image1/' . $fileName;
            }

               //image2
               if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = Merchan::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/merchan/image2/', $fileName);
                $image2 = public_path() . '/uploads/merchan/image2/' . $fileName;
            }

             //image3
             if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Merchan::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/merchan/image3/', $fileName);
                $image3 = public_path() . '/uploads/merchan/image3/' . $fileName;
            }
           
            $merchan = Merchan::find($id);
            $merchan->title = $title ? $title : $merchan->title;
            $merchan->desc = $desc ? $desc : $merchan->desc;
            $merchan->image1 = $image1 ? $image1 : $merchan->image1;
            $merchan->image2 = $image2 ? $image2 : $merchan->image2;
            $merchan->image3 = $image3 ? $image3 : $merchan->image3;
            $merchan->save();

            if ($merchan) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update data.',
                   
                    'data' => $merchan,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update data.',
                   
                    'data' => $merchan,
                ], 400);
            }
        }
    }

    public function delete($id)
    {
         
        $merchan = Merchan::find($id);
        $merchan->delete();

        if ($merchan) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus pelatihan.',
                
                'data' => $merchan,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan tidak ditemukan.',
                'data' => '',
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
