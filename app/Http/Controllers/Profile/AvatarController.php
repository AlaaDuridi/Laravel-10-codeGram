<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Auth;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        //store the avatar
        // $path = $request->file('avatar')->store('public/avatars');
        $path = $request->file('avatar')->store('avatars', 'public');
        $request->user()->update(['avatar' => $path]);
        // dd($path);
        /**
         *  $modifiedPath = str_replace('/', '\\', $path);
         */
        // dd($modifiedPath);
        //get the authenticated user
        /**
         * if(auth()->check())
         *$user = auth()->user();
         */
        // $authenticated_user = $request->user();
        // dd($authenticated_user);
        //change the avatar of the authenticated user
        /**
         *  $authenticated_user->update(['avatar' => storage_path('app\\' . "$modifiedPath")]);
         */

        /**
         * we don't need this path any more
         *  $new_path = storage_path('app' . "/$path");
         */

        // dd($new_path);

        // $authenticated_user->update(['avatar' => $new_path]);
        // $authenticated_user->update(['avatar' => $path]);
        // the error is becaus the mass assignment
        // dd(auth()->user()); // will not changed, bcz the user is cached
        /**
         * after we add avater to $fillable attributes, it will be changed successfully
         */
        // return 'hello';
        // dd($request->all()); // will print the token

        // return response()->redirectTo(route('profile.edit'));
        // return back()->with('message', 'a vatar is changed'); //  true
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
