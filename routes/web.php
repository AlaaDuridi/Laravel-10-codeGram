<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');

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



$user = User::all()->find(20);
    dd($user->name); ##########Main#######################################
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
