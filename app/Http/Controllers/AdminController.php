<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Вивести всі новини.
     */
    public function index()
    {
        return view('admin', ['data' => News::orderBy('created_at', 'DESC')->get()]);
    }
    /**
     * Редагування новини.
     */
    public function fetchNews($id)
    {
        $data = News::whereId($id)
            ->with(['news_tags'=>fn($q) => $q->with('tags')])
            ->first();

        $tags = [];
        if($data->news_tags){
            foreach ($data->news_tags as $tag){
                $tags[] = $tag->tags->name;
            }
        }
        return view('admin-update-message', [
            'data' => $data,
            'tags' => implode(', ', $tags)
            ]
        );
    }
}
