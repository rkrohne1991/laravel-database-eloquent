<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $user = User::findOrFail(1);
    $role = new Role(['name'=>'Administrator']);
    $user->roles()->save($role);
    return 'created!';
});

Route::get('/read', function () {
    $user = User::findOrFail(1);

    foreach ($user->roles as $role) {
        echo $role;
    }
});

Route::get('/update', function () {
    $user = User::findOrFail(1);

    if ($user->has('roles')) {

        foreach($user->roles as $role) {
            if($role->name == 'Administrator') {
                $role->name = strtolower($role->name);
                $role->save();

                return 'updated!';
            }
        }
    }
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);

    foreach ($user->roles as $role) {
        $role->whereId(6)->delete();
    }
    return 'deleted!';
});

Route::get('/attach', function () {
    $user = User::findOrFail(1);
    $user->roles()->attach(4);

    return 'attached!';
});

Route::get('/detach', function () {
    $user = User::findOrFail(1);
    $user->roles()->detach(5);

    return 'detached!';
});

Route::get('/sync', function () {
    $user = User::findOrFail(1);
    $user->roles()->sync([1,5]);

    return 'synced!';
});
