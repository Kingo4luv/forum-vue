@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create a new Thread</div>
                    <div class="card-body">
                        @if($errors->count() > 0)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{$error}}
                                </div>
                            @endforeach
                        @endif
                        <form action="{{route('thread.store')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="Channel">Please Choose a Channel</label>
                                <select name="channel_id" id="channel_id" class="form-control" required>
                                    <option value="">Please Select</option>
                                @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{(old('channel_id') == $channel->id ? 'selected': '')}}>{{$channel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}" placeholder="Title" required>
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="" cols="30" rows="10" class="form-control" required>{{old('body')}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Publish</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
