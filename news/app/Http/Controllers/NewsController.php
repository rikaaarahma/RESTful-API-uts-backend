<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        # menggunakan model news untuk select data
        $news = News::all();

        if ($news) {
            $data = [
                'message' => "Get all Resource news",
                'data' => $news
            ];

            #mengembalikan data (json) dan kode 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Data is empty',
            ];

            # return pesan erorr dan kode 404
            return response()->json($data, 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    # menambahkan resource news
    # membuat method store
        $validateData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'content' =>  'text|required',
            'url' =>  'required',
            'url_image' => 'required',
            'published_at' => 'datetime|required',
            'category' => 'required',
            'timestamp' => 'timestamp|required',
        ]);

        # menggunakan news dengan eloquent create untuk insert data
        $news = News::create($validateData);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $news
        ];

        # mengembalikan data (json) status code 201
        return response()->json($data, 201);
    }


    /**
     * Display the specified resource.
     */
        # mendapatkan detail resource news
        # membuat method show 
    public function show(string $id)
    {
        $news = News::find($id);

        if ($news) {
            $data = [
                'message' => 'Get Detail Resource',
                'data' => $news
            ];

            #mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    # mengupdate resource patient
    # membuat method update
    public function update(Request $request, $id)
    {
        # mencari data patient yang ingin di update
        $news = News::find($id);

        if ($news) {
            # mendapatkan data request 
            $input = [
                'title' => $request->title ?? $news->name,
                'author' => $request->author ?? $news->author,
                'description' => $request->description ?? $news->description,
                'content' => $request->content ?? $news->content,
                'url' => $request->url ?? $news->url,
                'url_image' => $request->url_image ?? $news->url,
                'published_at' => $request->published_at ?? $news->published_at,
                'category' => $request->category ?? $news->category,
                'timestamp' => $request->timestamp ?? $news->timestamp,
            ];

            # mengupdate data
            $news->update($input);

            $data = [
                'message' => 'Resource is update successfully',
                'data' => $news
            ];

            # mengirimkan respon json dengan statu code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    # mengupdate resource patient
    # membuat method update
    public function destroy($id)
    {
        # mencari data patient yang ingin di update
        $news = News::find($id);

        if ($news) {
            # menghapus data news menggunakan eloquent delete
            $news->delete();

            $data = [
                'message' => "Resource delete id $id is succsesfuly",
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not Found',
            ];

            # mengembalikan data json status code 404
            return response()->json($data, 404);
        }
    }

    # untuk mendapatkan resource berdasarkan name
    # membuat method search 
    public function search($title)
    {
        # mencari data Patients berdasarkan name
        $news = News::where("title",'LIKE', "%$title%")->get();

        if (count($news) > 0) {
            $data = [
                'message' => 'Get Detail Searched Resource',
                'data' => $news
            ];

            #mengembalikan data json status code 200
            return response()->json($data, 200);
        } else {
            $data = [
                'message' => 'Resource not found ',
            ];

            # mengembalikan data json status code 200
            return response()->json($data, 200);
        }
    }

    public function sport()
    {
        $news = News::where("category","sport")->get();

        $data = [
            'message' => 'Get Sport Resource',
            'data' => $news,
        ];

        return response()->json($data, 200);
    }

    public function finance()
    {
        $news = News::where("category","finance")->get();

        $data = [
            'message' => 'Get Finance Resource',
            'data' => $news,
        ];

        return response()->json($data, 200);
    }

    public function automotive()
    {
        $news = News::where("category","automotive")->get();

        $data = [
            'message' => 'Get Automotive Resource',
            'data' => $news,
        ];

        return response()->json($data, 200);
    }

}