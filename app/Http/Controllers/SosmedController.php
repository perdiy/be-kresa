<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sosmed;
use Illuminate\Support\Facades\Validator;
use Response;
use File;
class SosmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sosmed = Sosmed::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($sosmed),
            'data' => $sosmed,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        $sosmed = new Sosmed ;
        $sosmed->youtube = $request->youtube;
        $sosmed->instagram = $request->instagram;
        $sosmed->whatsapp = $request->whatsapp;
        $sosmed->email = $request->email;
        $sosmed->save();

        return "Data berhasil masuk";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sosmed = new Sosmed ;
        $sosmed->youtube = $request->youtube;
        $sosmed->instagram = $request->instagram;
        $sosmed->whatsapp = $request->whatsapp;
        $sosmed->email = $request->email;
        $sosmed->save();

        return $sosmed;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sosmed = Sosmed::find($id);
        return $sosmed;
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
        $youtube = $request->youtube;
        $instagram = $request->instagram;
        $whatsapp = $request->whatsapp;
        $email = $request->email;

        $sosmed = Sosmed::find($id);
        $sosmed->youtube = $request->youtube;
        $sosmed->instagram = $request->instagram;
        $sosmed->whatsapp = $request->whatsapp;
        $sosmed->email = $request->email;
        $sosmed->save();

        if ($sosmed) {
            // $data = Pelatihan::find($id);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil update Data.',
                
                'data' => $sosmed,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal update Data.',
                
                'data' => $sosmed,
            ], 400);
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
        $sosmed = Sosmed::find($id);
        if ($sosmed) {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'data' => $sosmed,
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Pelatihan tidak ditemukan.',
            'data' => '',
        ], 400);
    }
    }


    public function restore($id)
    {
        $sosmed = Sosmed::onlyTrashed()->where('id', $id);
        $sosmed->restore();
        $sosmed = Sosmed::find($id);
        if ($sosmed) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengembalikan pelatihan terhapus.',
                'total_data' => count($data),
                'data' => $sosmed,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan tidak ditemukan.',
                'data' => '',
            ], 400);
        }
    }

    public function soft_delete($id)
    {
         
        $sosmed = Sosmed::find($id);
        $sosmed->delete();

        if ($sosmed) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus pelatihan.',
                
                'data' => $sosmed,
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
