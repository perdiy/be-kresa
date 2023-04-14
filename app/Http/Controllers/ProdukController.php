<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Validator;
use Response;
use File;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return response([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'total_data' => count($produk),
            'data' => $produk,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
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
                    $file->move(public_path() . '/uploads/produk/', $fileName);
                    $fileLocation = public_path() . '/uploads/produk/' . $fileName;
                } else {
                    $fileLocation = public_path() . '/uploads/image_dev.png';
                }
                // $data = Pelatihan::create(request()->all());
                $produk = new Produk ;
                $produk->nama_produk = $request->input('nama_produk');
                $produk->harga_produk = $request->input('harga_produk');
                $produk->image = $fileLocation;
                $produk->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    
                    'data' => $produk,
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
                    $file->move(public_path() . '/uploads/produk/', $fileName);
                    $fileLocation = public_path() . '/uploads/produk/' . $fileName;
                } else {
                    $fileLocation = public_path() . '/uploads/image_dev.png';
                }
                
                $produk = new Produk ;
                $produk->nama_produk = $request->input('nama_produk');
                $produk->harga_produk = $request->input('harga_produk');
                $produk->image = $fileLocation;
                $produk->save();
    
                return Response([
                    'success' => true,
                    'message' => 'Berhasil menambahkan data.',
                    
                    'data' => $produk,
                ], 201);
            }
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
           
            $nama_produk = $request->nama_produk;
            $harga_produk = $request->harga_produk;
            $image = $request->image;

            //if there img here
            if ($request->image != null) {
                $file = $request->file('image');

                $oldFile = Produk::where('id', $id)->value('image');
                File::delete($oldFile);

                $fileName = time() . md5(time()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/produk', $fileName);
                $image = public_path() . '/uploads/produk/' . $fileName;

               
            }
           
            $produk = Produk::find($id);
            $produk->nama_produk = $nama_produk ? $nama_produk : $produk->nama_produk;
            $produk->harga_produk = $harga_produk ? $harga_produk : $produk->harga_produk;
            $produk->image = $image ? $image : $produk->image;
            $produk->save();

            if ($produk) {
                // $data = Pelatihan::find($id);
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil update.',
                   
                    'data' => $produk,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal update.',
                   
                    'data' => $produk,
                ], 400);
            }
        }
    }
    public function delete($id)
    {
         
        $produk = Produk::find($id);
        $produk->delete();

        if ($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menghapus.',
                
                'data' => $produk,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Pelatihan tidak ditemukan.',
                'data' => $produk,
            ], 400);
        }
    }
    public function getDetail($id)
    {
        $produk = Produk::find($id);
        if ($produk) {
        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data.',
            'data' => $produk,
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
