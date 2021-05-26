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

                @foreach($activities as $date => $activity)
                    <h3>{{ $date }}</h3>
                    @foreach($activity as $record)
                        @include("profiles.activities.{$record->type}", ['activity' => $record])
                    @endforeach

                @endforeach

{{--                {{$threads->links()}}--}}


            </div>
        </div>
    </div>
@endsection
