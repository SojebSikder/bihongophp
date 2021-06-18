/**
* Login Register Route
*/

Route::get("/login", [App\Controllers\RegisterController::class, 'login']);
Route::get("/register", [App\Controllers\RegisterController::class, 'register']);
Route::get("/logout", [App\Controllers\RegisterController::class, 'logout']);