<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Post;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    //**************raw sql queries *******************
    //try dd , dump and die
    //1- fetch all users
    // $users = DB::select('select * from users ');
    //2-insert user into users table
    // $user = DB::insert('insert into users (name, email, password) values (?,?,?)', [
    //     'alaa',
    //     'alaa.duridi7@gmail.com',
    //     '188271020027265'
    // ]);
    //3- update user
    // $user = DB::update('update users set email = ? where id = ?', [
    //     'rahaf.com', 3
    // ]);
    //4- delete a user
    // $user = DB::delete('delete from users where id = ?', [1]);
    //**********query builders *************
    //get specific user
    // $users = DB::table('users')->where('name', 'alaa')->get();
    //get all users
    // $users = DB::table('users')->get(); ##################Main#######################
    // $users = DB::table('users')->where('name', 'Hiba')->first();
    // $users = DB::table('users')->where('id', 5)->first();
    // the line ubove this line is the same as the one below it
    // $users = DB::table('users')->find(5); /// SO POWERFULL
    //insert a user
    // $user = DB::table('users')->insert([
    //     'name' => 'Hiba',
    //     'email' => 'Hiba@s',
    //     'password' => ''
    // ]);
    //update a user
    // $user = DB::table('users')->where('id', 5)->update([
    //     'email' => 'Hiba@Salamah'
    // ]); will return 1 or 0
    //insert another user
    // $user = DB::table('users')->insert([
    //     'name' => 'Romaysa',
    //     'email' => 'Romy.Sis',
    //     'password' => ''
    // ]); // will return true or false
    //delete a user
    // $user = DB::table('users')->where('name', 'Romaysa')->delete();
    //get all users using models
    // $users = User::all();
    //create a user using models :
    //   $user=    User::create(['name'=>'ruba','email'=>'ruba@sheikh' , 'password'=>'hiba']);
    /**
     * Bring the posts of the user with id no 4,
     */
    // $posts = User::find(4)->posts;
    /**
     *Bring the phone of the user with id = 4
     */
    // dd($user->name) ;
    // $user = User::find(4)->phone;
    /**
     * Bring the phone-number of the user with name Alaa
     */
    // $user = User::where('name', 'Alaa')->first()->phone->number;
    // dd($user); ##########Main#######################################
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar');
    Route::post('/profile/avatar/ai', [AvatarController::class, 'generate'])->name('profile.avatar.ai');
});

require __DIR__ . '/auth.php';

/**
 * Usage of OpenAI facade, this is not best practice, we should use controller, but just for trying things out,we can tyy create a route with a closure
 */
Route::get('/openai', function () {
    /**
    NOTE: TASK NUMBER ONE
     */
    // $result = OpenAI::chat()->create([
    //     'model' => 'gpt-3.5-turbo',
    //     'messages' => [
    //         ['role' => 'user', 'content' => 'Hello!'],
    //     ],
    // ]);

    // echo $result->choices[0]->message->content;

    /**
    NOTE: TASK NUMBER TWO
     */
    // $result = OpenAI::completions()->create([
    //     'model' => 'text-davinci-003',
    //     'prompt' => "PHP is"
    // ]);
    // echo $result['choices'][0]['text'];

    /**
    NOTE: TASK NUMBER THREE :use the AI to generate an image
     */
    // $result = OpenAI::images()->create([
    //     'prompt' => "a PC screen viewing a cup of tea in front of a PC screen with a laptop, and the laptop is viewing a youtube tutorial to learn Laravel, and the PC screen viewing the vscode window",
    //     'n' => 2,
    //     'size' => "256x256"
    // ]);
    // dd($result);

    /**
    NOTE: TASK NUMBER FOUR :use the AI to generate an image
     */

    $result = OpenAI::images()->create([
        'prompt' => 'create an avatar for user with name ' . auth()->user()->name,
        'n' => 1,
        'size' => '256x256'
    ]);
    return response(['url' => $result->data[0]->url]);
});

//NOTE:these two methods are for Socialite

Route::post('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('login.github');

Route::get('/auth/callback', function () {
    //TODO: get the user from the github
    $user = Socialite::driver('github')->user();
    //TODO: check if the user available with this email or not, if not available, then generate or update the email and password

    // User::updateOrCreate(
    //     ['email' => $user->email],
    //     ['name' => $user->name, 'password' => 'password']
    // );
    $user = User::firstOrCreate(
        ['email' => $user->email],
        ['name' => $user->name, 'password' => 'password']
    );
    // dd($user->email);
    // $user->token
    Auth::login($user);

    return redirect('/dashboard');
});
