<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time_line;
use Illuminate\Support\Facades\Validator;
use Response;
use File;

class Time_lineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time_line = Time_line::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($time_line),
            'data' => $time_line,
        ], 200);
    }

    public function getDetail($id)
    {
        $time_line = Time_line::find($id);
        if ($time_line) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail data.',
                
                'data' => $time_line,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
                    $file->move(public_path() . '/uploads/time_line/', $fileName);
                    $image= public_path() . '/uploads/time_line/' . $fileName;
                } 
               
                $time_line = new Produk ;
                $time_line->nama_produk = $request->input('year');
                $time_line->harga_produk = $request->input('month');
                $time_line->harga_produk = $request->input('client');
                $time_line->image = $image;
                $time_line->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    'data' => $time_line,
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
           
            $year = $request->year;
            $month = $request->month;
            $client = $request->client;
            $image = $request->image;

            //if there img here
            if ($request->image != null) {
                $file = $request->file('image');

                $oldFile = Time_line::where('id', $id)->value('image');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/time_line/', $fileName);
                $image = public_path() . '/uploads/time_line/' . $fileName;

               
            }
           
            $time_line = Time_line::find($id);
            $time_line->year = $year ? $year : $time_line->year;
            $time_line->month = $month ? $month : $time_line->month;
            $time_line->client = $client ? $client : $time_line->client;
            $time_line->image = $image ? $image : $time_line->image;
            $time_line->save();

            if ($time_line) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $time_line,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $time_line,
                ], 400);
            }
        }
    }
    public function soft_delete($id)
    {
         
        $time_line = Time_line::find($id);
        $time_line->delete();

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus.',
                'data' => $time_line,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan.',
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
