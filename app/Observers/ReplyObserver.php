<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

use App\Notifications\TopicReplied;

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
    public function created(Reply $reply){

        $topic = $reply->topic;
        $topic->increment('reply_count', 1);

        // 如果评论的作者不是话题的作者，才需要通知
        if ( ! $reply->user->isAuthorOf($topic)) {
            $topic->user->notify(new TopicReplied($reply));
        }
    }


    public function deleted(Reply $reply){

        $reply->topic->decrement('reply_count',1);
    }

    public function updating(Reply $reply)
    {
        //
    }
}