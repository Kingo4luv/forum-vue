<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['user', 'channel'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope('replyCount',function ($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
            $thread->replies->each->delete();

        });


    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function addReply($reply){
        return $this->replies()->create($reply);
    }

    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }


}