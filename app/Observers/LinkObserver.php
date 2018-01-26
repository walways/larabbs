<?php
/**
 * Created by PhpStorm.
 * User: Moore
 * Date: 2018/1/26
 * Time: 12:08
 */

namespace App\Observers;

use App\Models\Link;
use Cache;

class LinkObserver
{
    // 在保持时清空 cache_key 对应的缓存
    public function saved(Link $link)
    {
        Cache::forget($link->cache_key);
    }
}