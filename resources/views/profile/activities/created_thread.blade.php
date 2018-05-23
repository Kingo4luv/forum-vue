@component('profile.activities.activity')
    @slot('heading')
        {{$profileUser->name}} published <a href="{{route('thread.show',['channel'=>$activity->subject->channel->slug, 'id'=>$activity->subject->id])}}">{{$activity->subject->title}}</a>
    @endslot
    @slot('body')
        {{$activity->subject->body}}
    @endslot
@endcomponent



