@extends('templates.default')
@section('content')
    <div class="row">
        <div class="col-lg-5">
            @include('user.partials.userblock')
            <hr>
            @if(!$statuses->count())
                <p>{{$user->getFirstNameOrUsername()}} hasn't posted anything yet.</p>
            @else
                @foreach($statuses as $status)
                    <div class="media">
                        <a href="{{route('profile.index',['username'=> $status->user->username])}}" class="pull-left">
                            <img src="{{$status->user->getAvatarUrl()}}" alt="{{$status->user->getNameOrUsername()}}"
                                 class="media-object">
                        </a>

                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{route('profile.index',['username'=> $status->user->username])}}">{{$status->user->getNameOrUsername()}}</a>
                            </h4>

                            <p>{{$status->body}}</p>
                            <ul class="list-inline">
                                <li>{{$status->created_at->diffForHumans()}}</li>
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{route('status.like',['statusId'=> $status->id])}}">Like</a></li>
                                @endif
                                <li>{{$status->likes->count()}} {{str_plural('like', $status->likes->count())}}</li>
                            </ul>
                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a href="{{route('profile.index',['username'=> $reply->user->username])}}"
                                       class="pull-left">
                                        <img src="{{$reply->user->getAvatarUrl()}}" alt="" class="media-object">
                                    </a>

                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <a href="{{route('profile.index',['username'=> $reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a>
                                        </h5>

                                        <p>{{$reply->body}}</p>
                                        <ul class="list-inline">
                                            <li>{{$reply->created_at->diffForHumans()}}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li>
                                                    <a href="{{route('status.like',['statusId'=> $reply->id])}}">Like</a>
                                                </li>
                                            @endif
                                            <li>{{$reply->likes->count()}} {{str_plural('like', $reply->likes->count())}}</li>
                                        </ul>
                                    </div>
                                </div>

                            @endforeach
                            @if($authUserIsFriend || Auth::user()->id === $status->user->id)
                                <form role="form" action="{{route('status.reply',['statusId'=>$status->id])}}"
                                      method="post">
                                    <div class="form-group{{$errors->has("reply-{$status->id}") ? ' has-error' : ''}}">
                                    <textarea class="form-control" name="reply-{{$status->id}}"
                                              placeholder="Reply to this status"
                                              rows="2"></textarea>
                                        @if($errors->has("reply-{$status->id}"))
                                            <span class="help-block">{{$errors->first("reply-{$status->id}")}}</span>
                                        @endif
                                    </div>
                                    <input type="submit" value="Reply" class="btn btn-defualt btn-sm" name="">
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-lg-4 col-lg-offset-3">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{$user->getNameOrUsername()}} to accept your request.</p>
            @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a href="{{route('friend.accept', ['username'=>$user->username])}}" class="btn btn-primary">Accept
                    friend</a>
            @elseif(Auth::user()->isFriendsWith($user))
                <p>You and {{$user->getNameOrUsername()}} are friends</p>

                {{Form::open(['url'=>route('friends.delete',['username'=> $user->username]), 'class'=>'form-vertical', 'role'=>'form'])}}

                {{--                {{Form::open(['route'=> 'friends.delete',['username'=> $user->username],'method'=>'post'])}}--}}
                <input type="submit" value="Delete friend" class="btn btn-primary">
                {{Form::close()}}

                {{--<form role="form" action="{{route('friends.delete',['username'=>$user->username])}}" method="post">--}}
                {{--<input type="submit" value="Delete friend" class="btn btn-primary">--}}
                {{--<input type="hidden" name="_token" value="{{Session::token()}}">--}}

                {{csrf_field()}}
                {{--</form>--}}

            @elseif(Auth::user()->id !== $user->id )
                <a href="{{route('friends.add', ['username'=>$user->username])}}" class="btn btn-primary">Add as
                    friend</a>
            @endif
            <h4>{{$user->getFirstNameOrUsername()}}'s friends.</h4>
            @if(!$user->friends()->count())
                <p>{{$user->getNameOrUsername()}} has no friends.</p>
            @else
                @foreach($user->friends() as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop