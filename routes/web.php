    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\InvoicesController;
    use App\Http\Controllers\SectionsController;
    use App\Http\Controllers\ProductsController;
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
        return view('auth.login');
    });

    Route::resource('invoices', InvoicesController::class);
    Route::resource('sections', SectionsController::class);
    Route::resource('products', ProductsController::class);
    Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);



    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminController::class, 'destroy'])->name('profile.destroy');
    });



    require __DIR__ . '/auth.php';
    Route::get('/{page}', [AdminController::class, 'index']);
