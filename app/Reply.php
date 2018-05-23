<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Thread;
use App\Favorite;

class Reply extends Model
{
    use RecordsActivity;

    protected $guarded = [];

    protected $with = ['user', 'favorites'];
    protected $appends = ['favoritesCount','isFavorited'];

    protected static function bootFavoritable(){
        static::deleting(function($model){
           $model->favorites->each->delete();
        });
    }

    public function thread(){
        return $this->belongsTo(Thread::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function favorites(){
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite(){
        $attributes = ['user_id' => auth()->id()];

        if(!$this->favorites()->where($attributes)->exists()){
            return $this->favorites()->create($attributes);
        }

    }

    public function unfavorite(){
        $attributes = ['user_id' => auth()->id()];
        $this->favorites()->where($attributes)->get()->each->delete();

    }

    public function isFavorited(){
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }

    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }


}
