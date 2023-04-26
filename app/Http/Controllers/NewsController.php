<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use function Psy\debug;

class NewsController extends Controller
{
    /**
     * Створення новини.
     */
    public function addNews(AdminRequest $request)
    {
        $news = News::create([
            'name'  =>$request->input('name'),
            'tags'  =>$request->input('tags'),
            'text'  =>$request->input('text'),
            'check' => (bool)$request->input('view')
        ]);
        Log::debug($request->input('view'));
        if($request->file('image')){
            $fileName = $this->uploadImage($request->file('image'), $news->id);
            $news->update([
                'image'=> '/'.$news->id.'/'.$fileName
            ]);
        }
        return redirect()->route('admin')->with('success', 'Запис додано');
    }
    /**
     * Оновлення новини.
     */
    public function updateNews(Request $request, $id)
    {
        $news = News::whereId($id)->first();
        $news->update([
            'name'  =>$request->input('name'),
            'tags'  =>$request->input('tags'),
            'text'  =>$request->input('text'),
            'check' =>(bool)$request->input('view')
        ]);
        if($request->file('image')){
            $fileName = $this->uploadImage($request->file('image'), $news->id);
            $news->update([
                'image'=> '/'.$news->id.'/'.$fileName
            ]);
        }
        return redirect()->route('admin')->with('success', 'Запис оновлено');
    }
    /**
     * Додавання картинки.
     */
    public function uploadImage($image, $folder)
    {
        $fileName = $image->getClientOriginalName();
        $image->move(public_path('uploads').'/'.$folder.'/', $fileName);
        return $fileName;
    }
    /**
     * Видалення новини.
     */
    public function deleteNews($id)
    {
        News::whereId($id)->delete();
        return redirect()->route('admin')->with('success', 'Запис видалено');
    }
    /**
     * Вивсести всі новини з Пагінацією.
     */
    public function fetchNews()
    {
        return view('home', [
            'news'=> News::whereCheck(true)->orderBy('created_at', 'DESC')->simplePaginate(10)
        ]);
    }
    /**
     * Вивести актуальну Новину по її id.
     */
    public function fetchNewsForId($id)
    {
        return view('news', [
            'news'=> News::whereId($id)->whereCheck(true)->first(),
            'prev'=> News::where('id', '<', $id)->whereCheck(true)->orderBy('created_at', 'DESC')->first(),
            'next'=> News::where('id', '>', $id)->whereCheck(true)->orderBy('created_at', 'DESC')->first()
        ]);
    }
}
