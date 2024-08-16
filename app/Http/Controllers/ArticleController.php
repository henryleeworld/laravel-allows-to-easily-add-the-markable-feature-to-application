<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Maize\Markable\Models\Like;

class ArticleController extends Controller
{
    public function like() 
    {
        $article = Article::findOrFail(1);
        $user = User::findOrFail(1);
        echo __('User :user_id liked article :article_id.', ['user_id' => $user->id, 'article_id' => $article->id]) . PHP_EOL;
        Like::add($article, $user);
        if (Like::has($article, $user)) {
            echo __('Confirm that user :user_id has liked article :article_id.', ['user_id' => $user->id, 'article_id' => $article->id]) . PHP_EOL;
        }
        echo __('User :user_id unliked article :article_id.', ['user_id' => $user->id, 'article_id' => $article->id]) . PHP_EOL;
        Like::remove($article, $user);
        if (!Like::has($article, $user)) {
            echo __('Confirm that user :user_id has not liked article :article_id.', ['user_id' => $user->id, 'article_id' => $article->id]) . PHP_EOL;
        }
        $userSecond = User::findOrFail(2);
        $userThird  = User::findOrFail(3);
        echo __('Users :user_id_1 and :user_id_2 liked article :article_id.', ['user_id_1' => $userSecond->id, 'user_id_2' => $userThird->id, 'article_id' => $article->id]) . PHP_EOL;
        Like::add($article, $userSecond);
        Like::add($article, $userThird);
        echo __('Article :article_id Liked by :total people.', ['article_id' => $article->id, 'total' => Like::count($article)]);
    }
}
