<?php

namespace App\Repositories;

use App\User;
use App\Transection;

class TransectionRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user, $from, $to)
    {
        $result = Transection::select('*')
                ->selectRaw('DATE_FORMAT(transection_date, "%d/%l/%Y")')
                ->where(
                    'user_id', '=', $user->id
                )
                ->whereRaw(
                "(transection_date >= ? AND transection_date <= ?)", 
                [date('Y-m-d', strtotime($from)), date('Y-m-d', strtotime($to))])
                ->orderBy('transection_date')
                ->get();
        return $result;
    }
}
