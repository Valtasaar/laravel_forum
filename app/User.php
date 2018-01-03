<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * Get the value of the user model route key.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Record that the user has read the given thread.
     *
     * @param $thread
     */
    public function read($thread)
    {
        cache()->forever(
            auth()->user()->visitedThreadCacheKey($thread),
            \Carbon\Carbon::now()
        );
    }

    /**
     * Get the cache key for when a user reads a thread.
     *
     * @param $thread
     * @return string
     */
    public function visitedThreadCacheKey($thread)
    {
        return sprintf('users.%s.visits.%s', $this->id, $thread->id);
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    /*
     *
     * Relationships
     *
     * */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function treads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }


}
