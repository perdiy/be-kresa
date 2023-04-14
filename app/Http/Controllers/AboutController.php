<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = About::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($about),
            'data' => $about,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = About::find($id);
        return $about;
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
           
            $image = $request->image;
            $image1 = $request->image1;
            $image2 = $request->image2;
            $image3 = $request->image3;
            $title_section1 = $request->title_section1;
            $desc_section1 = $request->desc_section1;
            $title_section2 = $request->title_section2;
            $desc_section2 = $request->desc_section2;
            $title_section3 = $request->title_section3;
            $desc_section3 = $request->desc_section3;
           
            

            
        
           //image
            if ($request->image != null) {
                $file = $request->file('image');

                $oldFile = video::where('id', $id)->value('image');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/about', $fileName);
                $image = public_path() . '/uploads/about/' . $fileName;
            }

              //image1
              if ($request->image1 != null) {
                $file = $request->file('image1');

                $oldFile = video::where('id', $id)->value('image1');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/about/image1/', $fileName);
                $image1 = public_path() . '/uploads/about/image1/' . $fileName;
            }

              //image2
              if ($request->image2 != null) {
                $file = $request->file('image2');

                $oldFile = video::where('id', $id)->value('image2');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/about/image2/', $fileName);
                $image2 = public_path() . '/uploads/about/image2/' . $fileName;
            }

              //image3
              if ($request->image3 != null) {
                $file = $request->file('image3');

                $oldFile = video::where('id', $id)->value('image3');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/about/image3/', $fileName);
                $image3 = public_path() . '/uploads/about/image3/' . $fileName;
            }
            
            $video = About::find($id);
            $about->image = $image ? $image : $about->image;
            $about->title_section1 = $title_section1 ? $title_section1 : $about->title_section1;
            $about->desc_section1 = $desc_section1 ? $desc_section1 : $about->desc_section1;
            $about->title_section2 = $title_section2 ? $title_section2 : $about->title_section2;
            $about->desc_section2 = $desc_section2 ? $desc_section2 : $about->desc_section2;
            $about->title_section3 = $title_section3 ? $title_section3 : $about->title_section3;
            $about->desc_section3 = $desc_section3 ? $desc_section3 : $about->desc_section3;
            $about->save();

            if ($about) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update pelatihan.',
                   
                    'data' => $about,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update pelatihan.',
                   
                    'data' => $about,
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
         
        $about = About::find($id);
        $about->delete();

        if ($about) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus pelatihan.',
                
                'data' => $about,
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
