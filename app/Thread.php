<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['user', 'channel'];
    protected $appends = ['isSubscribedTo'];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub


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




    public function channel(){
        return $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }

    public function subscribe($userId = null){
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
            ]);

    }

    public function unsubscribe($userId = null){
        $this->subscriptions()
            ->where('user_id', $userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions(){
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute(){
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function addReply($reply){
        $reply = $this->replies()->create($reply);

        //$this->notifySubscribers($reply);

        //event(new ThreadHasNewReply($this,$reply));

        return $reply;
    }

    public function notifySubscribers($reply){
        $this->subscriptions
            ->where('user_id', '!=', $reply->user_id)
            ->each
            ->notify($reply);
    }

}
