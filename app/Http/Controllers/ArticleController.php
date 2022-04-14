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
        echo '使用者 1 對文章 1 按讚。' . PHP_EOL;
        Like::add($article, $user);
        if (Like::has($article, $user)) {
            echo '確認使用者 1 已對文章 1 按讚。' . PHP_EOL;
        }
        echo '使用者 1 對文章 1 取消按讚。' . PHP_EOL;
        Like::remove($article, $user);
        if (!Like::has($article, $user)) {
            echo '確認使用者 1 未對文章 1 按讚。' . PHP_EOL;
        }
        echo '使用者 2 和 3 對文章 1 按讚。' . PHP_EOL;
        $userSecond = User::findOrFail(2);
        $userThird  = User::findOrFail(3);
        Like::add($article, $userSecond);
        Like::add($article, $userThird);
        echo '文章 1 共 ' . Like::count($article) . ' 位按讚。';
    }
}
