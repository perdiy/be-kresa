<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $work = Work::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($work),
            'data' => $work,
        ], 200);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
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
            $image = $request->image;
            $image1 = $request->image1;
            $image2 = $request->image2;
            $image3 = $request->image3;
            $image4 = $request->image4;
            $image5 = $request->image5;

            //if there img here
            if ($request->image != null) {
                $file = $request->file('image');

                $oldFile = Work::where('id', $id)->value('image');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image/', $fileName);
                $image = public_path() . '/uploads/work/image/' . $fileName;

               
            }

            // image1
            if ($request->image1 != null) {
                $file = $request->file('image1');

                $oldFile = Work::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image1/', $fileName);
                $image1 = public_path() . '/uploads/work/image1/' . $fileName;
            }

            // image2
            if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = Work::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image2/', $fileName);
                $image2 = public_path() . '/uploads/work/image2/' . $fileName;
            }
            // image3
            if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Work::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image3/', $fileName);
                $image3 = public_path() . '/uploads/work/image3/' . $fileName;
            }
            // image4
            if ($request->image4 != null) {
                $file = $request->file('image4');

                $oldFile = Work::where('id', $id)->value('image4');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image4/', $fileName);
                $image4 = public_path() . '/uploads/work/image4/' . $fileName;
            }
            // image5
            if ($request->image5 != null) {
                $file = $request->file('image5');

                $oldFile = Work::where('id', $id)->value('image5');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/work/image5/', $fileName);
                $image5 = public_path() . '/uploads/work/image5/' . $fileName;
            }
           
            $work = Work::find($id);
            $work->title = $title ? $title : $work->title;
            $work->desc = $desc ? $desc : $work->desc;
            $work->image = $image ? $image : $work->image;
            $work->image1 = $image1 ? $image1 : $work->image1;
            $work->image2 = $image2 ? $image2 : $work->image2;
            $work->image3 = $image3 ? $image3 : $work->image3;
            $work->image4 = $image4 ? $image4 : $work->image4;
            $work->image5 = $image5 ? $image5 : $work->image5;
            $work->save();

            if ($work) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $work,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update .',
                   
                    'data' => $work,
                ], 400);
            }
        }
    }

    public function getDetail($id)
    {
        $work = Work::find($id);
        if ($work) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $work,
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
