<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $articles = Article::with('user', 'category')->latest()->get();
        return view('articles.index', compact('articles'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }


    public function store(CreateArticleRequest $request)
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->status = Auth::user()->role->name === 'writer' ? 'draft' : $request->input('status') ?? 'draft';
        $article->category_id = $request->input('category_id');
        $article->user_id = Auth::id();
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $categories = Category::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(UpdateArticleRequest $request,Article $article)
    {
        $this->authorize('update', $article);
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->category_id = $request->input('category_id');
        if (Auth::user()->role->name !== 'writer') {
            $article->status = $request->input('status') ?? $article->status;
        }
        $article->save();

        return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
    public function publish(Article $article)
    {
        $this->authorize('publish', $article);
        $article->status = 'published';
        $article->save();
        return redirect()->route('articles.index')->with('success', 'Article published successfully.');
    }

}
