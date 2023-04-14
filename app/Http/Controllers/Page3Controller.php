<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page3;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class Page3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page3 = Page3::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($page3),
            'data' => $page3,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
    //     ]);
    //     if ($validator->fails()) {
    //         return Response([
    //             'success' => false,
    //             'message' => 'file yang diperbolehkan .jpeg, .png dan .jpg dengan ukuran maksimum 10MB.',
    //         ], 400);
    //     } else
    //          {
    //             if ($request->image != null) {
    //                 $file = $request->file('image');
    
    //                 $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
    //                 $file->move(public_path() . '/uploads/page3/', $fileName);
    //                 $fileLocation = public_path() . '/uploads/page3/' . $fileName;
    //             } else {
    //                 $fileLocation = public_path() . '/uploads/image_dev.png';
    //             }
    //             // $data = Pelatihan::create(request()->all());
    //             $page3 = new Page3 ;
    //             $page3->title = $request->input('title');
    //             $page3->desc = $request->input('desc');
    //             $page3->image = $fileLocation;
    //             $page3->save();
    
    //             return Response([
    //                 'success' => true,
    //                 'message' => 'Berhasil menambahkan data.',
                    
    //                 'data' => $page3,
    //             ], 201);
    //         }
    // }
    public function getDetail($id)
    {
        $page3 = Page3::find($id);
        if ($page3) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $page3,
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
            $image3 = $request->imageteam;


            //image1
            if ($request->image1 != null) {
                $file = $request->file('image1');

                $oldFile = Page3::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page3/image1/', $fileName);
                $image1 = public_path() . '/uploads/page3/image1/' . $fileName;
            }

            
            //image2
            if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = Page3::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page3/image2/', $fileName);
                $image2 = public_path() . '/uploads/page3/image2/' . $fileName;
            }

            
            //image3
            if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = Page3::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page3/image3/', $fileName);
                $image3 = public_path() . '/uploads/page3/image3/' . $fileName;
            }
           
            //imageteam
            if ($request->image3 != null) {
                $file = $request->file('imageteam');

                $oldFile = Page3::where('id', $id)->value('imageteam');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/page3/imageteam/', $fileName);
                $imageteam = public_path() . '/uploads/page3/imageteam/' . $fileName;
            }
 
            $page3 = Page3::find($id);
            $page3->title = $title ? $title : $page3->title;
            $page3->desc = $desc ? $desc : $page3->desc;
            $page3->title_section1 = $title_section1 ? $title_section1 : $page3->title_section1;
            $page3->desc_section1 = $desc_section1 ? $desc_section1 : $page3->desc_section1;
            $page3->title_section2 = $title_section2 ? $title_section2 : $page3->title_section2;
            $page3->desc_section2 = $desc_section2 ? $desc_section2 : $page3->desc_section2;
            $page3->title_section3 = $title_section3 ? $title_section3 : $page3->title_section3;
            $page3->desc_section3 = $desc_section3 ? $desc_section3 : $page3->desc_section3;
            $page3->image1 = $image1 ? $image1 : $page3->image1;
            $page3->image2 = $image2 ? $image2 : $page3->image2;
            $page3->image3 = $image3 ? $image3 : $page3->image3;
            $page3->imageteam = $imageteam ? $imageteam : $page3->imageteam;
            $page3->save();

            if ($page3) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $page3,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $page3,
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
