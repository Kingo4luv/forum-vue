@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{$thread->replies_count}}" inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <a href="{{route('user.profile',['user'=>$thread->user])}}">{{$thread->user->name}}</a> Posted:
                            {{$thread->title}}
                            @can('update', $thread)
                            <form action="{{route('thread.delete', ['channel'=>$thread->channel, 'thread'=>$thread->id])}}" method="post">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}

                                <button type="submit" class="btn btn-link btn-sm float-right">Delete Thread</button>
                            </form>
                            @endcan
                        </div>

                        <div class="card-body">
                            {{$thread->body}}
                        </div>
                    </div>
                    <replies  @added="repliesCount++" @removed="repliesCount--"></replies>


                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            This thread was published {{$thread->created_at->diffForHumans()}} by
                            <a href="#">{{$thread->user->name}}</a>, and currently has <span v-text="repliesCount"></span> {{str_plural('comment',$thread->replies_count)}}
                            <p>
                                <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>
@endsection
