@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>{{ $profileUser->name }}</h2>
                        <small>Since: {{ $profileUser->created_at->diffForHumans() }}</small>
                    </div>

                </div>

                @foreach($threads as $thread)
                    <div class="card">
                        <div class="card-header">
                            <div class="level">

                                <a href="{{ route('profile', $thread->creator) }}">
                                    {{$thread->creator->name}}
                                </a>posted:
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>

                            </div>

                        </div>
                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                        <div class="card-footer">
                            {{ $thread->created_at->diffForHumans() }}
                        </div>

                    </div>
                @endforeach

                {{$threads->links()}}


            </div>
        </div>
    </div>
@endsection
