@component('profiles.activities.activity')
    @slot('header')
        <a href="/">
            {{ $profileUser->name }} favorited a reply
        </a>


    @endslot
    @slot('body')
        {{ $activity->subject->favorited->body }}
    @endslot
@endcomponent
