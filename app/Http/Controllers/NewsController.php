<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Models\News;
use App\Models\NewsTags;
use App\Models\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Створення новини.
     */
    public function addNews(AdminRequest $request)
    {
        $news = News::create([
            'name'  =>$request->input('name'),
            'text'  =>$request->input('text'),
            'check' =>(bool)$request->input('view')
        ]);

        $this->addTags($news->id, $request->input('tags'));

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
            'text'  =>$request->input('text'),
            'check' =>(bool)$request->input('view')
        ]);

        $this->addTags($news->id, $request->input('tags'));

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
        $news = News::whereId($id)
            ->whereCheck(true)
            ->first();
        $text = $news->text;
        $allTags = NewsTags::with('tags')->get();
        foreach ($allTags as $tag){
            if ($tag->tags && $news->id != $tag->news_id){
                $pattern = "/".$tag->tags->name."/i";
                $text = preg_replace($pattern,
                    '<a href="/news/'.$tag->news_id.'">'.$tag->tags->name.'</a>',
                    $text);
            }
        }
        return view('news', [
            'news' => $news,
            'text' => $text ?? '',
            'prev' => News::where('id', '<', $id)->whereCheck(true)->orderBy('created_at', 'DESC')->first(),
            'next' => News::where('id', '>', $id)->whereCheck(true)->orderBy('created_at', 'DESC')->first(),
        ]);
    }
    /**
     * Додавання тегів до новини.
     */
    public function addTags($news_id, $tags)
    {
        NewsTags::whereNewsId($news_id)->delete();
        if($tags){
            foreach (explode(',', $tags) as $tag){
                $id_tag = Tags::updateOrCreate([
                    'name'=> trim($tag)
                ])->id;

                NewsTags::create([
                    'news_id' => $news_id,
                    'tags_id' => $id_tag
                ]);
            }
        }
    }
}
