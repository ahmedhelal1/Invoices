    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\InvoicesAttachmentsController;
    use App\Http\Controllers\InvoicesController;
    use App\Http\Controllers\SectionsController;
    use App\Http\Controllers\ProductsController;
    use App\Http\Controllers\InvoicesDetailsController;
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
    Route::get('/invoices/paid', [InvoicesController::class, 'paid'])->name('paid');
    Route::get('/invoices/unpaid', [InvoicesController::class, 'unpaid'])->name('unpaid');
    Route::get('/invoices/partiallyPaid', [InvoicesController::class, 'partiallyPaid'])->name('partiallyPaid');
    Route::resource('invoices', InvoicesController::class);
    Route::resource('sections', SectionsController::class);
    Route::resource('products', ProductsController::class);
    Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
    Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit'])->name('invoicesDetails');
    Route::get('/View_file/{invoices_name}/{file_name}', [InvoicesDetailsController::class, 'openfile'])->name('View_file');
    Route::get('/download/{invoices_name}/{file_name}', [InvoicesDetailsController::class, 'download'])->name('download');
    Route::POST('/delete', [InvoicesDetailsController::class, 'destroy'])->name('delete');
    Route::POST('/invoice_attachments', [InvoicesAttachmentsController::class, 'store'])->name('invoice_attachments');
    Route::get('/invoices/{id}/status', [InvoicesController::class, 'Status_show'])->name('invoice.Status_show');
    Route::post('/invoices/{id}/update_status', [InvoicesController::class, 'Status_update'])->name('Status_update');

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
