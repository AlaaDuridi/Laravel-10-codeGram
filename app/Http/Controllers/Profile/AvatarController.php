<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarByAI;
use App\Http\Requests\UpdateAvatarRequest;
use Auth;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use OpenAI\Laravel\Facades\OpenAI as OpenAI;
use Storage;
use Str;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {


        //TODO:store the avatar
        // $path = $request->file('avatar')->store('public/avatars');
        // $path = $request->file('avatar')->store('avatars', 'public'); ############## this works perfectly but we need to use Storage facade
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
        // dd($path);
        //TODO: delete the older one
        if ($old_avatar = $request->user()->avatar) {
            // dd($old_avatar);
            Storage::disk('public')->delete($old_avatar);
        }
        //TODO: update the db
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
        //TODO: redirect to the route of /profile named profile.edit
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }


    public function  generate(UpdateAvatarByAI $request)
    {
        /**
          NOTE: the function file_get_content recieve a file, and get thhe content of it, gie it a url for example, and it will extract the image
         */

        //TODO: generate the image from ai

        $result = OpenAI::images()->create([
            'prompt' => 'create an avatar for user with name ' . auth()->user()->name,
            'n' => 1,
            'size' => '256x256'
        ]);
        $url = $result->data[0]->url;

        $content = file_get_contents($url);

        // dd($content);
        /**
          NOTE: we need to pass this content to the storage
          when you use the put() method and supply it with a content, you have to provide it the file name also
         */

        $file_name = Str::random(25);
        //TODO:store the avatar
        Storage::disk('public')->put("avatars/$file_name.jpeg", $content);
        //TODO: delete the older one
        if ($old_avatar = $request->user()->avatar) {
            // dd($old_avatar);
            Storage::disk('public')->delete($old_avatar);
        }
        //TODO: update the db
        $request->user()->update(['avatar' => "avatars/$file_name.jpeg"]);
        //TODO: redirect to the route of /profile named profile.edit
        return redirect(route('profile.edit'))->with('message', 'Avatar is changed by AI');

        //NOTE: 4 operations are common between the two functions, so we need to do refactoring to the code
    }
}
