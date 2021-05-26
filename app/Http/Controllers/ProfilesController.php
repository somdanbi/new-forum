<?php

namespace App\Http\Controllers;

use App\User;

class ProfilesController extends Controller
{

    public function show(User $user)
    {
        $activities = $this->getActivity($user);

        return view('profiles.show', [
            'profileUser' => $user,
            'activities'  => $activities
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    protected function getActivity(User $user)
    {
        $activities = $user->activity()
            ->latest()->with('subject')->take(25)
            ->get()->groupBy(function ($activity)
            {
                return $activity->created_at->format('Y-m-d');
            });
        return $activities;
    }

}
