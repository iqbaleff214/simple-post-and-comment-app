<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(Request $request): View
    {
        return \view('dashboard', [
            'filters' => $request->all('search', 'order', 'filter', 'mine'),
            'posts' => Post::with(['author', 'comments', 'tag'])->filter($request->only('search', 'order', 'filter', 'mine'))
                ->paginate(15)
                ->withQueryString(),
            'tags' => Tag::all(),
        ]);
    }
}
