@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="page-header">
                    <h1>
                        {{$profileUser->name}}
                        <small>Since {{$profileUser->created_at->diffForHumans()}}</small>
                    </h1>
                    <hr>
                </div>
                @forelse($activities as $date => $activity)
                    <h3 class="page-header">{{$date}}</h3>
                    @foreach($activity as $record)
                        @if (view()->exists("profile.activities.{$record->type}"))
                            @include("profile.activities.{$record->type}", ['activity'=>$record])
                        @endif
                    @endforeach
                 @empty
                    <p class="text-center">There is no activity for this user</p>
                @endforelse
                {{--{{$threads->links()}}--}}
            </div>
        </div>
    </div>

@endsection