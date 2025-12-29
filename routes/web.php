<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use App\Models\Place;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExploreController;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => redirect('/fr', 302));

/*
|--------------------------------------------------------------------------
| GLOBAL AUTH POST ROUTES (OBLIGATOIRE)
|--------------------------------------------------------------------------
| Ces routes DOIVENT exister hors locale
| car les vues utilisent route('login.store')
*/
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| LOCALIZED ROUTES (PAGES UNIQUEMENT)
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localizationRedirect',
        'localeViewPath',
    ],
], function () {

    /*
    |--------------------------------------------------------------------------
    | Home
    |--------------------------------------------------------------------------
    */
    Route::get('/', fn () => view('pages.index'))->name('home');

    /*
    |--------------------------------------------------------------------------
    | Auth pages
    |--------------------------------------------------------------------------
    */
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'))->name('register');
    Route::get('/forgot-password', fn () => view('auth.forgot-password'))->name('password.request');
    Route::get('/reset-password/{token}', fn ($token)=>view('auth.reset-password', ['token' => $token]))->name('password.reset');

    /*
    |--------------------------------------------------------------------------
    | Dashboard (slugs localisés)
    |--------------------------------------------------------------------------
    */
    Route::get('/tableau-de-bord', fn () => view('pages.dashboard.index'));
    Route::get('/dashboard', fn () => view('pages.dashboard.index'));
    Route::get('/armaturenbrett', fn () => view('pages.dashboard.index'));
    Route::get('/tablero', fn () => view('pages.dashboard.index'));
    Route::get('/لوحة-القيادة', fn () => view('pages.dashboard.index'));
    Route::get('/仪表板', fn () => view('pages.dashboard.index'));
    Route::get('/cruscotto', fn () => view('pages.dashboard.index'));
    Route::get('/painel', fn () => view('pages.dashboard.index'));
    Route::get('/панель', fn () => view('pages.dashboard.index'));
    Route::get('/डैशबोर्ड', fn () => view('pages.dashboard.index'));

    /*
    |--------------------------------------------------------------------------
    | Explore
    |--------------------------------------------------------------------------
    */
    Route::get('/explorer', [ExploreController::class, 'index'])->name('fr.explore');
    Route::get('/explore', [ExploreController::class, 'index'])->name('en.explore');
    Route::get('/erkunden', [ExploreController::class, 'index'])->name('de.explore');
    Route::get('/explorar', [ExploreController::class, 'index'])->name('es.explore');
    Route::get('/استكشاف', [ExploreController::class, 'index'])->name('ar.explore');
    Route::get('/探索', [ExploreController::class, 'index'])->name('zh.explore');
    Route::get('/esplora', [ExploreController::class, 'index'])->name('it.explore');
    Route::get('/explorar-pt', [ExploreController::class, 'index'])->name('pt.explore');
    Route::get('/исследовать', [ExploreController::class, 'index'])->name('ru.explore');
    Route::get('/अन्वेषण', [ExploreController::class, 'index'])->name('hi.explore');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('/profil', fn () => view('pages.profile.index'));
    Route::get('/profile', fn () => view('pages.profile.index'));
    Route::get('/perfil', fn () => view('pages.profile.index'));
    Route::get('/الملف-الشخصي', fn () => view('pages.profile.index'));
    Route::get('/个人资料', fn () => view('pages.profile.index'));
    Route::get('/profilo', fn () => view('pages.profile.index'));
    Route::get('/perfil-pt', fn () => view('pages.profile.index'));
    Route::get('/профиль', fn () => view('pages.profile.index'));
    Route::get('/प्रोफ़ाइल', fn () => view('pages.profile.index'));

    /*
    |--------------------------------------------------------------------------
    | Places
    |--------------------------------------------------------------------------
    */
    Route::get('/places/{place}', function ($place) {
        $model = Place::where('id', $place)
            ->orWhereJsonContains('slug', $place)
            ->firstOrFail();

        return view('pages.places.[place]', [
            'place' => $model,
        ]);
    })->name('places.show');

});
