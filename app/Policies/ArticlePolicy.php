<?php
namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
// Writers can only update their own drafts
    public function update(User $user, Article $article)
    {
        return $user->id === $article->user_id || $user->role->name === 'Editor';
    }

// Editors and Admins can publish articles
    public function publish(User $user)
    {
        return in_array($user->role->name, ['Editor', 'Admin']);
    }

// Admins can delete any article
    public function delete(User $user, Article $article)
    {
        return $user->role->name === 'Admin';
    }
}
