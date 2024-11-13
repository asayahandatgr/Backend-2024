<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all(); // Mengambil semua data berita dari database

        $resource =  [
            'message' => 'Get All Resource', // Pesan umum
            'data' => $news // Data berita yang diambil
        ];
        return response()->json($resource, 200);
        // data empty belum
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Melakukan validasi terhadap data yang diterima
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',            // title harus ada dan bertipe string
            'author' => 'required|string',           // author harus ada dan bertipe string
            'description' => 'required|string',      // description harus ada dan bertipe string
            'content' => 'required|string',          // content harus ada dan bertipe string
            'url' => 'required|url',                 // url harus ada dan harus berformat URL
            'url_image' => 'required',               // url_image harus ada 
            'published_at' => 'required|date',       // published_at harus ada dan berformat tanggal
            'category' => 'required|string',         // category harus ada dan bertipe string
           ]);

           // Jika validasi gagal, kembalikan response dengan error
            if ($validate->fails()) {
                return response()->json([
                    'message' => 'Validation errors',
                    'errors' => $validate->errors(),
                ], 422);
            }
    
            // Menyimpan data berita baru ke dalam database
            $news = News::create($request->all());
    
            // Menyiapkan response yang berisi data yang berhasil disimpan
            $resource = [
                'message' => 'Resource is added successfully!!', // Keberhasilan menambahkan
                'data' => $news, // Data berita yang baru disimpan
            ];
    
            return response()->json($resource, 201); // Mengembalikan response dengan status 201 (Created)
    }

    /**
     * Menampilkan detail berita berdasarkan ID.
     */
    public function show($id)
    {
        $news = News::find($id); // Mencari berita berdasarkan ID

        // Jika berita ditemukan, kembalikan data berita
        if ($news) {
            $resource =  [
                'message' => 'Get Detail Resource', // Pesan sukses
                'data' => $news // Data berita yang ditemukan
            ];
            return response()->json($resource, 200); // Mengembalikan response dengan status 200 (OK)
        } else {
            // Jika berita tidak ditemukan, kembalikan pesan error
            $resource =  [
                'message' => 'Resource not found', // Pesan jika resource tidak ditemukan
            ];
            return response()->json($resource, 404);  // Mengembalikan status 404 (Not Found)
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Resource not found !'], 404);
        }

        $news->update([
            'id' => $id,
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'content' => $request->content,
            'url' => $request->url,
            'url_image' => $request->url_image,
            'published_at' => $request->published_at,
            'category' => $request->category,
        ]);

        $resource = [
            'message' => 'Resource is update succesfully !',
            'data' => $news
        ];
        return response()->json($resource, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'Resource not found !'], 404);
        }

        $news->delete();

        $data = [
            'message' => 'Resource is delete succesfully !',
        ];
        return response()->json($data, 200);
    }


    /**
     * Menampilkan berita yang diurutkan berdasarkan tanggal publikasi terbaru.
     */
    public function search(Request $request)
    {
        // Mengambil query parameter 'title' dari request
        $title = $request->query('title');
    
        // Mencari data berita berdasarkan title yang mirip dengan query
        $resources = News::where('title', 'like', "%{$title}%")->get();
    
        // Mengecek apakah data ditemukan
        if ($resources->isEmpty()) {
            return response()->json([
                'message' => 'Resource not found',  // Pesan jika tidak ditemukan resource
                'data' => [],  // Data kosong
                'status' => 404  
            ], 404);
        }
    
        // Mengembalikan data yang ditemukan dengan status 200
        return response()->json([
            'message' => 'Get searched resource',  // Pesan jika berhasil mendapatkan data
            'data' => $resources,  // Data yang ditemukan berdasarkan pencarian
            'status' => 200 
        ], 200);
    }
    
/**
 * Menampilkan berita dengan kategori 'sport'.
 */
    public function sport()
    {
        // Mengambil data berita dengan kategori 'sport' menggunakan Eloquent where
        $sportArticles = News::where('category', 'sport')->get();
    
        // Mengecek apakah ada data yang ditemukan
        if ($sportArticles->isEmpty()) {
            return response()->json([
                'message' => 'No sport resource found',  // Pesan jika tidak ada artikel kategori 'sport'
                'data' => [],  // Data kosong
                'status' => 404  // Status 404 (Not Found)
            ], 404);
        }
    
        // Mengembalikan data berita kategori 'sport' jika tersedia
        return response()->json([
            'message' => 'Get sport resource',  // Pesan berhasil mendapatkan artikel kategori 'sport'
            'jumlah' => $sportArticles->count(),  // Menampilkan jumlah artikel kategori 'sport'
            'data' => $sportArticles,  // Data berita kategori 'sport'
            'status' => 200  // Status 200 (OK)
        ], 200);
    }
    
/**
 * Menampilkan berita dengan kategori 'finance'.
 */
public function finance()
{
    // Mengambil data berita dengan kategori 'finance' menggunakan Eloquent where
    $financeArticle = News::where('category', 'finance')->get();

    // Memeriksa apakah data tersedia
    if ($financeArticle->isEmpty()) {
        return response()->json([
            'message' => 'No finance resource found', // Pesan jika tidak ada artikel dengan kategori 'finance'
            'data' => [], // Data kosong
            'status' => 404 
        ], 404);
    }

    // Mengembalikan data berita kategori 'finance' jika ada
    return response()->json([
        'message' => 'Get finance resource', // Pesan jika berhasil mendapatkan artikel dengan kategori 'finance'
        'jumlah' => $financeArticle->count(), // Menampilkan jumlah artikel
        'data' => $financeArticle, // Data berita kategori 'finance'
        'status' => 200 
    ], 200);
}


/**
 * Menampilkan berita dengan kategori 'automotive'.
 */
public function automotive()
{
    // Mengambil data berita dengan kategori 'automotive' menggunakan Eloquent where
    $automotiveArticles = News::where('category', 'automotive')->get();

    // Jika tidak ada berita kategori 'automotive' ditemukan
    if ($automotiveArticles->isEmpty()) {
        return response()->json([
            'message' => 'No automotive resource found',  // Pesan jika tidak ada berita kategori 'automotive'
            'data' => [],  // Data kosong
            'status' => 404  
        ], 404);
    }

    // Mengembalikan data berita kategori 'automotive' yang ditemukan
    return response()->json([
        'message' => 'Get automotive resource',  // Pesan berhasil mendapatkan berita kategori 'automotive'
        'jumlah' => $automotiveArticles->count(),  // Menampilkan jumlah berita kategori 'automotive'
        'data' => $automotiveArticles,  // Data berita kategori 'automotive'
        'status' => 200  
    ], 200);
}




}


