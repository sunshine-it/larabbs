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

    // 减去话题回复数/使用deleted() 方法来监控『回复删除后』事件：
    // 当回复被删除后，话题的 reply_count 也需要 -1
    public function deleted(Reply $reply)
    {
        if ($reply->topic->reply_count > 0) {
            $reply->topic->decrement('reply_count', 1);
        }
    }
}