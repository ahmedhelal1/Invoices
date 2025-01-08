    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\Controller;
    use App\Http\Controllers\InvoicesAttachmentsController;
    use App\Http\Controllers\InvoicesController;
    use App\Http\Controllers\SectionsController;
    use App\Http\Controllers\ProductsController;
    use App\Http\Controllers\InvoicesDetailsController;
    use App\Http\Controllers\archiveInvoicesController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\InvoiceReportsController;
    use App\Http\Controllers\CustomerReportController;
    use App\Http\Controllers\HomeController;


    use App\Mail\CreateInvoice;
    use Faker\Guesser\Name;
    use Illuminate\Support\Facades\Mail;



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
    Route::resource('archive', archiveInvoicesController::class);

    Route::get('/section/{id}', [InvoicesController::class, 'getproducts']);
    Route::get('/invoicesDetails/{id}', [InvoicesDetailsController::class, 'edit'])->name('invoicesDetails');
    Route::get('/View_file/{invoices_name}/{file_name}', [InvoicesDetailsController::class, 'openfile'])->name('View_file');
    Route::get('/download/{invoices_name}/{file_name}', [InvoicesDetailsController::class, 'download'])->name('download');
    Route::POST('/delete', [InvoicesDetailsController::class, 'destroy'])->name('delete');
    Route::POST('/invoice_attachments', [InvoicesAttachmentsController::class, 'store'])->name('invoice_attachments');
    Route::get('/invoices/{id}/status', [InvoicesController::class, 'Status_show'])->name('invoice.Status_show');
    Route::post('/invoices/{id}/update_status', [InvoicesController::class, 'Status_update'])->name('Status_update');
    Route::get('/print_invoice/{id}', [InvoicesController::class, 'print_invoice'])->name('print_invoice');
    Route::get('invoice/export/', [InvoicesController::class, 'export'])->name('export');
    Route::get('invoice/report/', [InvoiceReportsController::class, 'index'])->name('report');
    Route::POST('search/invoices', [InvoiceReportsController::class, 'Search_invoices'])->name('Search_invoices');
    Route::get('customer_report/', [CustomerReportController::class, 'index'])->name('customer_report');
    Route::POST('search/customer_report/', [CustomerReportController::class, 'search'])->name('search_customer_report');



    Route::get('/dashboard', [HomeController::class, 'index'])
        ->middleware(['auth', 'verified', 'check_user'])
        ->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [AdminController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [AdminController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [AdminController::class, 'destroy'])->name('profile.destroy');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
    });


    require __DIR__ . '/auth.php';
    Route::get('/{page}', [AdminController::class, 'index']);
