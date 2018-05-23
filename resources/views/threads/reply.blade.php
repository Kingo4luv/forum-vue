<reply :attributes="{{$reply}}" inline-template >
    <div id="reply-{{$reply->id}}" class="card mb-3">
        <div class="card-header">
            <a href="{{route('user.profile',['user'=>$reply->user])}}">{{$reply->user->name}}</a> said.... {{$reply->created_at->diffForHumans()}}
            @if(Auth()->check())
                <favorite :reply="{{$reply}}"></favorite>
            @endif
            {{--<form action="{{route('reply.favorite',['reply_id'=>$reply->id])}}" method="post">--}}
                {{--{{csrf_field()}}--}}

                {{--<button class="btn btn-outline-success btn-sm float-right" {{$reply->isFavorited() ? 'disabled' : ''}}>--}}
                    {{--{{$reply->favorites_count}} {{str_plural('Favorite',$reply->favorites_count)}}--}}
                {{--</button>--}}
            {{--</form>--}}
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea name="" id=""  class="form-control" v-model="body" ></textarea>
                </div>
                <button  class="btn btn-outline-success btn-sm float-left mr-3" @click="update">Update</button>
                <button  class="btn btn-outline-info btn-sm" @click="editing=false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>
        @can('update',$reply)
            <div class="card-footer">
                <button  class="btn btn-outline-primary btn-sm float-left mr-3" @click="editing=true">Edit</button>
                <button type="submit" class="btn btn-danger btn-sm" @click="destroy">Delete</button>

            </div>
        @endcan
    </div>
</reply>

