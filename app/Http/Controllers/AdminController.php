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
    public function updateMessage($id)
    {
        return view('admin-update-message', ['data' => News::whereId($id)->first()]);
    }
}
