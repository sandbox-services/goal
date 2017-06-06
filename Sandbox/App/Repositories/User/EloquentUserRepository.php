<?php

namespace Sandbox\Repositories\User;

use Sandbox\Repositories\EloquentRepository;
use Sandbox\User;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository extends EloquentRepository implements UserRepository {

    function __construct(User $model)
    {
        $this->model = $model;
    }

    function add($job)
    {
        if( !isset($job->apiToken) )
            $job->apiToken = $this->uniqueApiToken();

        $user = new User;
        $user->email        =   $job->email;
        $user->password     =   Hash::make($job->password);
        $user->api_token    =   $job->apiToken;

        if($user->save())
            return $user;
    }

    function edit($job)
    {
        $user                   =   User::findOrFail($job->id);

        if( isset($job->email) )
            $user->email        =   $job->email;

        if( isset($job->password) )
            $user->password     =   Hash::make($job->password);

        if( isset($job->apiToken) )
            $user->api_token    =   $job->apiToken;

        if( $user->save() )
            return $user;

    }

    public function delete($job)
    {
        $user   =   User::findOrFail($job->id);

        $user->delete();
        return $user;
    }

    // Generate a unique API key; does not actually *set* it for anyone, only returns it
    public function uniqueApiToken()
    {
        $key = null;
        do
        {
            $key = str_random(60);
        } while( User::where('api_token', $key)->first() );

        return $key;
    }

}