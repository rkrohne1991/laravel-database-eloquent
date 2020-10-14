<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;

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
    $staff = Staff::find(1);
    $staff->photos()->create(['path' => 'example2.jpg']);

    return 'created!';
});

Route::get('/read', function () {
    $staff = Staff::findOrFail(1);

    foreach($staff->photos as $photo) {
        echo $photo;
    }
});

Route::get('/update', function () {
    $staff = Staff::findOrFail(1);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = 'updated_example.jpg';
    $photo->save();

    return 'updated!';
});

Route::get('/delete', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();

    return 'deleted!';
});

Route::get('/assign', function () {
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(2);
    $staff->photos()->save($photo);

    return 'assigned!';
});

Route::get('/un-assign', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(1)->update(['imageable_id'=>'', 'imageable_type'=>'']);

    return 'unassigned!';
});
