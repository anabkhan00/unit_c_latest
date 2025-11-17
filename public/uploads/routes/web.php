<?php
use App\Http\Controllers\AccessorDocController;
use App\Http\Controllers\AccreditationSchemeController;
use App\Http\Controllers\AddSkillController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QualificationLevelController;
use App\Http\Controllers\QualificationTypeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtherSkillController;
use App\Http\Controllers\ControlDocumentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AddSchemeController;
use App\Http\Controllers\SubfieldController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\WorkExperienceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Auth\VerificationController;


use App\Models\UserDetail;

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

// Auth::routes(['verify' => true]);
// Email verification routes
Route::get('/debug-check', function () {
    return response()->json([
        'APP_ENV' => env('APP_ENV'),
        'APP_DEBUG' => env('APP_DEBUG'),
        'config_app_debug' => config('app.debug'),
    ]);
});

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->name('verification.verify')
    ->middleware('signed');
// Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Auth\VerificationController::class, 'verify'])
//     ->middleware(['signed']) 
//     ->name('verification.verify');

Route::post('/email/resend', [\App\Http\Controllers\Auth\VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');


Route::middleware(['access.control'])->group(
    function () {
Route::get('/third_screen', function () {
    return view('third_screen');
})->middleware('auth', 'verified')->name('third_screen');;

// -----------------------

// ----Auth Controller---------
Route::get('/', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('store');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::put('user/{userId}/update-details', [AuthController::class, 'updateUserDetails'])->name('user.updateUserDetails');


// --------------Login Controller-------------
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// -----------------ResetController------------
// Password Reset Routes
Route::get('/login', [ForgotPasswordController::class, 'showLoginForm'])->name('login');
Route::post('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/update-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
// -----------------------------------------------
Route::middleware('auth')->group(function () {

    // --------UserDetailController-----------
    Route::get('/user_profile', [UserDetailController::class, 'create'])->name('user.details');
    Route::post('/user_details', [UserDetailController::class, 'store'])->name('details.store');
    Route::get('/user', [UserDetailController::class, 'index'])->name('details.show');
    Route::get('/user/{id}/edit', [UserDetailController::class, 'edit'])->name('user.details.edit');
    Route::put('/user-details/{id}', [UserDetailController::class, 'update'])->name('details.update');

    // --------------------ExpertiseController------------
    Route::post('/store-expertise', [ExpertiseController::class, 'store'])->name('store.expertise');
    Route::get('/expertises', [ExpertiseController::class, 'index'])->name('expertises.index');
    Route::get('/show_expertise', [ExpertiseController::class, 'showpage'])->name('expertises.showpage');
    Route::put('/update-expertise/{id}', [ExpertiseController::class, 'update'])->name('expertise.update');
    Route::delete('/expertise/{id}', [ExpertiseController::class, 'destroy'])->name('delete.expertise');
    
    // get field and subfield dynamically
    Route::get('/get-fields-by-scheme/{id}', [ExpertiseController::class, 'getFieldsByScheme']);
    Route::get('/get-subfields-by-field/{fieldId}', [ExpertiseController::class, 'getSubfieldsByField']);


    // ---------------------QualificationController-------------
    Route::post('/qualifications/store', [QualificationController::class, 'store'])->name('qualifications.store');
    Route::get('/qualification', [QualificationController::class, 'index'])->name('qualification.index');
    Route::put('/qualifications/{id}', [QualificationController::class, 'update'])->name('qualifications.update');
    Route::delete('/qualifications/{id}', [QualificationController::class, 'destroy'])->name('qualifications.destroy');

    // ---------------------WorkExperience Controller-------------------
    Route::post('/work-experience/store', [WorkExperienceController::class, 'store'])->name('work-experience.store');
    Route::get('/work-experience/show', [WorkExperienceController::class, 'index'])->name('work-experience.index');
    Route::put('work-experience/{id}/update', [WorkExperienceController::class, 'update'])->name('work-experience.update');
    Route::delete('work-experience/{id}', [WorkExperienceController::class, 'destroy'])->name('work-experience.destroy');

    // -----------------------TrainingController-----------------
    Route::post('/training', [TrainingController::class, 'store'])->name('training.store');
    Route::get('/training/index', [TrainingController::class, 'index'])->name('training.index');
    Route::put('training/{id}', [TrainingController::class, 'update'])->name('training.update');
    Route::delete('training/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');

    // ----------------------LanguagesController-----------------
    Route::post('/languages', [LanguageController::class, 'store'])->name('languages.store');
    Route::get('/language/index', [LanguageController::class, 'index'])->name('language.index');
    Route::put('/languages/update/{id}', [LanguageController::class, 'update'])->name('languages.update');
    Route::delete('/languages/destroy/{id}', [LanguageController::class, 'destroy'])->name('languages.destroy');

    // -----------------------------OtherSkills Controller--------------
    Route::post('/other-skills', [OtherSkillController::class, 'store'])->name('other-skills.store');
    Route::get('/skill/index', [OtherSkillController::class, 'index'])->name('skills.index');
    Route::put('/other-skills/{id}', [OtherSkillController::class, 'update'])->name('other-skills.update');
    Route::delete('/other-skills/{id}', [OtherSkillController::class, 'destroy'])->name('other-skills.destroy');

    // --------------------------------Document-------------------------
    Route::post('/documents/store', [DocumentController::class, 'store'])->name('documents.store');
    Route::get('/document/index', [DocumentController::class, 'index'])->name('document.index');
    Route::put('documents/{id}/update', [DocumentController::class, 'update'])->name('documents.update');
    Route::delete('documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');
            // --------------------------AccessorDocController-----
        Route::get('/accessor_doc', [AccessorDocController::class, 'create'])->name('accessor_doc.show');
        Route::get('/get-files/{schemeId}', [AccessorDocController::class, 'getFilesByScheme']);

});
 }
);

Route::middleware(['check.role'])->group(
    function () {
// --------------------------------DashboardController---------
Route::get('/superadmin/login', [DashboardController::class, 'login'])->name('dashboard.login');
Route::get('/superadmin/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
Route::put('/superadmin/profile/update/{id}', [DashboardController::class, 'update'])->name('profile.update');
Route::get('/superadmin/all_users/{id}', [DashboardController::class, 'all_users_profile'])->name('dashboard.all_users_data');
Route::get('/superadmin/all_users/authorize/{id}', [DashboardController::class, 'all_users_authorize'])->name('dashboard.all_users_authorize');

// ----------------------DashboardController-----------------
    Route::post('/new-languages/create', [DashboardController::class, 'newLanguageStore'])->name('new.languages.store');
    Route::put('/new-languages/update/{id}', [DashboardController::class, 'newLanguageupdate'])->name('new.languages.update');
    Route::delete('/new-languages/destroy/{id}', [DashboardController::class, 'newLanguagedestroy'])->name('new.languages.destroy');



  
Route::middleware(['check.permissions'])->group(
    function () {
      Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard_users', [DashboardController::class, 'showusers'])->name('dashboard.user.show');
        Route::get('/dashboard_roles', [DashboardController::class, 'showadmin'])->name('dashboard.admin.roles');
        Route::get('/dashboard_acredetian_scheme', [DashboardController::class, 'acredetian_scheme'])->name('dashboard.acredetian');
        Route::get('/dashboard_fields', [DashboardController::class, 'showfields'])->name('dashboard.field.show');
        Route::get('/dashboard_subfields', [DashboardController::class, 'showsubfields'])->name('dashboard.subfield.show');
        Route::get('/dashboard_experience', [DashboardController::class, 'showExperience'])->name('dashboard.experience.show');
        Route::get('/dashboard_skills', [DashboardController::class, 'showskills'])->name('dashboard.skills.show');
        Route::get('/dashboard_authorization', [DashboardController::class, 'showauthorization'])->name('dashboard.authorization.show');
        Route::get('/dashboard_certification', [DashboardController::class, 'showcertification'])->name('dashboard.certification.show');
        Route::get('/dashboard_country', [DashboardController::class, 'showcountry'])->name('dashboard.country.show');
        Route::get('/dashboard_scheme', [DashboardController::class, 'showscheme'])->name('dashboard.scheme.show');
        Route::get('/dashboard_control_doc', [DashboardController::class, 'showcontroldoc'])->name('dashboard.control_doc.show');
        Route::get('/dashboard_qualification_type', [DashboardController::class, 'showqualificationtype'])->name('dashboard.showqualificationtype');
        Route::get('/dashboard_qualification_level', [DashboardController::class, 'showqualificationlevel'])->name('dashboard.showqualificationlevel');
        Route::get('/dashboard-language', [DashboardController::class, 'languageIndex'])->name('dashboard.showlanguage');
    }
);


// --------------------Acredetian Controller------------------
Route::post('/accreditation-schemes/store', [AccreditationSchemeController::class, 'store'])->name('accreditation-schemes.store');
Route::post('/accreditation-schemes/{id}', [AccreditationSchemeController::class, 'update'])->name('accreditation-schemes.update');
Route::get('/accreditation-schemes/{id}', [AccreditationSchemeController::class, 'edit'])->name('accreditation-schemes.edit');
// Route::delete('/accreditation-schemes_delete/{id}', [AccreditationSchemeController::class, 'destroy'])->name('accreditation-schemes.delete');
Route::delete('/accreditation-schemes_delete/{id}', [AccreditationSchemeController::class, 'destroy'])->name('accreditation-schemes.delete');



// ----------------------FieldController-------------------------------
Route::post('/fields/store', [FieldController::class, 'storeField'])->name('fields.store');
Route::post('/fields/update/{id}', [FieldController::class, 'updateField'])->name('fields.update');
Route::get('/fields/edit/{id}', [FieldController::class, 'edit'])->name('field.edit');
Route::delete('/fields_delete/{id}', [FieldController::class, 'destroy'])->name('fields.delete');
// ----------------------SUbFieldController-------------------------------
Route::post('/subfields/store', [SubfieldController::class, 'store'])->name('subfields.store');
Route::get('/subfields/index', [SubfieldController::class, 'index'])->name('subfields.index');
Route::put('/subfields/update/{id}', [SubfieldController::class, 'update'])->name('subfields.update');
Route::delete('/subfields_delete/{id}', [SubFieldController::class, 'destroy'])->name('subfields.delete');
Route::get('/get-accreditation/{field}', [DashboardController::class, 'getAccreditation'])->name('get.accreditation');
// ----------------------ExperienceController-------------------------------
Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
Route::get('/experience/index', [ExperienceController::class, 'index'])->name('experience.index');
Route::put('/experience/update/{id}', [ExperienceController::class, 'update'])->name('experience.update');
Route::delete('/experience_delete/{id}', [ExperienceController::class, 'destroy'])->name('experience.delete');
// ----------------------------AddSkillController------------------------
Route::post('/addskill/store', [AddSkillController::class, 'store'])->name('add_skill.store');
Route::get('/addskill/index', [AddSkillController::class, 'index'])->name('add_skill.index');
Route::put('/addskill/update/{id}', [AddSkillController::class, 'update'])->name('add_skill.update');
Route::delete('/addskill/{id}', [AddSkillController::class, 'destroy'])->name('add_skill.delete');

// ------------------------AuthorizationController------------------
Route::post('/authorization/store', [AuthorizationController::class, 'store'])->name('authorize.store');
Route::get('/authorization/index', [AuthorizationController::class, 'index'])->name('authorize.index');
Route::put('/authorization/update/{id}', [AuthorizationController::class, 'update'])->name('authorize.update');
Route::delete('/authorization/{id}', [AuthorizationController::class, 'destroy'])->name('authorize.delete');
// -------------------CertificationController---------------------
Route::post('/certification/store', [CertificationController::class, 'store'])->name('certification.store');
Route::get('/certification/index', [CertificationController::class, 'index'])->name('certification.index');
Route::put('/certification/update/{id}', [CertificationController::class, 'update'])->name('certification.update');
Route::delete('/certification/{id}', [CertificationController::class, 'destroy'])->name('certification.delete');
// -------------------------------CountryController-------------------
Route::post('/country/store', [CountryController::class, 'store'])->name('country.store');
Route::get('/country/index', [CountryController::class, 'index'])->name('country.index');
Route::put('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');
Route::delete('/country/{id}', [CountryController::class, 'destroy'])->name('country.delete');
// ---------------------------RoleController-----------------
Route::post('/role/store', [RoleController::class, 'storeRole'])->name('role.store');
Route::get('/role/show_permission', [RoleController::class, 'showPermission'])->name('role_permission.show');
Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
// ----------------------AddUserController-----------------------
Route::post('/adduser/store', [AddUserController::class, 'store'])->name('user.store');
Route::get('/adduser/role', [AddUserController::class, 'fetchrole'])->name('role.fetch');
Route::get('/adduser/index', [AddUserController::class, 'index'])->name('user.index');
Route::put('/adduser/update/{id}', [AddUserController::class, 'update'])->name('user.update');
Route::delete('/adduser/destroy/{id}', [AddUserController::class, 'destroy'])->name('user.destroy');
// Route::get('/dashboard_profile', [AddUserController::class, 'profile'])->name('dashboard.profile');
 // ----------------------------AddSchemeController-----------
        Route::post('/schemes', [AddSchemeController::class, 'storeScheme'])->name('schemes.store');
        Route::get('/schemes/{id}/edit', [AddSchemeController::class, 'edit'])->name('schemes.edit');
        Route::put('/schemes/{id}', [AddSchemeController::class, 'update'])->name('schemes.update');
        Route::delete('/schemes/{id}', [AddSchemeController::class, 'destroy'])->name('schemes.destroy');
        // --------------------------------ControlDocument--------------------------
        Route::post('/control_documents', [ControlDocumentController::class, 'store'])->name('control_documents.store');
        Route::put('/control-documents/{id}', [ControlDocumentController::class, 'update'])->name('control_doc.update');
        Route::delete('/control-documents/{id}', [ControlDocumentController::class, 'destroy'])
            ->name('control_doc.destroy');
                    // ----------------------------QualificationTypeController-----
        Route::post('/qualification-types/store', [QualificationTypeController::class, 'store'])->name('qualification-types.store');
        Route::get('/qualification-types/{id}/edit', [QualificationTypeController::class, 'edit'])->name('qualification-types.edit');
        Route::put('/qualification-types/{id}', [QualificationTypeController::class, 'update'])->name('qualification-types.update');
        Route::delete('/qualification-types/{id}', [QualificationTypeController::class, 'destroy'])->name('qualification-types.destroy');
        // ---------------------QualificationLevelController----
        Route::post('/qualification-level', [QualificationLevelController::class, 'store'])->name('qualification-level.store');
        Route::get('/qualification-level/{id}/edit', [QualificationLevelController::class, 'edit'])->name('qualification-level.edit');
        Route::put('/qualification-level/{id}', [QualificationLevelController::class, 'update'])->name('qualification-level.update');
        Route::delete('/qualification-level/{id}', [QualificationLevelController::class, 'destroy'])->name('qualification-level.destroy');

// -----------------------------AdminLoginController-----------------
Route::post('/adminlogin', [AdminLoginController::class, 'authenticated'])->name('admin_user.login');
 }
);
//
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>cache cleared</h1>';
});
