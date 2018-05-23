@component('profile.activities.activity')
    @slot('heading')
        <a href="{{route('thread.show',['channel'=>$activity->subject->favorited->thread->channel->slug, 'id'=>$activity->subject->favorited->thread->id])}}">
        {{$profileUser->name}}
        </a>
        favorited a reply
        {{--<a href="{{route('thread.show',['channel'=>$activity->subject->thread->channel->slug, 'id'=>$activity->subject->thread->id])}}">{{$activity->subject->thread->title}}</a>--}}
    @endslot
    @slot('body')
        {{$activity->subject->favorited->body}}
    @endslot
@endcomponent


