<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page2;
use Illuminate\Support\Facades\Validator;
use Response;
use File;
//hit user info SSO lihat buat API yang diperbolehkan

class Page2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page2 = Page2::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($page2),
            'data' => $page2,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
       //
    }

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
        $page2 = Page2::find($id);
        return $page2;
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
    public function store(Request $request)
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
    public function getDetail($id)
    {
        $page2 = Page2::find($id);
        if ($page2) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $page2,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => '',
            ], 400);
        }
    }

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

                $oldFile = Page2::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $fileName);
                $image1 = public_path() . '/uploads/' . $fileName;   
            }

             //image2
             if ($request->image3 != null) {
                $file = $request->file('image2');

                $oldFile = Page2::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $fileName);
                $image2 = public_path() . '/uploads/' . $fileName;   
            }

             //image3
             if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Page2::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page2/image3/', $fileName);
                $image3 = public_path() . '/uploads/page2/image3/' . $fileName;   
            }
           
            $page2 = Page2::find($id);
            $page2->title = $title ? $title : $page2->title;
            $page2->desc = $desc ? $desc : $page2->desc;
            $page2->image1 = $image1 ? $image1 : $page2->image1;
            $page2->image2 = $image2 ? $image2 : $page2->image2;
            $page2->image3 = $image3 ? $image3 : $page2->image3;
            $page2->save();

            if ($page2) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $page2,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $page2,
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

    public function soft_delete($id)
    {
         
        $page2 = Page2::find($id);
        $page2->delete();

        if ($page2) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus Data.',
                
                'data' => $page2,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan tidak Data.',
                'data' => '',
            ], 400);
        }
    }

    public function restore($id)
    {
        $page2 = Page2::onlyTrashed()->where('id', $id);
        $page2->restore();
        $page2 = Page2::find($id);
        if ($page2) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengembalikan pelatihan terhapus.',
                
                'data' => $page2,
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
