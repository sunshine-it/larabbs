<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
// 模型监控器类/模型监控器

class ReplyObserver
{
    public function created(Reply $reply)
    {
        $topic = $reply->topic;
        // 话题下每新增一条回复，此处应该 +1
        $topic->increment('reply_count', 1);
        // 通知作者话题被回复了
        $topic->user->notify(new TopicReplied($reply));
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}