<?php

use App\Http\Controllers\admin\AccreditedCABController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AnnouncementController;
use App\Http\Controllers\admin\DomainController;
use App\Http\Controllers\admin\DocumentController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\TrainerController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\Traineradmin\WebmainController;
use App\Http\Controllers\Traineradmin\CourseSchemeController;
use App\Http\Controllers\admin\SchemeController;
use App\Http\Controllers\admin\OtherServiceController;
use App\Http\Controllers\admin\PnacHarasmentController;
use App\Http\Controllers\admin\PnacfootprintController;
use App\Http\Controllers\admin\PnacCommitteeController;
use App\Http\Controllers\admin\NewsletterController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\admin\AnnualReportController;
use App\Http\Controllers\admin\ImpartialityPolicyController;
use App\Http\Controllers\admin\MissionVisionController;
use App\Http\Controllers\admin\PnacRuleController;
use App\Http\Controllers\admin\WorldAccreditationController;
use App\Http\Controllers\admin\EdwardSliderController;
use App\Http\Controllers\admin\FieldController;
use App\Http\Controllers\admin\StructureController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TrainingSchemeController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PnacActController;
use App\Http\Controllers\admin\StakeholderController;
use App\Http\Controllers\admin\aboutAcrediationController;
use App\Http\Controllers\admin\BenefitAccrediationController;
use App\Http\Controllers\admin\DgProfileController;
use App\Http\Controllers\admin\CurrentServiceController;
use App\Http\Controllers\admin\PublicationController;
use App\Http\Controllers\admin\PublicationSchemeController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\AboutControlller;
use App\Http\Controllers\admin\ServicepagesController;
use App\Http\Controllers\admin\CityCountryController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\admin\TrainingCalendarController;
use App\Http\Controllers\admin\TrainingController;
use App\Http\Controllers\admin\InternationalRelationController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\DgmessageController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Traineradmin\TrainerAdminPanelController;
use App\Models\Category;
use App\Models\AccreditedCab;
use App\Models\Service;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\SuperadminController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/active', function () {
//     return view('website.active.page');
// });

// Route::get('qrcode', function () {
  
//     return QrCode::size(300)->generate('A basic example of QR code!');
// });
Route::get('/update-autoload', function () {
    \Artisan::call('dump-autoload');
    return 'Autoload generated';
});

Route::get('/clear-route-cache', function() {
    Artisan::call('route:clear');
    return '<h1>Route cache cleared.</h1>';
});

Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//optimized class loader:
Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

 Route::get('/verify/{id}', [TrainingController::class, 'verify']);
Route::get('/training-admin/login',[TrainerAdminPanelController::class,'training_admin_login']);
Route::post('/training-admin/login',[TrainerAdminPanelController::class,'training_admin_store'])->name('training_admin_store');
Route::middleware('check.traineradminemail')->group(function () {
		
		Route::get('/training-admin',[TrainerAdminPanelController::class,'training_admin']);
		Route::get('/training-admin/logout',[TrainerAdminPanelController::class,'destroy'])->name('training_admin_logout');
	
		Route::get('/training/index', [TrainingController::class, 'TrainingIndex'])->name('training.index');
		Route::post('/training/active/{id}', [TrainingController::class, 'TrainingActive'])->name('training.active');
		Route::get('/create/training', [TrainingController::class, 'createTraining'])->name('create.training');
		Route::post('/store/training', [TrainingController::class, 'storeTraining'])->name('store.training');
		Route::get('/edit/training/{id}', [TrainingController::class, 'editTraining'])->name('edit.training');
		Route::post('/update/training/{id}', [TrainingController::class, 'updateTraining'])->name('update.training');
		Route::get('/delete/training/{id}', [TrainingController::class, 'deleteTraining'])->name('delete.training');
	
		Route::get('/list-participants/{id}', [TrainingController::class, 'participants'])->name('participants');
	
		Route::get('/province/index', [CityCountryController::class, 'CityIndex'])->name('city.index');
        Route::get('/create/province', [CityCountryController::class, 'createCity'])->name('create.city');
        Route::post('/stotre/province', [CityCountryController::class, 'storeCity'])->name('store.city');
        Route::get('/edit/province/{id}', [CityCountryController::class, 'editCity'])->name('edit.city');
        Route::post('/update/province/{id}', [CityCountryController::class, 'updateCity'])->name('update.city');
        Route::get('/delete/province/{id}', [CityCountryController::class, 'deleteCity'])->name('delete.city');
	
		Route::get('/country/index', [CountryController::class, 'CountryIndex'])->name('Country.index');
		Route::get('/create/country', [CountryController::class, 'createCountry'])->name('create.Country');
		Route::post('/store/country', [CountryController::class, 'storeCountry'])->name('store.Country');
		Route::get('/edit/country/{id}', [CountryController::class, 'editCountry'])->name('edit.Country');
		Route::post('/update/country/{id}', [CountryController::class, 'updateCountry'])->name('update.Country');
		Route::get('/delete/country/{id}', [CountryController::class, 'deleteCountry'])->name('delete.Country');
	
		Route::get('/status/index', [StatusController::class, 'StatusIndex'])->name('Status.index');
		Route::get('/create/status', [StatusController::class, 'createStatus'])->name('create.Status');
		Route::post('/store/status', [StatusController::class, 'storeStatus'])->name('store.Status');
		Route::post('/delete/status/{id}', [StatusController::class, 'deleteStatus'])->name('delete.Status');

		Route::get('/scheme/index', [SchemeController::class, 'SchemeIndex'])->name('scheme.index');
        Route::get('/create/scheme', [SchemeController::class, 'createScheme'])->name('create.scheme');
        Route::post('/store/scheme', [SchemeController::class, 'storeScheme'])->name('store.scheme');
        Route::get('/edit/scheme/{id}', [SchemeController::class, 'editScheme'])->name('edit.scheme');
        Route::post('/update/scheme/{id}', [SchemeController::class, 'updateScheme'])->name('update.scheme');
        Route::get('/delete/scheme/{id}', [SchemeController::class, 'deleteScheme'])->name('delete.scheme');
	
		Route::get('/type/index', [TrainingTypeController::class, 'TypesIndex'])->name('Types.index');
		Route::get('/create/type', [TrainingTypeController::class, 'createTypes'])->name('create.Types');
		Route::post('/store/type', [TrainingTypeController::class, 'storeTypes'])->name('store.Types');
		Route::get('/delete/type/{id}', [TrainingTypeController::class, 'deleteTypes'])->name('delete.Types');
	
		Route::resource('announcement',AnnouncementController::class);
	
		Route::resource('trainer',TrainerController::class);
	
		Route::resource('/testimonial',TestimonialController::class);
	
		Route::resource('webmain',WebmainController::class);
	 	Route::get('/delete/webmain/{id}', [TestimonialController::class, 'deleteWebmain'])->name('delete.webmain');
 		Route::get('/delete/testimonial/{id}', [TestimonialController::class, 'deletetestimonial'])->name('delete.testimonial');
 		
 		Route::get('/course-scheme/index', [CourseSchemeController::class, 'courseSchemeIndex'])->name('course.scheme.index');
        Route::get('/create/course-scheme', [CourseSchemeController::class, 'createCourseScheme'])->name('create.course.scheme');
        Route::post('/store/course-scheme', [CourseSchemeController::class, 'storeCourseScheme'])->name('store.course.scheme');
        Route::get('/edit/course-scheme/{id}', [CourseSchemeController::class, 'editCourseScheme'])->name('edit.course.scheme');
        Route::post('/update/course-scheme/{id}', [CourseSchemeController::class, 'updateCourseScheme'])->name('update.course.scheme');
        Route::get('/delete/course-scheme/{id}', [CourseSchemeController::class, 'deleteCourseScheme'])->name('delete.course.scheme');
        
 		Route::get('/sub-scheme/index', [CourseSchemeController::class, 'subSchemeIndex'])->name('sub.scheme.index');
        Route::get('/create/sub-scheme', [CourseSchemeController::class, 'createSubScheme'])->name('create.sub.scheme');
        Route::post('/store/sub-scheme', [CourseSchemeController::class, 'storeSubScheme'])->name('store.sub.scheme');
        Route::get('/edit/sub-scheme/{id}', [CourseSchemeController::class, 'editSubScheme'])->name('edit.sub.scheme');
        Route::post('/update/sub-scheme/{id}', [CourseSchemeController::class, 'updateSubScheme'])->name('update.sub.scheme');
        Route::get('/delete/sub-scheme/{id}', [CourseSchemeController::class, 'deleteSubScheme'])->name('delete.sub.scheme');
	
});
Route::get('/dashboard', function () {
	if(Auth::user()->email == 'trainingadmin@pnac.gov.pk'){
	Auth::logout();
	return redirect('login');
	}
    $services = Category::all();
    $activeCabs = AccreditedCab::where('status', 'active')->count();
    $withdrawCabs = AccreditedCab::where('status', 'withdrawal')->count();
    $suspendedCabs = AccreditedCab::where('status', 'suspended')->count();

    return view('dashboard', compact('services','activeCabs', 'withdrawCabs', 'suspendedCabs'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
	
    Route::get('/create-password', [ProfileController::class, 'createPassword'])->name('create.password');
    Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('update.password');


		Route::get('/search/province/{id}', [CityCountryController::class, 'SearchProvince'])->name('search.province');
		
	
	
		Route::get('/city/index', [CityCountryController::class, 'CountryIndex'])->name('country.index');
        Route::get('/create/city', [CityCountryController::class, 'createCountry'])->name('create.country');
        Route::post('/stotre/city', [CityCountryController::class, 'storeCountry'])->name('store.country');
        Route::get('/edit/city/{id}', [CityCountryController::class, 'editCountry'])->name('edit.country');
        Route::post('/update/city/{id}', [CityCountryController::class, 'updateCountry'])->name('update.country');
        Route::get('/delete/city/{id}', [CityCountryController::class, 'deleteCountry'])->name('delete.country');
	
	

        Route::get('/service/index', [ServiceController::class, 'ServiceIndex'])->name('service.index');
        Route::get('/create/service', [ServiceController::class, 'createService'])->name('create.service');
        Route::post('/stotre/service', [serviceController::class, 'storeService'])->name('store.service');
        Route::get('/edit/service/{id}', [serviceController::class, 'editService'])->name('edit.service');
        Route::post('/update/service/{id}', [serviceController::class, 'updateService'])->name('update.service');
        Route::get('/delete/service/{id}', [serviceController::class, 'deleteService'])->name('delete.service');

	
	 	Route::get('/get/sub-field/{id}', [AccreditedCABController::class, 'GetSubField'])->name('get.sub.field');
		Route::get('/search/accredited-cab', [AccreditedCABController::class, 'SearchAccreditedCab'])->name('search.accredited.cab');
        Route::get('/category/search/{category}', [AccreditedCABController::class, 'AccreditedCABsearch'])->name('category.search');
        Route::get('/accredited-cab/index', [AccreditedCABController::class, 'AccreditedCABIndex'])->name('cab.index')->middleware('permission:4');
        Route::get('/create/accredited-cab', [AccreditedCABController::class, 'createAccreditedCAB'])->name('create.cab')->middleware('permission:4');
        Route::post('/stotre/accredited-cab', [AccreditedCABController::class, 'storeAccreditedCAB'])->name('store.cab')->middleware('permission:4');
        Route::get('/edit/accredited-cab/{id}', [AccreditedCABController::class, 'editAccreditedCAB'])->name('edit.cab')->middleware('permission:4');
        Route::post('/update/accredited-cab/{id}', [AccreditedCABController::class, 'updateAccreditedCAB'])->name('update.cab')->middleware('permission:4');
        Route::post('/delete/accredited-cab', [AccreditedCABController::class, 'deleteAccreditedCAB'])->name('delete.cab')->middleware('permission:4');
        Route::get('/change-status/{status}/{id}', [AccreditedCABController::class, 'change_status'])->name('change_status');
        Route::post('/update-status', [AccreditedCABController::class, 'update_status'])->name('update.status');
        Route::post('/suspended/update/{id}', [AccreditedCABController::class, 'suspended_update'])->name('update.suspended');
        Route::post('/withdrawl/update/{id}', [AccreditedCABController::class, 'withdrawl_update'])->name('update.withdrawl');
	Route::get('/get-cities/{province_id}', [AccreditedCABController::class, 'getCities'])->name('get.cities');
	Route::post('/hide/update',[AccreditedCABController::class, 'hide'])->name('update.hide');
	Route::get('/hidden/accredited-cab',[AccreditedCABController::class, 'gethiddenAccredited'])->name('getHiddenAccredited');
	Route::post('/unhide/update',[AccreditedCABController::class, 'unhide'])->name('update.unhide');

     
   Route::get('/generate-qr/{lab_no}', function ($lab_no) {
	 //  require_once base_path('vendor/autoload.php');
   $qrCode = QrCode::size(100)->generate(route('testing_active', $lab_no));

//$image = Image::make($qrCode)->encode('png');

//return response($image, 200)
  //  ->header('Content-Type', 'image/png')
    //->header('Content-Disposition', 'attachment; filename="qrcode.png"');
	 
   return response($qrCode);
            //    ->header('Content-Type', 'image/svg+xml');
})->name('generate.qr');
        // Import & Export Csv File
        Route::post('/import-publication', [PublicationController::class, 'importPublication'])->name('import.publication');
        
        Route::post('/import', [AccreditedCABController::class, 'import'])->name('import');
        Route::get('/export', [AccreditedCABController::class, 'export'])->name('export');
        
  


        // Page
        Route::get('/page/index', [PageController::class, 'PageIndex'])->name('page.index')->middleware('permission:8');
        Route::get('/create/page', [PageController::class, 'createPage'])->name('create.page')->middleware('permission:8');
        Route::post('/stotre/page', [PageController::class, 'storePage'])->name('store.page')->middleware('permission:8');
        Route::get('/edit/page/{id}', [PageController::class, 'editPage'])->name('edit.page')->middleware('permission:8');
        Route::post('/update/page/{id}', [PageController::class, 'updatePage'])->name('update.page')->middleware('permission:8');
        Route::get('/delete/page/{id}', [PageController::class, 'deletePage'])->name('delete.page')->middleware('permission:8');


        // Training Calendar
        Route::get('/training-calendar/index', [TrainingCalendarController::class, 'TrainingCalendarIndex'])->name('training.calendar.index');
        Route::get('/create/training-calendar', [TrainingCalendarController::class, 'createTrainingCalendar'])->name('create.calendar');
        Route::post('/stotre/training-calendar', [TrainingCalendarController::class, 'storeTrainingCalendar'])->name('store.calendar');
        Route::get('/edit/training-calendar/{id}', [TrainingCalendarController::class, 'editTrainingCalendar'])->name('edit.calendar');
        Route::post('/update/training-calendar/{id}', [TrainingCalendarController::class, 'updateTrainingCalendar'])->name('update.calendar');
        Route::get('/delete/training-calendar/{id}', [TrainingCalendarController::class, 'deleteTrainingCalendar'])->name('delete.calendar');
     

	
     
     
        // user
        Route::get('/user/index', [UserController::class, 'UserIndex'])->name('user.index')->middleware('permission:8');
        Route::get('/create/user', [UserController::class, 'createUser'])->name('create.user')->middleware('permission:8');
        Route::post('/stotre/user', [UserController::class, 'storeUser'])->name('store.user')->middleware('permission:8');
        Route::get('/edit/user/{id}', [UserController::class, 'editUser'])->name('edit.user')->middleware('permission:8');
        Route::post('/update/user/{id}', [UserController::class, 'updateUser'])->name('update.user')->middleware('permission:8');
        Route::get('/delete/user/{id}', [UserController::class, 'deleteUser'])->name('delete.user')->middleware('permission:8');


        // Upload Media
        Route::get('/create/gallery-content', [MediaController::class, 'createGallery'])->name('create.gallery.content')->middleware('permission:8');
        Route::post('/store/gallery-content', [MediaController::class, 'storeGallery'])->name('store.gallery');

        Route::get('/upload-file', [MediaController::class, 'uploadGallery'])->name('upload.gallery')->middleware('permission:8');
        Route::post('/store/document', [MediaController::class, 'storeDocument'])->name('store.document');
        Route::get('/show-doc/{id}', [MediaController::class, 'ShowDoc'])->name('show.doc')->middleware('permission:8');
        Route::get('/delete-doc/{id}', [MediaController::class, 'deleteDoc'])->name('delete.doc')->middleware('permission:8');


        // News & Update

        Route::get('/news/index', [NewsController::class, 'NewsIndex'])->name('news.index')->middleware('permission:8');
        Route::get('/create/news', [NewsController::class, 'createNews'])->name('create.news')->middleware('permission:8');
        Route::post('/stotre/news', [NewsController::class, 'storeNews'])->name('store.news')->middleware('permission:8');
        Route::get('/edit/news/{id}', [NewsController::class, 'editNews'])->name('edit.news')->middleware('permission:8');
        Route::post('/update/news/{id}', [NewsController::class, 'updateNews'])->name('update.news')->middleware('permission:8');
        Route::get('/delete/news/{id}', [NewsController::class, 'deleteNews'])->name('delete.news')->middleware('permission:8');
        Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show')->middleware('permission:8');
	
	 // International Recognition

        Route::get('/international-recog/index', [InternationalRelationController::class, 'Index'])->name('international.index')->middleware('permission:8');
        Route::get('/create/international-recog', [InternationalRelationController::class, 'create'])->name('create.international')->middleware('permission:8');
        Route::post('/store/international-recog', [InternationalRelationController::class, 'store'])->name('store.international')->middleware('permission:8');
        Route::get('/edit/international-recog/{id}', [InternationalRelationController::class, 'edit'])->name('edit.international')->middleware('permission:8');
        Route::post('/update/international-recog/{id}', [InternationalRelationController::class, 'update'])->name('update.international')->middleware('permission:8');
        Route::get('/delete/international-recog/{id}', [InternationalRelationController::class, 'delete'])->name('delete.international')->middleware('permission:8');

	
      //DG Messages
	   Route::get('/dg-message/index', [DgmessageController::class,'MessageIndex'])->name('message.index')->middleware('permission:9');
	   Route::get('/create/dg-message', [DgmessageController::class,'createMessage'])->name('message.create')->middleware('permission:9');
	   Route::post('/store/dg-message', [DgmessageController::class,'storeMessage'])->name('message.store')->middleware('permission:9');
	   Route::get('/edit/dg-message/{id}', [DgmessageController::class,'editMessage'])->name('message.edit')->middleware('permission:9');
	   Route::post('/update/dg-message/{id}' ,[DgmessageController::class,'updateMessage'])->name('message.update')->middleware('permission:9');
	   Route::get('/delete/dg-message/{id}' ,[DgmessageController::class,'deleteMessage'])->name('message.delete')->middleware('permission:9');
	

        // Edward Slider

        Route::get('/edward-slider/index', [EdwardSliderController::class, 'EdwardSliderIndex'])->name('edward.index')->middleware('permission:8');
        Route::get('/create/edward-slider', [EdwardSliderController::class, 'createEdwardSlider'])->name('create.edward')->middleware('permission:8');
        Route::post('/stotre/edward-slider', [EdwardSliderController::class, 'storeEdwardSlider'])->name('store.edward')->middleware('permission:8');
        Route::get('/edit/edward-slider/{id}', [EdwardSliderController::class, 'editEdwardSlider'])->name('edit.edward')->middleware('permission:8');
        Route::post('/update/edward-slider/{id}', [EdwardSliderController::class, 'updateEdwardSlider'])->name('update.edward')->middleware('permission:8');
        Route::get('/delete/edward-slider/{id}', [EdwardSliderController::class, 'deleteEdwardSlider'])->name('delete.edward')->middleware('permission:8');

	   //Current Services
	
	   Route::get('/curren-services/index', [CurrentServiceController::class, 'CurrentSerIndex'])->name('currentservice.index')->middleware('permission:1');
	   Route::get('/create/curren-services', [CurrentServiceController::class, 'createCurrentSer'])->name('create.currentservice')->middleware('permission:1');
        Route::post('/store/curren-services', [CurrentServiceController::class, 'storeCurrentSer'])->name('store.currentservice')->middleware('permission:1');
        Route::get('/edit/curren-services/{id}', [CurrentServiceController::class, 'editCurrentSer'])->name('edit.currentservice')->middleware('permission:1');
        Route::post('/update/curren-services/{id}', [CurrentServiceController::class, 'updateCurrentSer'])->name('update.currentservice')->middleware('permission:1');
        Route::get('/delete/curren-services/{id}', [CurrentServiceController::class, 'deleteCurrentSer'])->name('delete.currentservice')->middleware('permission:1');

	
	   //About-us-dashboard-intro
	    Route::get('/introduct/index', [AboutControlller::class, 'IntroIndex'])->name('aboutintro.index')->middleware('permission:10');
	    Route::get('/create/introduct', [AboutControlller::class, 'createIntro'])->name('create.aboutintro')->middleware('permission:10');
        Route::post('/store/introduct', [AboutControlller::class, 'storeIntro'])->name('store.aboutintro')->middleware('permission:10');
	    Route::get('/edit/introduct/{id}', [AboutControlller::class, 'editIntro'])->name('edit.aboutintro')->middleware('permission:10');
        Route::post('/update/introduct/{id}', [AboutControlller::class, 'updateIntro'])->name('update.aboutintro')->middleware('permission:10');
	    Route::get('/delete/introduct/{id}', [AboutControlller::class, 'deleteIntro'])->name('delete.aboutintro')->middleware('permission:10');
	
	 //About-us-dashboard-Acrediation
	    Route::get('/acredat/index', [aboutAcrediationController::class, 'AboutAcredatiIndex'])->name('aboutacredat.index')->middleware('permission:10');
	    Route::get('/create/acredat', [aboutAcrediationController::class, 'createAboutAcredat'])->name('create.aboutacredat')->middleware('permission:10');
        Route::post('/store/acredat', [aboutAcrediationController::class, 'storeAboutAcredat'])->name('store.aboutacredat')->middleware('permission:10')->middleware('permission:10')->middleware('permission:10');
	    Route::get('/edit/acredat/{id}', [aboutAcrediationController::class, 'editAboutAcredat'])->name('edit.aboutacredat')->middleware('permission:10')->middleware('permission:10');
        Route::post('/update/acredat/{id}', [aboutAcrediationController::class, 'updateAboutAcredat'])->name('update.aboutacredat')->middleware('permission:10');
	    Route::get('/delete/acredat/{id}', [aboutAcrediationController::class, 'deleteAboutAcredat'])->name('delete.aboutacredat')->middleware('permission:10');
	
	
	 //About-us-dashboard-Benefits
	    Route::get('/Benefit-Accrediat/index', [BenefitAccrediationController::class, 'BenefitAcrediatIndex'])->name('benefit.index')->middleware('permission:10');
	    Route::get('/create/Benefit-Accrediat', [BenefitAccrediationController::class, 'createBenefitAcrediat'])->name('create.benefit')->middleware('permission:10');
        Route::post('/store/Benefit-Accrediat', [BenefitAccrediationController::class, 'storeBenefitAcrediat'])->name('store.benefit')->middleware('permission:10');
	    Route::get('/edit/Benefit-Accrediat/{id}', [BenefitAccrediationController::class, 'editBenefitAcrediat'])->name('edit.benefit')->middleware('permission:10');
        Route::post('/update/Benefit-Accrediat/{id}', [BenefitAccrediationController::class, 'updateBenefitAcrediat'])->name('update.benefit')->middleware('permission:10');
	    Route::get('/delete/Benefit-Accrediat/{id}', [BenefitAccrediationController::class, 'deleteBenefitAcrediat'])->name('delete.benefit')->middleware('permission:10');
	
	//About-us-dashboard-Structure
	    Route::get('/About-Structure/index', [StructureController::class, 'AboutStrucIndex'])->name('AboutStruc.index')->middleware('permission:10');
	    Route::get('/create/About-Structure', [StructureController::class, 'createAboutStruc'])->name('create.AboutStruc')->middleware('permission:10');
        Route::post('/store/About-Structure', [StructureController::class, 'storeAboutStruc'])->name('store.AboutStruc')->middleware('permission:10');
	    Route::get('/edit/About-Structure/{id}', [StructureController::class, 'editAboutStruc'])->name('edit.AboutStruc')->middleware('permission:10');
        Route::post('/update/About-Structure/{id}', [StructureController::class, 'updateAboutStruc'])->name('update.AboutStruc')->middleware('permission:10');
	    Route::get('/delete/About-Structure/{id}', [StructureController::class, 'deleteAboutStruc'])->name('delete.AboutStruc')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-Act
	    Route::get('/Pnac-Act/index', [PnacActController::class, 'PnacActIndex'])->name('Pnacact.index')->middleware('permission:10');
	    Route::get('/create/Pnac-Act', [PnacActController::class, 'createPnacAct'])->name('create.Pnacact')->middleware('permission:10');
        Route::post('/store/Pnac-Act', [PnacActController::class, 'storePnacAct'])->name('store.Pnacact')->middleware('permission:10');
	    Route::get('/edit/Pnac-Act/{id}', [PnacActController::class, 'editPnacAct'])->name('edit.Pnacact')->middleware('permission:10');
        Route::post('/update/Pnac-Act/{id}', [PnacActController::class, 'updatePnacAct'])->name('update.Pnacact')->middleware('permission:10');
	    Route::get('/delete/Pnac-Act/{id}', [PnacActController::class, 'deletePnacAct'])->name('delete.Pnacact')->middleware('permission:10');
	
	
		//About-us-dashboard-Pnac-rules
	    Route::get('/Pnac-Rules/index', [PnacRuleController::class, 'PnacRulesIndex'])->name('Pnacruls.index')->middleware('permission:10');
	    Route::get('/create/Pnac-Rules', [PnacRuleController::class, 'createPnacRules'])->name('create.Pnacruls')->middleware('permission:10');
        Route::post('/store/Pnac-Rules', [PnacRuleController::class, 'storePnacRules'])->name('store.Pnacruls')->middleware('permission:10');
	    Route::get('/edit/Pnac-Rules/{id}', [PnacRuleController::class, 'editPnacRules'])->name('edit.Pnacruls')->middleware('permission:10');
        Route::post('/update/Pnac-Rules/{id}', [PnacRuleController::class, 'updatePnacRules'])->name('update.Pnacruls')->middleware('permission:10');
	    Route::delete('/delete/Pnac-Rules/{id}', [PnacRuleController::class, 'deletePnacRules'])->name('delete.Pnacruls')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-stakeholder
	    Route::get('/Pnac-stakeholder/index', [ StakeholderController::class, 'PnacStakeholderIndex'])->name('Pnacstakeholders.index')->middleware('permission:10');
	    Route::get('/create/Pnac-stakeholder', [ StakeholderController::class, 'createPnacStakeholder'])->name('create.Pnacstakeholders')->middleware('permission:10');
        Route::post('/store/Pnac-stakeholder', [ StakeholderController::class, 'storePnacStakeholder'])->name('store.Pnacstakeholders')->middleware('permission:10');
	    Route::get('/edit/Pnac-stakeholder/{id}', [ StakeholderController::class, 'editPnacStakeholder'])->name('edit.Pnacstakeholders')->middleware('permission:10');
        Route::post('/update/Pnac-stakeholder/{id}', [ StakeholderController::class, 'updatePnacStakeholder'])->name('update.Pnacstakeholders')->middleware('permission:10');
	    Route::get('/delete/Pnac-stakeholder/{id}', [ StakeholderController::class, 'deletePnacStakeholder'])->name('delete.Pnacstakeholders')->middleware('permission:10');
	
	//About-us-dashboard-Pnac-impartiality policy
	    Route::get('/impartialy-policy/index', [ImpartialityPolicyController::class, 'ImpartialyPolicyIndex'])->name('ImparPolicy.index')->middleware('permission:10');
	    Route::get('/create/impartialy-policy', [ImpartialityPolicyController::class, 'createImpartialyPolicy'])->name('create.ImparPolicy')->middleware('permission:10');
        Route::post('/store/impartialy-policy', [ImpartialityPolicyController::class, 'storeImpartialyPolicy'])->name('store.ImparPolicy')->middleware('permission:10');
	    Route::get('/edit/impartialy-policy/{id}', [ImpartialityPolicyController::class, 'editImpartialyPolicy'])->name('edit.ImparPolicy')->middleware('permission:10');
        Route::post('/update/impartialy-policy/{id}', [ImpartialityPolicyController::class, 'updateImpartialyPolicy'])->name('update.ImparPolicy')->middleware('permission:10');
	    Route::get('/delete/impartialy-policy/{id}', [ImpartialityPolicyController::class, 'deleteImpartialyPolicy'])->name('delete.ImparPolicy')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-Mission-Vission
	    Route::get('/Mission-Vission/index', [ MissionVisionController::class, 'MissionVissionIndex'])->name('Missionvission.index')->middleware('permission:10');
	    Route::get('/create/Mission-Vission', [ MissionVisionController::class, 'createmision'])->name('create.Missionvission')->middleware('permission:10');
        Route::post('/store/Mission-Vission', [ MissionVisionController::class, 'storeMissionVission'])->name('store.Missionvission')->middleware('permission:10');
	    Route::get('/edit/Mission-Vission/{id}', [ MissionVisionController::class, 'editMissionVission'])->name('edit.Missionvission')->middleware('permission:10');
        Route::post('/update/Mission-Vission/{id}', [MissionVisionController::class, 'updateMissionVission'])->name('update.Missionvission')->middleware('permission:10');
	    Route::get('/delete/Mission-Vission/{id}', [ MissionVisionController::class, 'deleteMissionVission'])->name('delete.Missionvission')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-Annual reports
	    Route::get('/Annual-reports/index', [ AnnualReportController::class, 'AnnualReportIndex'])->name('annualreport.index')->middleware('permission:10');
	    Route::get('/create/Annual-reports', [ AnnualReportController::class, 'createAnnualReport'])->name('create.annualreport')->middleware('permission:10');
        Route::post('/store/Annual-reports', [ AnnualReportController::class, 'storeAnnualReport'])->name('store.annualreport')->middleware('permission:10');
	    Route::get('/edit/Annual-reports/{id}', [ AnnualReportController::class, 'editAnnualReport'])->name('edit.annualreport')->middleware('permission:10');
        Route::post('/update/Annual-reports/{id}', [AnnualReportController::class, 'updateAnnualReport'])->name('update.annualreport')->middleware('permission:10');
	    Route::get('/delete/Annual-reports/{id}', [ AnnualReportController::class, 'deleteAnnualReport'])->name('delete.annualreport')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-footprint
	    Route::get('/footprint/index', [ PnacfootprintController::class, 'FootPrintIndex'])->name('footprints.index')->middleware('permission:10');
	    Route::get('/create/footprint', [ PnacfootprintController::class, 'createFootPrint'])->name('create.footprints')->middleware('permission:10');
        Route::post('/store/footprint', [ PnacfootprintController::class, 'storeFootPrint'])->name('store.footprints')->middleware('permission:10');
	    Route::get('/edit/footprint/{id}', [ PnacfootprintController::class, 'editFootPrint'])->name('edit.footprints')->middleware('permission:10');
        Route::post('/update/footprint/{id}', [PnacfootprintController::class, 'updateFootPrint'])->name('update.footprints')->middleware('permission:10');
	    Route::get('/delete/footprint/{id}', [ PnacfootprintController::class, 'deleteFootPrint'])->name('delete.footprints')->middleware('permission:10');
	
	
	
	//About-us-dashboard-Pnac-newsletter
	    Route::get('/newsletr/index', [ NewsletterController::class, 'newletrIndex'])->name('newsletter.index')->middleware('permission:10');
	    Route::get('/create/newsletr', [ NewsletterController::class, 'createnewletr'])->name('create.newsletter')->middleware('permission:10');
        Route::post('/store/newsletr', [ NewsletterController::class, 'storenewletr'])->name('store.newsletter')->middleware('permission:10');
	    Route::get('/edit/newsletr/{id}', [ NewsletterController::class, 'editnewletr'])->name('edit.newsletter')->middleware('permission:10');
        Route::post('/update/newsletr/{id}', [NewsletterController::class, 'updatenewletr'])->name('update.newsletter')->middleware('permission:10');
	    Route::get('/delete/newsletr/{id}', [ NewsletterController::class, 'deletenewletr'])->name('delete.newsletter')->middleware('permission:10');
	
	//About-us-dashboard-Pnac-commitie
	    Route::get('/commetie/index', [ PnacCommitteeController::class, 'cometieIndex'])->name('Commetie.index')->middleware('permission:10');
	    Route::get('/create/commetie', [ PnacCommitteeController::class, 'createcometie'])->name('create.Commetie')->middleware('permission:10');
        Route::post('/store/commetie', [ PnacCommitteeController::class, 'storecometie'])->name('store.Commetie')->middleware('permission:10');
	    Route::get('/edit/commetie/{id}', [ PnacCommitteeController::class, 'editcometie'])->name('edit.Commetie')->middleware('permission:10');
        Route::post('/update/commetie/{id}', [PnacCommitteeController::class, 'updatecometie'])->name('update.Commetie')->middleware('permission:10');
	    Route::get('/delete/commetie/{id}', [ PnacCommitteeController::class, 'deletecometie'])->name('delete.Commetie')->middleware('permission:10');
	
	
	//About-us-dashboard-Pnac-harasment
	    Route::get('/women-hras/index', [ PnacHarasmentController::class, 'HarasmentIndex'])->name('women-harasment.index')->middleware('permission:10');
	    Route::get('/create/women-hras', [ PnacHarasmentController::class, 'createHarasment'])->name('create.women-harasment')->middleware('permission:10');
        Route::post('/store/women-hras', [ PnacHarasmentController::class, 'storeHarasment'])->name('store.women-harasment')->middleware('permission:10');
	    Route::get('/edit/women-hras/{id}', [ PnacHarasmentController::class, 'editHarasment'])->name('edit.women-harasment')->middleware('permission:10');
        Route::post('/update/women-hras/{id}', [PnacHarasmentController::class, 'updateHarasment'])->name('update.women-harasment')->middleware('permission:10');
	    Route::get('/delete/women-hras/{id}', [ PnacHarasmentController::class, 'deleteHarasment'])->name('delete.women-harasment')->middleware('permission:10');
	
	
	
	
	
	   // Dg Profile
	
	    Route::get('/dg-profile/index', [DgProfileController::class, 'dgProfileIndex'])->name('dgprofiles.index')->middleware('permission:9');
	    Route::get('/credg-profile', [DgProfileController::class, 'createdgProfile'])->name('create.dgprofiles')->middleware('permission:9');
        Route::post('/store/dg-profile', [DgProfileController::class, 'storedgProfile'])->name('store.dgprofiles')->middleware('permission:9');
        Route::get('/edit/dg-profile/{id}', [DgProfileController::class, 'editdgProfile'])->name('edit.dgprofiles')->middleware('permission:9');
        Route::post('/update/dg-profile/{id}', [DgProfileController::class, 'updatedgProfile'])->name('update.dgprofiles')->middleware('permission:9');
        Route::get('/delete/dg-profile/{id}', [DgProfileController::class, 'deletedgProfile'])->name('delete.dgprofiles')->middleware('permission:9');


        // Contact

        Route::get('/contact/index', [ContactController::class, 'ContactIndex'])->name('contact.index')->middleware('permission:8');
        Route::get('/create/contact', [ContactController::class, 'createContact'])->name('create.contact')->middleware('permission:8');
        Route::post('/store/contact', [ContactController::class, 'storeContact'])->name('admin.store.contact')->middleware('permission:8');
        Route::get('/edit/contact/{id}', [ContactController::class, 'editContact'])->name('edit.contact')->middleware('permission:8');
        Route::post('/update/contact/{id}', [ContactController::class, 'updateContact'])->name('update.contact')->middleware('permission:8');
        Route::get('/delete/contact/{id}', [ContactController::class, 'deleteContact'])->name('delete.contact')->middleware('permission:8');

	
	 // Admin other service controller Grievance Cell

        Route::get('/Grievance-Other-service/index', [OtherServiceController::class, 'GrievanIndex'])->name('Grievanc.index')->middleware('permission:11');
        Route::get('/create/Grievance-Other-service', [OtherServiceController::class, 'createGrievan'])->name('create.Grievanc')->middleware('permission:11');
        Route::post('/store/Grievance-Other-service', [OtherServiceController::class, 'GrievanStore'])->name('store.Grievanc')->middleware('permission:11');
        Route::get('/edit/Grievance-Other-service/{id}', [OtherServiceController::class, 'Grievanedit'])->name('edit.Grievanc')->middleware('permission:11');
        Route::post('/update/Grievance-Other-service/{id}', [OtherServiceController::class, 'Grievanupdate'])->name('update.Grievanc')->middleware('permission:11');
        Route::get('/delete/Grievance-Other-service/{id}', [OtherServiceController::class, 'Grievandelete'])->name('delete.Grievanc')->middleware('permission:11');

	
	// Admin other service controller Complaint and Appeals

        Route::get('/CompAppeal-Other-service/index', [OtherServiceController::class, 'CompAppindex'])->name('ComplainAppeal.index')->middleware('permission:11');
        Route::get('/create/CompAppeal-Other-service', [OtherServiceController::class, 'createCompApp'])->name('create.ComplainAppeal')->middleware('permission:11');
        Route::post('/store/CompAppeal-Other-service', [OtherServiceController::class, 'CompAppStore'])->name('store.ComplainAppeal')->middleware('permission:11');
        Route::get('/edit/CompAppeal-Other-service/{id}', [OtherServiceController::class, 'CompAppedit'])->name('edit.ComplainAppeal')->middleware('permission:11');
        Route::post('/update/CompAppeal-Other-service/{id}', [OtherServiceController::class, 'CompAppupdate'])->name('update.ComplainAppeal')->middleware('permission:11');
        Route::get('/delete/CompAppeal-Other-service/{id}', [OtherServiceController::class, 'CompAppdelete'])->name('delete.ComplainAppeal')->middleware('permission:11');


	// Admin other service Lists of Proficiency Testing Provider

        Route::get('/ProficiencyProvider/index', [OtherServiceController::class, 'ProfProviderindex'])->name('TestingProvider.index')->middleware('permission:11');
        Route::get('/create/ProficiencyProvider', [OtherServiceController::class, 'createProfProvider'])->name('create.TestingProvider')->middleware('permission:11');
        Route::post('/store/ProficiencyProvider', [OtherServiceController::class, 'ProfProviderStore'])->name('store.TestingProvider')->middleware('permission:11');
        Route::get('/edit/ProficiencyProvider/{id}', [OtherServiceController::class, 'ProfProvideredit'])->name('edit.TestingProvider')->middleware('permission:11');
        Route::post('/update/ProficiencyProvider/{id}', [OtherServiceController::class, 'ProfProviderupdate'])->name('update.TestingProvider')->middleware('permission:11');
        Route::get('/delete/ProficiencyProvider/{id}', [OtherServiceController::class, 'ProfProviderdelete'])->name('delete.TestingProvider')->middleware('permission:11');


	// Admin other service Tax Registration Numbers

        Route::get('/Tax-reg-num/index', [OtherServiceController::class, 'TaxRegisterindex'])->name('TaxRegistration.index')->middleware('permission:11');
        Route::get('/create/Tax-reg-num', [OtherServiceController::class, 'createTaxRegister'])->name('create.TaxRegistration')->middleware('permission:11');
        Route::post('/store/Tax-reg-num', [OtherServiceController::class, 'TaxRegisterStore'])->name('store.TaxRegistration')->middleware('permission:11');
        Route::get('/edit/Tax-reg-num/{id}', [OtherServiceController::class, 'TaxRegisteredit'])->name('edit.TaxRegistration')->middleware('permission:11')->middleware('permission:11');
        Route::post('/update/Tax-reg-num/{id}', [OtherServiceController::class, 'TaxRegisterupdate'])->name('update.TaxRegistration')->middleware('permission:11');
        Route::get('/delete/Tax-reg-num/{id}', [OtherServiceController::class, 'TaxRegisterdelete'])->name('delete.TaxRegistration')->middleware('permission:11');

	// Admin other service Foreign Currency Account Details

        Route::get('/Foreign-Currency/index', [OtherServiceController::class, 'ForeignCurrencyindex'])->name('ForeignCurren.index')->middleware('permission:11');
        Route::get('/create/Foreign-Currency', [OtherServiceController::class, 'createForeignCurrency'])->name('create.ForeignCurren')->middleware('permission:11');
        Route::post('/store/Foreign-Currency', [OtherServiceController::class, 'ForeignCurrencyStore'])->name('store.ForeignCurren')->middleware('permission:11');
        Route::get('/edit/Foreign-Currency/{id}', [OtherServiceController::class, 'ForeignCurrencyedit'])->name('edit.ForeignCurren')->middleware('permission:11');
        Route::post('/update/Foreign-Currency/{id}', [OtherServiceController::class, 'ForeignCurrencyupdate'])->name('update.ForeignCurren')->middleware('permission:11');
        Route::get('/delete/Foreign-Currency/{id}', [OtherServiceController::class, 'ForeignCurrencydelete'])->name('delete.ForeignCurren')->middleware('permission:11');

	// Admin other service Accreditation Process

        Route::get('/Accreditation-process/index', [OtherServiceController::class, 'AccreditationProcessindex'])->name('AccredProcess.index')->middleware('permission:11');
        Route::get('/create/Accreditation-process', [OtherServiceController::class, 'createAccreditationProcess'])->name('create.AccredProcess')->middleware('permission:11');
        Route::post('/store/Accreditation-process', [OtherServiceController::class, 'AccreditationProcessStore'])->name('store.AccredProcess')->middleware('permission:11');
        Route::get('/edit/Accreditation-process/{id}', [OtherServiceController::class, 'AccreditationProcessedit'])->name('edit.AccredProcess')->middleware('permission:11');
        Route::post('/update/Accreditation-process/{id}', [OtherServiceController::class, 'AccreditationProcessupdate'])->name('update.AccredProcess')->middleware('permission:11');
        Route::get('/delete/Accreditation-process/{id}', [OtherServiceController::class, 'AccreditationProcessdelete'])->name('delete.AccredProcess')->middleware('permission:11');


        // Publication Scheme

        Route::get('/publication-scheme/index', [PublicationSchemeController::class, 'publicationSchemeIndex'])->name('publication.scheme.index');
        Route::get('/create/publication-scheme', [PublicationSchemeController::class, 'createPublicationScheme'])->name('create.publication.scheme');
        Route::post('/store/publication-scheme', [PublicationSchemeController::class, 'storePublicationScheme'])->name('store.publication.scheme');
        Route::get('/edit/publication-scheme/{id}', [PublicationSchemeController::class, 'editPublicationScheme'])->name('edit.publication.scheme');
        Route::post('/update/publication-scheme/{id}', [PublicationSchemeController::class, 'updatePublicationScheme'])->name('update.publication.scheme');
        Route::get('/delete/publication-scheme/{id}', [PublicationSchemeController::class, 'deletePublicationScheme'])->name('delete.publication.scheme');
        
        
        // Publication

        Route::get('/publication/index', [PublicationController::class, 'PublicationIndex'])->name('publication.index')->middleware('permission:5');
        Route::get('/create/publication', [PublicationController::class, 'createPublication'])->name('create.publication')->middleware('permission:5');
        Route::post('/store/publication', [PublicationController::class, 'storePublication'])->name('store.publication')->middleware('permission:5');
        Route::get('/edit/publication/{id}', [PublicationController::class, 'editPublication'])->name('edit.publication')->middleware('permission:5');
        Route::post('/update/publication/{id}', [PublicationController::class, 'updatePublication'])->name('update.publication')->middleware('permission:5');
        Route::get('/delete/publication/{id}', [PublicationController::class, 'deletePublication'])->name('delete.publication')->middleware('permission:5');

        Route::get('/obsolete/publication/{id}', [PublicationController::class, 'obsoletePublication'])->name('obsolete.publication');

		// Standard
        Route::get('/standard', [PublicationController::class, 'PublicationStandard'])->name('publication.standard');
	
	
        // Internal Document

        Route::get('/internal-pnac-form', [PublicationController::class, 'InternalPnacForm'])->name('pnac.form');
        Route::get('/internal-pnac-guidelines', [PublicationController::class, 'InternalPnacGuidelines'])->name('pnac.guidelines');
        Route::get('/internal-pnac-procedures', [PublicationController::class, 'InternalPnacProcedures'])->name('pnac.procedures');


        // Obsolete DOCUMENTS

        Route::get('/obsolete-pnac-form', [PublicationController::class, 'ObsoletePnacForm'])->name('obsolete.pnac.form');
        Route::get('/obsolete-pnac-guidelines', [PublicationController::class, 'ObsoletePnacGuidelines'])->name('obsolete.pnac.guidelines');
        Route::get('/obsolete-pnac-procedures', [PublicationController::class, 'ObsoletePnacProcedures'])->name('obsolete.pnac.procedures');
        Route::get('/obsolete-pnac-standard', [PublicationController::class, 'ObsoletePnacStandard'])->name('obsolete.pnac.standards');


        // External DOCUMENTS

        Route::get('/external-apac-document', [PublicationController::class, 'ExternalAPACDocument'])->name('external.apac.document');
        Route::get('/external-ilac-document', [PublicationController::class, 'ExternalILACDocument'])->name('external.ilac.document');
        Route::get('/external-iaf-document', [PublicationController::class, 'ExternalIAFDocument'])->name('external.iaf.document');



        // Category

        Route::get('/category/index', [CategoryController::class, 'CategoryIndex'])->name('category.index')->middleware('permission:3');
        Route::get('/create/category', [CategoryController::class, 'createCategory'])->name('create.category')->middleware('permission:3');
        Route::post('/store/category', [CategoryController::class, 'storeCategory'])->name('store.category')->middleware('permission:3');
        Route::get('/edit/category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category')->middleware('permission:3');
        Route::post('/update/category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category')->middleware('permission:3');
        Route::delete('/delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category')->middleware('permission:3');
        
        
        // Domain

        Route::get('/domain/index', [DomainController::class, 'DomainIndex'])->name('domain.index')->middleware('permission:5');
        Route::get('/create/domain', [DomainController::class, 'createDomain'])->name('create.domain')->middleware('permission:5');
        Route::post('/store/domain', [DomainController::class, 'storeDomain'])->name('store.domain')->middleware('permission:5');
        Route::get('/edit/domain/{id}', [DomainController::class, 'editDomain'])->name('edit.domain')->middleware('permission:5');
        Route::post('/update/domain/{id}', [DomainController::class, 'updateDomain'])->name('update.domain')->middleware('permission:5');
        Route::delete('/delete/domain/{id}', [DomainController::class, 'deleteDomain'])->name('delete.domain')->middleware('permission:5');
        
	
	  // Scheme

        
        
        
        // Document

        Route::get('/document/index', [DocumentController::class, 'DocumentIndex'])->name('document.index')->middleware('permission:5');
        Route::get('/create/document', [DocumentController::class, 'createDocument'])->name('create.document')->middleware('permission:5');
        Route::post('/store/document', [DocumentController::class, 'storeDocument'])->name('store.document')->middleware('permission:5');
        Route::get('/edit/document/{id}', [DocumentController::class, 'editDocument'])->name('edit.document')->middleware('permission:5');
        Route::post('/update/document/{id}', [DocumentController::class, 'updateDocument'])->name('update.document')->middleware('permission:5');
        Route::delete('/delete/document/{id}', [DocumentController::class, 'deleteDocument'])->name('delete.document')->middleware('permission:5');


        // Field

        Route::get('/field/index', [FieldController::class, 'FieldIndex'])->name('field.index')->middleware('permission:2');
        Route::get('/create/field', [FieldController::class, 'createField'])->name('create.field')->middleware('permission:2');
        Route::post('/store/field', [FieldController::class, 'storeField'])->name('store.field')->middleware('permission:2');
        Route::get('/edit/field/{id}', [FieldController::class, 'editField'])->name('edit.field')->middleware('permission:2');
        Route::post('/update/field/{id}', [FieldController::class, 'updateField'])->name('update.field')->middleware('permission:2');
        Route::delete('/delete/field/{id}', [FieldController::class, 'deleteField'])->name('delete.field')->middleware('permission:2');


        // Sub Field

        Route::get('/sub-field/index', [FieldController::class, 'SubFieldIndex'])->name('sub.field.index')->middleware('permission:2');
        Route::get('/create/sub-field', [FieldController::class, 'createSubField'])->name('create.sub.field')->middleware('permission:2');
        Route::post('/store/sub-field', [FieldController::class, 'storeSubField'])->name('store.sub.field')->middleware('permission:2');
        Route::get('/edit/sub-field/{id}', [FieldController::class, 'editSubField'])->name('edit.sub.field')->middleware('permission:2');
        Route::post('/update/sub-field/{id}', [FieldController::class, 'updateSubField'])->name('update.sub.field')->middleware('permission:2');
        Route::delete('/delete/sub-field/{id}', [FieldController::class, 'deleteSubField'])->name('delete.sub.field')->middleware('permission:2');

          //faqs

		Route::get('/faqs/index', [FaqController::class, 'FaqIndex'])->name('Faqs.index')->middleware('permission:12');
		Route::get('/create/faqs', [FaqController::class, 'createFaq'])->name('create.Faqs')->middleware('permission:12');
		Route::post('/store/faqs', [FaqController::class, 'storeFaq'])->name('store.Faqs')->middleware('permission:12');
		Route::get('/edit/faqs/{id}', [FaqController::class, 'editFaq'])->name('edit.Faqs')->middleware('permission:12');
		Route::post('/update/faqs/{id}', [FaqController::class, 'updateFaq'])->name('update.Faqs')->middleware('permission:12');
		Route::delete('/delete/faqs/{id}', [FaqController::class, 'deleteFaq'])->name('delete.Faqs')->middleware('permission:12');
    
    //trainer


    //Training


   
	Route::get('/attendance/export-pdf/{course}', [TrainingController::class, 'exportPDF'])->name('attendance.exportPDF');
	Route::get('/attendance/export/{course}', [TrainingController::class, 'export'])->name('attendance.export');
	// Participants export
	Route::get('/participants/export/{id}',[TrainingController::class,'exportParticipants'])->name('participants.export');
	//training export
	Route::get('/training/export/',[TrainingController::class,'exporttraining'])->name('training.export');
	//training apply
	Route::get('/trainingapply/export',[TrainingController::class,'trainingapply'])->name('trainingapply.export');
    //Country
   
 
 //Training type
    
 //testimonials
	});
 //announcement
          
// website routes
Route::get('/',[WebsiteController::class,'index'])->name('home');
Route::get('Page/Construct',[WebsiteController::class,'constructPage'])->name('page.construct');
Route::get('/about',[WebsiteController::class,'about'])->name('about');
Route::get('/contact',[WebsiteController::class,'contact'])->name('contact');
Route::post('/create-contact',[WebsiteController::class,'StoreContact'])->name('store.contact');
Route::get('/dg-pnac-profile',[WebsiteController::class,'dg_pnac_profile'])->name('dg_pnac_profile');
Route::get('/TestingandCalibrationLaboratoies/{status}',[WebsiteController::class,'TestingCalibrationLaboratoies'])->name('TestingCalibrationLaboratoies');
Route::get('/TestingandCalibrationLaboratories/{status}',[WebsiteController::class,'TestingCalibrationLaboratoies'])->name('TestingAndCalibrationLaboratories');

Route::get('/Certification-Bodies/{status}',[WebsiteController::class,'CertificationBodies'])->name('CertificationBodies');
Route::get('/Medical-Laboratories/{status}',[WebsiteController::class,'MedicalLabs'])->name('MedicalLaboratories');
Route::get('/Medical-Laboratories/{status}',[WebsiteController::class,'MedicalLabs'])->name('MedicalLaboratories');
Route::get('/Inspection-Bodies/{status}',[WebsiteController::class,'InspectionBodies1'])->name('InspectionBodies');
Route::get('/Halal-Certification-Bodies/{status}',[WebsiteController::class,'HalalCertificationBodies'])->name('HalalCertificationBodies');
Route::get('/Proficiency-Testing-Provider/{status}',[WebsiteController::class,'ProficiencyTestingProvider'])->name('ProficiencyTestingProvider');
Route::get('/Product-Certification-Bodies/{status}',[WebsiteController::class,'ProductCertificationBodies'])->name('ProductCertificationBodies');
Route::get('/Personnel-Certification-Bodies/{status}',[WebsiteController::class,'PersonnalCertificationBodies'])->name('PersonnelCertificationBodies');
Route::get('/Search-AccreditCAB/{status}',[WebsiteController::class,'SearchAccreditCAB'])->name('SearchAccreditCAB');
Route::get('/searchbar' ,[WebsiteController::class,'searchbars'])->name('search.bar');
Route::get('/search/certification-bodies' ,[WebsiteController::class,'SearchCertificationBodies'])->name('search.certification.bodies');
//acredit cabs dynamic route
Route::get('/Accredited-Cabs-serve/{ul_name}/{status}' ,[WebsiteController::class,'DynamicAccreditCabs'])->name('Dynamic.Accredit.Cabs');




Route::get('/pdfFiles/{id}',[WebsiteController::class,'testing_active'])->name('testing_active');

Route::get('/Publication',[WebsiteController::class,'WebsitePublication'])->name('website.publication');
Route::get('/Download-Publication/{id}',[WebsiteController::class,'DownloadPublication'])->name('download.publication');
Route::get('/SearchPublication/{id}',[WebsiteController::class,'SearchPublication'])->name('search.publication');



// About Us
Route::get('/About-Us/Introduction',[WebsiteController::class,'Introduction'])->name('introduction');
Route::get('/About-Us/International-Linkage',[WebsiteController::class,'InternationalLinkage'])->name('international.linkage');
Route::get('/About-Us/Work-Stakeholders',[WebsiteController::class,'WorkStakeholders'])->name('work.stakeholders');
Route::get('/About-Us/About-Accreditation',[WebsiteController::class,'AboutAccreditation'])->name('about.accreditation');
Route::get('/About-Us/Benefits-Accreditation',[WebsiteController::class,'BenefitsAccreditation'])->name('benefits.accreditation');
Route::get('/About-Us/Structure',[WebsiteController::class,'Structure'])->name('structure');
Route::get('/About-Us/PNAC-Act',[WebsiteController::class,'PNACAct'])->name('PNAC.act');
Route::get('/About-Us/PNAC-Rules',[WebsiteController::class,'PNACRules'])->name('PNAC.rules');
Route::get('/About-Us/Impartiality-Polic',[WebsiteController::class,'ImpartialityPolic'])->name('impartiality.polic');
Route::get('/About-Us/Mission-Vision',[WebsiteController::class,'MissionVision'])->name('mission.vision');
Route::get('/About-Us/Annual-Reports',[WebsiteController::class,'AnnualReports'])->name('annual.reports');
Route::get('/About-Us/Long-Term-Plan',[WebsiteController::class,'LongTerm'])->name('long.term');
Route::get('/About-Us/NewsLetter',[WebsiteController::class,'NewsLetter'])->name('news.letter');
Route::get('/About-Us/PNAC-Footprint',[WebsiteController::class,'PNACFootprint'])->name('PNAC.footprint');
Route::get('/About-Us/HR-Plan',[WebsiteController::class,'HRPlan'])->name('hr.plan');
Route::get('/About-Us/Pnac-Committees',[WebsiteController::class,'PnacCommittees'])->name('pnac.committees');
Route::get('/About-Us/harassment-of-women',[WebsiteController::class,'HarassmentWomen'])->name('harassment.women');
Route::get('/history-panac',[WebsiteController::class,'history'])->name('history');

// Services Accrediation Services
// Route::get('/Services/Testing-and-Calibration-Laboratories',[WebsiteController::class,'TestingCalibration'])->name('testing.calibration');
// Route::get('/Services/Certification-Bodies',[WebsiteController::class,'ServicesCertificationBodies'])->name('services.certification.bodies');
// Route::get('/Services/Medical-Laboratories',[WebsiteController::class,'MedicalLaboratories'])->name('medical.laboratories');
// Route::get('/Services/Inspection-Bodies',[WebsiteController::class,'InspectionBodies'])->name('inspection.bodies');
// Route::get('/Services/Halal-Certification-Bodies',[WebsiteController::class,'HalalCertification'])->name('halal.certification');
// Route::get('/Services/Proficiency-Testing-Provider',[WebsiteController::class,'ProficiencyTesting'])->name('proficiency.testing');
// Route::get('/Services/Product-Certification-Bodies',[WebsiteController::class,'ProductCertification'])->name('product.certification');
// Route::get('/Services/Personnel-Certification-Bodies',[WebsiteController::class,'PersonnelCertification'])->name('personnel.certification');
// Route::get('/How-to-apply',[WebsiteController::class,'apply'])->name('How-to-apply');
Route::get('/Services/Testing-and-Calibration-Laboratories',[WebsiteController::class,'servicesCAB'])->name('testing.calibration');
Route::get('/Services/Certification-Bodies',[WebsiteController::class,'servicesCAB'])->name('services.certification.bodies');
Route::get('/Services/Medical-Laboratories',[WebsiteController::class,'servicesCAB'])->name('medical.laboratories');
Route::get('/Services/Inspection-Bodies',[WebsiteController::class,'servicesCAB'])->name('inspection.bodies');
Route::get('/Services/Halal-Certification-Bodies',[WebsiteController::class,'servicesCAB'])->name('halal.certification');
Route::get('/Services/Proficiency-Testing-Provider',[WebsiteController::class,'servicesCAB'])->name('proficiency.testing');
Route::get('/Services/Product-Certification-Bodies',[WebsiteController::class,'servicesCAB'])->name('product.certification');
Route::get('/Services/Personnel-Certification-Bodies',[WebsiteController::class,'servicesCAB'])->name('personnel.certification');

Route::get('/Services/{ul_name}', [WebsiteController::class, 'servicesCAB'])->name('servicesCAB');


Route::get('/How-to-apply',[WebsiteController::class,'apply'])->name('How-to-apply');
// service pages
Route::resource('servicepage', ServicepagesController::class)->middleware('permission:1');
//world Accreditation
 Route::resource('worldAccreditation',WorldAccreditationController::class)->middleware('permission:13');

// Services Other Services
Route::get('/Services/Accreditation-Process',[WebsiteController::class,'AccreditationProcess'])->name('accreditation.process');
Route::get('/Services/Grievance-Pensioners',[WebsiteController::class,'GrievancePensioners'])->name('grievance.pensioners');
Route::get('/Services/Complaint-Appeals',[WebsiteController::class,'ComplaintAppeals'])->name('complaint.appeals');
Route::get('/Services/Lists-Proficiency',[WebsiteController::class,'ListsProficiency'])->name('lists.proficiency');
Route::get('/Services/TaxRegistration-Numbers',[WebsiteController::class,'TaxRegistrationNumbers'])->name('taxRegistration.numbers');
Route::get('/Services/Foreign-Currency',[WebsiteController::class,'ForeignCurrency'])->name('foreign.currency');
Route::get('/Services/Accreditation-Fee',[WebsiteController::class,'AccreditationFee'])->name('accreditation.fee');
//traing

Route::get('/training',[WebsiteController::class,'training'])->name('training');

//training theme
Route::get('/about-training', [TrainingController::class, 'about'])->name('training.about');
// Route::get('/all-course', [TrainingController::class, 'allcourses'])->name('all.course');
Route::get('/testing-calib-course', [TrainingController::class, 'TestingCalibraCourse'])->name('testing.Course');
Route::get('/certification-body-course', [TrainingController::class, 'CertificBodyCourse'])->name('certif.course');
Route::get('/insp-body-course', [TrainingController::class, 'InspectBodyCourse'])->name('inspect.course');
Route::get('/halal-certi-course', [TrainingController::class, 'HalalCertifiCourse'])->name('halalcert.course');
Route::get('/medical-labo-course', [TrainingController::class, 'MedicalLabCourse'])->name('medicallab.course');
Route::get('/perso-cert-body-course', [TrainingController::class, 'PersCertCourse'])->name('personalcert.course');
Route::get('/product-cert-body-course', [TrainingController::class, 'ProducCertCourse'])->name('prodcertif.course');
Route::get('/proficienc-test-bodies', [TrainingController::class, 'ProficiTestBody'])->name('profitestbodies.course');
Route::get('/smic-course', [TrainingController::class, 'SmicCourse'])->name('smic.course');
Route::get('/training-contact', [TrainingController::class, 'Trainingcontact'])->name('training.contact');
Route::get('/training-login', [TrainingController::class, 'Traininglogin'])->name('training.login');
//forget password
Route::post('traininguser/email/sent', [TrainingController::class, 'email_sent'])->name('password.email-training');
Route::get('/training-password-reset/{email}', [TrainingController::class, 'rest_data'])->name('training-password-reset');
Route::post('/training-password-update', [TrainingController::class, 'reset_password'])->name('training-password-update');


//
Route::post('/Trailogin', [TrainingController::class,'trainingstore'])->name( 'Train.login');
Route::get('/registration', [TrainingController::class, 'Trainingregistration'])->name('training.registration');
Route::post('/Trairegistr', [TrainingController::class, 'trairegister'])->name('traini.Registr');
Route::get('training-logout',[TrainingController::class,'TrainingLogout'])->name('training.logout');
Route::get('/training/dashboard', [TrainingController::class, 'dashboardTraining'])->name('training.home');
Route::get('profile-data/{id}', [TrainingController::class, 'profile_data'])->name('profile_data');
Route::post('profile-data-store/{id}', [TrainingController::class, 'profile_data_store'])->name('profile_data_store');
Route::get('/training/feedback', [TrainingController::class, 'feedbackTraining'])->name('feedbackTraining');



Route::post('/training/feedback/store', [TrainingController::class, 'feedbackTrainingstore'])->name('feedbackTrainingstore');
Route::get('/training/feedback/index', [TrainingController::class, 'feedbackTrainingindex'])->name('feedbackTrainingindex');
Route::get('/training/feedback/show/{id}', [TrainingController::class, 'feedbackTrainingshow'])->name('feedbackTrainingshow');
Route::get('/close-training/{status}',[TrainingController::class,'TrainingDashboardStatus'])->name('training.status');
Route::get('/laboratory-accredi-content', [TrainingController::class, 'LabAccrediatContent'])->name('laboraccrediat.content');
Route::get('/inspect-body-content', [TrainingController::class, 'InspectBodyContent'])->name('Inspect.content');
Route::get('/proficiency-test-content', [TrainingController::class, 'proficiencyTestContent'])->name('Proficiency.content');
Route::get('/certific-body-content', [TrainingController::class, 'certificationContent'])->name('certification.content');
Route::get('/halal-cert-course', [TrainingController::class, 'HalalCertifContent'])->name('halalcertif.content');
Route::get('/product-certif-course', [TrainingController::class, 'productCertificCourse'])->name('productcertifica.course');
Route::get('/book-me/{id}', [TrainingController::class, 'BookMee'])->name('book.me');

//book your seat session
Route::get('/book-seat/{id}', [TrainingController::class, 'Bookseat'])->name('bookseat');
Route::get('/apply-confirm/{id}', [TrainingController::class, 'apply_confirm'])->name('apply_confirm');
Route::get('/apply-training', [TrainingController::class, 'apply_training'])->name('apply_training');
//attendence 
Route::get('/attendence/{id}', [TrainingController::class, 'attendence'])->name('attendence');
//Route::get('/list-participants', [TrainingController::class, 'participants'])->name('participants');

Route::post('/update-participant-status', [TrainingController::class, 'update_participant_status'])->name('update-participant-status');
Route::post('/update-participant-to-selected', [TrainingController::class, 'update_participant_to_selected'])->name('update-participant-to-selected');

// traingUser login side

Route::get('trainguser-profile', [TrainingController::class, 'trainguser_profile'])->name('trainguser_profile');
Route::get('trainguser-profile-edit', [TrainingController::class, 'trainguser_profile_edit'])->name('trainguser_profile_edit');
Route::post('trainguser-profile-store', [TrainingController::class, 'trainguser_profile_store'])->name('trainguser_profile_store');


// to change the password of the trainer admin
Route::post('change_trainer_admin_password', [TrainerAdminPanelController::class, 'change_trainer_admin_password'])->name('change_trainer_admin_password');


// Gallery
Route::get('/gallery',[WebsiteController::class,'Gallery'])->name('gallery');
//carrer

Route::get('/career',[WebsiteController::class,'carrer'])->name('carrer');
//feedback
Route::get('/feedback',[WebsiteController::class,'feedback'])->name('feedback');

//faq

Route::get('/faq',[WebsiteController::class,'faq'])->name('faq');
//sitemap

Route::get('/sitemap',[WebsiteController::class,'sitemap'])->name('sitemap');


Route::get('/image-gallery',[GalleryController::class,'index'])->name('image.gallery')->middleware('permission:13');
Route::post('/image-gallery-upload',[GalleryController::class,'store'])->name('imagegallery.upload')->middleware('permission:13');
Route::get('delete_gallery_image/{id}', [GalleryController::class, 'destroy'])->name('imagegallery.delete')->middleware('permission:13');

Route::post('/document-gallery-upload',[GalleryController::class,'storeDocument'])->name('documentgallery.upload')->middleware('permission:13');
Route::get('delete_gallery_document/{id}', [GalleryController::class, 'destroyDocument'])->name('documentgallery.delete')->middleware('permission:13');


// superadmin specific routes

Route::get('/roles',[SuperadminController::class,'roles'])->name('roles')->middleware('permission:15');
Route::post('/roles/store',[SuperadminController::class,'storeRole'])->name('roles.store')->middleware('permission:15');
Route::get('/roles/edit/{id}',[SuperadminController::class,'editRole'])->name('roles.edit')->middleware('permission:15');
Route::post('/roles/update',[SuperadminController::class,'updateRole'])->name('roles.update')->middleware('permission:15');
Route::get('/roles/delete/{id}',[SuperadminController::class,'deleteRole'])->name('roles.delete')->middleware('permission:15');

Route::get('/cities/index',[AccreditedCABController::class,'cities'])->name('cities')->middleware('permission:4');
Route::get('/editCity/{id}',[AccreditedCABController::class,'editCity'])->name('editCity')->middleware('permission:4');
Route::post('/updateCity/{id}',[AccreditedCABController::class,'updateCity'])->name('updateCity')->middleware('permission:4');
Route::post('/StoreCity',[AccreditedCABController::class,'StoreCity'])->name('StoreCity')->middleware('permission:4');
Route::get('/deleteCity/{id}',[AccreditedCABController::class,'deleteCity'])->name('deleteCity')->middleware('permission:4');

Route::get('/unauthorized', function() {
    return view('admin.unauthorized');
})->name('unauthorized');










require __DIR__.'/auth.php';
