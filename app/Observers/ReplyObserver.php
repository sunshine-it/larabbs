<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored
// 模型监控器类

class ReplyObserver
{
    public function created(Reply $reply)
    {
        // 话题下每新增一条回复，此处应该 +1
        $reply->topic->increment('reply_count', 1);
    }

    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }
}