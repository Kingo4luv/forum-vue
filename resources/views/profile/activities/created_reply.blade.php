@component('profile.activities.activity')
    @slot('heading')
        {{$profileUser->name}} replied to <a href="{{route('thread.show',['channel'=>$activity->subject->thread->channel->slug, 'id'=>$activity->subject->thread->id])}}">{{$activity->subject->thread->title}}</a>
    @endslot
    @slot('body')
        {{$activity->subject->body}}
    @endslot
@endcomponent


