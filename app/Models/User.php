<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles; // 加载 HasRoles

class User extends Authenticatable
{
    // 获取到扩展包提供的所有权限和角色的操作方法
    use HasRoles;

    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // 在用户模型中新增与话题模型的关联
    public function topics()
    {
        // 用户与话题中间的关系是 一对多 的关系
        return $this->hasMany(Topic::class);
    }
    // 优化授权策略
    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }
    // 一个用户可以拥有多条评论，新增 replies() 方法
    public function replies()
    {
        // 一对多
        return $this->hasMany(Reply::class);
    }

    // 清除未读消息标示
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

}
