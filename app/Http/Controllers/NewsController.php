<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NewsController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = News::with('categories','author')->latest()->paginate(15);
        return view('news.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        if ($request->hasFile('cover_image')) {
        $data['cover_image_path'] = $request->file('cover_image')->store('news','public');
        }
        $news = News::create($data);
        if (!empty($data['categories'])) $news->categories()->sync($data['categories']);
        return redirect()->route('news.index')->with('success','تمت إضافة الخبر');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $news->load('categories'); return view('news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $request->validated();
        if ($request->hasFile('cover_image')) {
        if ($news->cover_image_path) Storage::disk('public')->delete($news->cover_image_path);
        $data['cover_image_path'] = $request->file('cover_image')->store('news','public');
        }
        $news->update($data);
        if (isset($data['categories'])) $news->categories()->sync($data['categories']);
        return redirect()->route('news.index')->with('success','تم التحديث');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->authorize('delete', $news); // إن أردت سياسة
        $news->delete();
        return back()->with('success','تم الحذف');
    }
}
