<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page1;
use Illuminate\Support\Facades\Validator;
use Response;
use File;
class Page1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page1 = Page1::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($page1),
            'data' => $page1,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
             {
                if ($request->image1 != null) {
                    $file = $request->file('image1');
                    $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/page1/', $fileName);
                    $image1 = public_path() . '/uploads/page1/' . $fileName;
                }

                if ($request->image2 != null) {
                    $file = $request->file('image2');
                    $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/page1/', $fileName);
                    $image2 = public_path() . '/uploads/page1/' . $fileName;
                }

                if ($request->image3 != null) {
                    $file = $request->file('image3');
                    $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/page1/', $fileName);
                    $image3 = public_path() . '/uploads/page1/' . $fileName;
                }
                $page1 = new Page1 ;
                $page1->title = $request->input('title');
                $page1->desc = $request->input('desc');
                $page1->image1 = $image1;
                $page1->image2 = $image2;
                $page1->image3 = $image3;
                $page1->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    
                    'data' => $page1,
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

           
            //image2
            if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = Page1::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page1/image2/', $fileName);
                $image2 = public_path() . '/uploads/page1/image2/' . $fileName; 
            }

            //image3
            if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Page1::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page1/image3/', $fileName);
                $image3 = public_path() . '/uploads/page1/image3/' . $fileName; 
            }
           
            $page1 = Page1::find($id);
            $page1->title = $title ? $title : $page1->title;
            $page1->desc = $desc ? $desc : $page1->desc;
            $page1->image1 = $image1 ? $image1 : $page1->image1;
            $page1->image2 = $image2 ? $image2 : $page1->image2;
            $page1->image3 = $image3 ? $image3 : $page1->image3;
            $page1->save();

            if ($page1) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $page1,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update data.',
                   
                    'data' => $page1,
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
    public function delete($id)
    {
        
        $page1 = Page1::find($id);
        $page1->delete();

        return "data berhasil di hapus";
    }

    public function getDetail($id)
    {
        $page1 = Page1::find($id);
        if ($page1) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail pelatihan.',
                
                'data' => $page1,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan tidak ditemukan.',
                'data' => '',
            ], 400);
        }
    }

}
