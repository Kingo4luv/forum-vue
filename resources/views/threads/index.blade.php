@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               @forelse($threads as $thread)
                   <div class="card mb-3">
                       <div class="card-header">
                           Posted by <a href="{{route('user.profile',['user'=>$thread->user])}}">{{$thread->user->name}}</a>
                           <strong class="float-right">{{$thread->replies_count}} {{str_plural('reply',$thread->replies_count)}}</strong>
                       </div>
                       <div class="card-body">
                           <a href="{{route('thread.show',['channel'=>$thread->channel->slug, 'id'=>$thread->id])}}"><h4>{{$thread->title}}</h4></a>
                           {{$thread->body}}
                       </div>
                   </div>
               @empty
                   <p>There is no relevant results at this time</p>
               @endforelse
            </div>
        </div>
    </div>
@endsection
