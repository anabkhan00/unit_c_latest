<?php

use App\Models\Service;
use App\Models\TrainingScheme;
use App\Http\Controllers\admin\AnnouncementController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\FieldController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\DomainController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\TrainingLoginController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DocumentController;
use App\Http\Controllers\admin\TrainerController;
use App\Http\Controllers\admin\TrainingController;
use App\Http\Controllers\TrainingSchemeController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\TrainingRegisterController;
use App\Http\Controllers\admin\PublicationController;
use App\Http\Controllers\admin\EdwardSliderController;
use App\Http\Controllers\admin\ServicepagesController;
use App\Http\Controllers\admin\AccreditedCABController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\admin\TrainingCalendarController;
use App\Http\Controllers\Traineradmin\TrainerAdminPanelController;
use App\Models\Training;

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
// Route::get('/training-admin', function () {
//     return view('training.layout.main');
// });
Route::get('verify/{email}', [TrainingController::class, 'verify']);
Route::get('/training-admin/login',[TrainerAdminPanelController::class,'training_admin_login']);
Route::post('/training-admin/login',[TrainerAdminPanelController::class,'training_admin_store'])->name('training_admin_store');
Route::middleware('auth')->group(function () {
    Route::get('/training-admin',[TrainerAdminPanelController::class,'training_admin']);
    Route::get('/training-admin/logout',[TrainerAdminPanelController::class,'destroy'])->name('training_admin_logout');
});

// Route::get('qrcode', function () {

//     return QrCode::size(300)->generate('A basic example of QR code!');
// });

Route::get('/dashboard', function () {
    $services = Service::all();
    return view('dashboard', compact('services'));
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');





    Route::get('/service/index', [ServiceController::class, 'ServiceIndex'])->name('service.index');
    Route::get('/create/service', [ServiceController::class, 'createService'])->name('create.service');
    Route::post('/stotre/service', [serviceController::class, 'storeService'])->name('store.service');
    Route::get('/edit/service/{id}', [serviceController::class, 'editService'])->name('edit.service');
    Route::post('/update/service/{id}', [serviceController::class, 'updateService'])->name('update.service');
    Route::get('/delete/service/{id}', [serviceController::class, 'deleteService'])->name('delete.service');

    Route::get('/category/search/{category}', [AccreditedCABController::class, 'AccreditedCABsearch'])->name('category.search');
    Route::get('/accredited-cab/index', [AccreditedCABController::class, 'AccreditedCABIndex'])->name('cab.index');
    Route::get('/create/accredited-cab', [AccreditedCABController::class, 'createAccreditedCAB'])->name('create.cab');
    Route::post('/stotre/accredited-cab', [AccreditedCABController::class, 'storeAccreditedCAB'])->name('store.cab');
    Route::get('/edit/accredited-cab/{id}', [AccreditedCABController::class, 'editAccreditedCAB'])->name('edit.cab');
    Route::post('/update/accredited-cab/{id}', [AccreditedCABController::class, 'updateAccreditedCAB'])->name('update.cab');
    Route::post('/delete/accredited-cab', [AccreditedCABController::class, 'deleteAccreditedCAB'])->name('delete.cab');
    Route::get('/change-status/{status}/{id}', [AccreditedCABController::class, 'change_status'])->name('change_status');
    Route::post('/update-status', [AccreditedCABController::class, 'update_status'])->name('update.status');
    Route::post('/suspended/update/{id}', [AccreditedCABController::class, 'suspended_update'])->name('update.suspended');
    Route::post('/withdrawl/update/{id}', [AccreditedCABController::class, 'withdrawl_update'])->name('update.withdrawl');

    // Import & Export Csv File
    Route::post('/import-publication', [PublicationController::class, 'importPublication'])->name('import.publication');

    Route::post('/import', [AccreditedCABController::class, 'import'])->name('import');
    Route::get('/export', [AccreditedCABController::class, 'export'])->name('export');




    // Page
    Route::get('/page/index', [PageController::class, 'PageIndex'])->name('page.index');
    Route::get('/create/page', [PageController::class, 'createPage'])->name('create.page');
    Route::post('/stotre/page', [PageController::class, 'storePage'])->name('store.page');
    Route::get('/edit/page/{id}', [PageController::class, 'editPage'])->name('edit.page');
    Route::post('/update/page/{id}', [PageController::class, 'updatePage'])->name('update.page');
    Route::get('/delete/page/{id}', [PageController::class, 'deletePage'])->name('delete.page');


    // Training Calendar
    Route::get('/training-calendar/index', [TrainingCalendarController::class, 'TrainingCalendarIndex'])->name('training.calendar.index');
    Route::get('/create/training-calendar', [TrainingCalendarController::class, 'createTrainingCalendar'])->name('create.calendar');
    Route::post('/stotre/training-calendar', [TrainingCalendarController::class, 'storeTrainingCalendar'])->name('store.calendar');
    Route::get('/edit/training-calendar/{id}', [TrainingCalendarController::class, 'editTrainingCalendar'])->name('edit.calendar');
    Route::post('/update/training-calendar/{id}', [TrainingCalendarController::class, 'updateTrainingCalendar'])->name('update.calendar');
    Route::get('/delete/training-calendar/{id}', [TrainingCalendarController::class, 'deleteTrainingCalendar'])->name('delete.calendar');


    //Training


    Route::get('/training/index', [TrainingController::class, 'TrainingIndex'])->name('training.index');
    Route::get('/create/training', [TrainingController::class, 'createTraining'])->name('create.training');
    Route::post('/store/training', [TrainingController::class, 'storeTraining'])->name('store.training');
    Route::get('/edit/training/{id}', [TrainingController::class, 'editTraining'])->name('edit.training');
    Route::post('/update/training/{id}', [TrainingController::class, 'updateTraining'])->name('update.training');
    Route::get('/delete/training/{id}', [TrainingController::class, 'deleteTraining'])->name('delete.training');
   
    



    // user
    Route::get('/user/index', [UserController::class, 'UserIndex'])->name('user.index');
    Route::get('/create/user', [UserController::class, 'createUser'])->name('create.user');
    Route::post('/stotre/user', [UserController::class, 'storeUser'])->name('store.user');
    Route::get('/edit/user/{id}', [UserController::class, 'editUser'])->name('edit.user');
    Route::post('/update/user/{id}', [UserController::class, 'updateUser'])->name('update.user');
    Route::get('/delete/user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');


    // Upload Media
    Route::get('/create/gallery-content', [MediaController::class, 'createGallery'])->name('create.gallery.content');
    Route::post('/store/gallery-content', [MediaController::class, 'storeGallery'])->name('store.gallery');

    Route::get('/upload-file', [MediaController::class, 'uploadGallery'])->name('upload.gallery');
    Route::post('/store/document', [MediaController::class, 'storeDocument'])->name('store.document');
    Route::get('/show-doc/{id}', [MediaController::class, 'ShowDoc'])->name('show.doc');
    Route::get('/delete-doc/{id}', [MediaController::class, 'deleteDoc'])->name('delete.doc');


    // News & Update

    Route::get('/news/index', [NewsController::class, 'NewsIndex'])->name('news.index');
    Route::get('/create/news', [NewsController::class, 'createNews'])->name('create.news');
    Route::post('/stotre/news', [NewsController::class, 'storeNews'])->name('store.news');
    Route::get('/edit/news/{id}', [NewsController::class, 'editNews'])->name('edit.news');
    Route::post('/update/news/{id}', [NewsController::class, 'updateNews'])->name('update.news');
    Route::get('/delete/news/{id}', [NewsController::class, 'deleteNews'])->name('delete.news');


    // Edward Slider

    Route::get('/edward-slider/index', [EdwardSliderController::class, 'EdwardSliderIndex'])->name('edward.index');
    Route::get('/create/edward-slider', [EdwardSliderController::class, 'createEdwardSlider'])->name('create.edward');
    Route::post('/stotre/edward-slider', [EdwardSliderController::class, 'storeEdwardSlider'])->name('store.edward');
    Route::get('/edit/edward-slider/{id}', [EdwardSliderController::class, 'editEdwardSlider'])->name('edit.edward');
    Route::post('/update/edward-slider/{id}', [EdwardSliderController::class, 'updateEdwardSlider'])->name('update.edward');
    Route::get('/delete/edward-slider/{id}', [EdwardSliderController::class, 'deleteEdwardSlider'])->name('delete.edward');


    // Contact

    Route::get('/contact/index', [ContactController::class, 'ContactIndex'])->name('contact.index');
    Route::get('/edit/contact/{id}', [ContactController::class, 'editContact'])->name('edit.contact');
    Route::post('/update/contact/{id}', [ContactController::class, 'updateContact'])->name('update.contact');
    Route::get('/delete/contact/{id}', [ContactController::class, 'deleteContact'])->name('delete.contact');


    // Publication

    Route::get('/publication/index', [PublicationController::class, 'PublicationIndex'])->name('publication.index');
    Route::get('/create/publication', [PublicationController::class, 'createPublication'])->name('create.publication');
    Route::post('/store/publication', [PublicationController::class, 'storePublication'])->name('store.publication');
    Route::get('/edit/publication/{id}', [PublicationController::class, 'editPublication'])->name('edit.publication');
    Route::post('/update/publication/{id}', [PublicationController::class, 'updatePublication'])->name('update.publication');
    Route::get('/delete/publication/{id}', [PublicationController::class, 'deletePublication'])->name('delete.publication');

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

    Route::get('/category/index', [CategoryController::class, 'CategoryIndex'])->name('category.index');
    Route::get('/create/category', [CategoryController::class, 'createCategory'])->name('create.category');
    Route::post('/store/category', [CategoryController::class, 'storeCategory'])->name('store.category');
    Route::get('/edit/category/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update/category/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');
    Route::get('/delete/category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');


    // Domain

    Route::get('/domain/index', [DomainController::class, 'DomainIndex'])->name('domain.index');
    Route::get('/create/domain', [DomainController::class, 'createDomain'])->name('create.domain');
    Route::post('/store/domain', [DomainController::class, 'storeDomain'])->name('store.domain');
    Route::get('/edit/domain/{id}', [DomainController::class, 'editDomain'])->name('edit.domain');
    Route::post('/update/domain/{id}', [DomainController::class, 'updateDomain'])->name('update.domain');
    Route::get('/delete/domain/{id}', [DomainController::class, 'deleteDomain'])->name('delete.domain');


    // Document

    Route::get('/document/index', [DocumentController::class, 'DocumentIndex'])->name('document.index');
    Route::get('/create/document', [DocumentController::class, 'createDocument'])->name('create.document');
    Route::post('/store/document', [DocumentController::class, 'storeDocument'])->name('store.document');
    Route::get('/edit/document/{id}', [DocumentController::class, 'editDocument'])->name('edit.document');
    Route::post('/update/document/{id}', [DocumentController::class, 'updateDocument'])->name('update.document');
    Route::get('/delete/document/{id}', [DocumentController::class, 'deleteDocument'])->name('delete.document');


    // Field

    Route::get('/field/index', [FieldController::class, 'FieldIndex'])->name('field.index');
    Route::get('/create/field', [FieldController::class, 'createField'])->name('create.field');
    Route::post('/store/field', [FieldController::class, 'storeField'])->name('store.field');
    Route::get('/edit/field/{id}', [FieldController::class, 'editField'])->name('edit.field');
    Route::post('/update/field/{id}', [FieldController::class, 'updateField'])->name('update.field');
    Route::get('/delete/field/{id}', [FieldController::class, 'deleteField'])->name('delete.field');


    // Sub Field

    Route::get('/sub-field/index', [FieldController::class, 'SubFieldIndex'])->name('sub.field.index');
    Route::get('/create/sub-field', [FieldController::class, 'createSubField'])->name('create.sub.field');
    Route::post('/store/sub-field', [FieldController::class, 'storeSubField'])->name('store.sub.field');
    Route::get('/edit/sub-field/{id}', [FieldController::class, 'editSubField'])->name('edit.sub.field');
    Route::post('/update/sub-field/{id}', [FieldController::class, 'updateSubField'])->name('update.sub.field');
    Route::get('/delete/sub-field/{id}', [FieldController::class, 'deleteSubField'])->name('delete.sub.field');

    //City
    Route::get('/city/index', [CityController::class, 'CityIndex'])->name('city.index');
    Route::get('/create/city', [CityController::class, 'createCity'])->name('create.city');
    Route::post('/store/city', [CityController::class, 'storeCity'])->name('store.city');
    Route::get('/edit/city/{id}', [CityController::class, 'editCity'])->name('edit.city');
    Route::post('/update/city/{id}', [CityController::class, 'updateCity'])->name('update.city');
    Route::get('/delete/city/{id}', [CityController::class, 'deleteCity'])->name('delete.city');


    //Country
    Route::get('/country/index', [CountryController::class, 'CountryIndex'])->name('Country.index');
    Route::get('/create/country', [CountryController::class, 'createCountry'])->name('create.Country');
    Route::post('/store/country', [CountryController::class, 'storeCountry'])->name('store.Country');
    Route::get('/edit/country/{id}', [CountryController::class, 'editCountry'])->name('edit.Country');
    Route::post('/update/country/{id}', [CountryController::class, 'updateCountry'])->name('update.Country');
    Route::get('/delete/country/{id}', [CountryController::class, 'deleteCountry'])->name('delete.Country');

    //status
    Route::get('/status/index', [StatusController::class, 'StatusIndex'])->name('Status.index');
    Route::get('/create/status', [StatusController::class, 'createStatus'])->name('create.Status');
    Route::post('/store/status', [StatusController::class, 'storeStatus'])->name('store.Status');
    Route::post('/delete/status/{id}', [StatusController::class, 'deleteStatus'])->name('delete.Status');

    //Training scheme
    Route::get('/scheme/index', [TrainingSchemeController::class, 'SchemeIndex'])->name('Scheme.index');
    Route::get('/create/scheme', [TrainingSchemeController::class, 'createScheme'])->name('create.Scheme');
    Route::post('/store/scheme', [TrainingSchemeController::class, 'storeScheme'])->name('store.Scheme');
    Route::get('/delete/scheme/{id}', [TrainingSchemeController::class, 'deleteScheme'])->name('delete.Scheme');


    //Training type
    Route::get('/type/index', [TrainingTypeController::class, 'TypesIndex'])->name('Types.index');
    Route::get('/create/type', [TrainingTypeController::class, 'createTypes'])->name('create.Types');
    Route::post('/store/type', [TrainingTypeController::class, 'storeTypes'])->name('store.Types');
    Route::get('/delete/type/{id}', [TrainingTypeController::class, 'deleteTypes'])->name('delete.Types');
    
    
    
    
    
    //trainer
Route::resource('trainer',TrainerController::class);
});

    //announcement
          Route::resource('announcement',AnnouncementController::class);





// website routes
Route::get('/', [WebsiteController::class, 'training'])->name('home');

Route::get('Page/Construct', [WebsiteController::class, 'constructPage'])->name('page.construct');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::post('/create-contact', [WebsiteController::class, 'StoreContact'])->name('store.contact');
Route::get('/dg-pnac-profile', [WebsiteController::class, 'dg_pnac_profile'])->name('dg_pnac_profile');
Route::get('/TestingandCalibrationLaboratoies/{status}', [WebsiteController::class, 'TestingCalibrationLaboratoies'])->name('TestingCalibrationLaboratoies');
Route::get('/TestingandCalibrationLaboratories/{status}', [WebsiteController::class, 'TestingCalibrationLaboratoies'])->name('TestingAndCalibrationLaboratories');

Route::get('/Certification-Bodies/{status}', [WebsiteController::class, 'CertificationBodies'])->name('CertificationBodies');
Route::get('/Medical-Laboratories/{status}', [WebsiteController::class, 'MedicalLabs'])->name('MedicalLaboratories');
Route::get('/Medical-Laboratories/{status}', [WebsiteController::class, 'MedicalLabs'])->name('MedicalLaboratories');
Route::get('/Inspection-Bodies/{status}', [WebsiteController::class, 'InspectionBodies1'])->name('InspectionBodies');
Route::get('/Halal-Certification-Bodies/{status}', [WebsiteController::class, 'HalalCertificationBodies'])->name('HalalCertificationBodies');
Route::get('/Proficiency-Testing-Provider/{status}', [WebsiteController::class, 'ProficiencyTestingProvider'])->name('ProficiencyTestingProvider');
Route::get('/Product-Certification-Bodies/{status}', [WebsiteController::class, 'ProductCertificationBodies'])->name('ProductCertificationBodies');
Route::get('/Personnel-Certification-Bodies/{status}', [WebsiteController::class, 'PersonnalCertificationBodies'])->name('PersonnelCertificationBodies');
Route::get('/Search-AccreditCAB/{status}', [WebsiteController::class, 'SearchAccreditCAB'])->name('SearchAccreditCAB');
Route::get('/searchbar', [WebsiteController::class, 'searchbars'])->name('search.bar');
Route::get('/search/certification-bodies', [WebsiteController::class, 'SearchCertificationBodies'])->name('search.certification.bodies');




Route::get('/testing_active/{id}', [WebsiteController::class, 'testing_active'])->name('testing_active');

Route::get('/Publication', [WebsiteController::class, 'WebsitePublication'])->name('website.publication');
Route::get('/Download-Publication/{id}', [WebsiteController::class, 'DownloadPublication'])->name('download.publication');
Route::get('/SearchPublication/{id}', [WebsiteController::class, 'SearchPublication'])->name('search.publication');


// About Us
Route::get('/About-Us/Introduction', [WebsiteController::class, 'Introduction'])->name('introduction');
Route::get('/About-Us/International-Linkage', [WebsiteController::class, 'InternationalLinkage'])->name('international.linkage');
Route::get('/About-Us/Work-Stakeholders', [WebsiteController::class, 'WorkStakeholders'])->name('work.stakeholders');
Route::get('/About-Us/About-Accreditation', [WebsiteController::class, 'AboutAccreditation'])->name('about.accreditation');
Route::get('/About-Us/Benefits-Accreditation', [WebsiteController::class, 'BenefitsAccreditation'])->name('benefits.accreditation');
Route::get('/About-Us/Structure', [WebsiteController::class, 'Structure'])->name('structure');
Route::get('/About-Us/PNAC-Act', [WebsiteController::class, 'PNACAct'])->name('PNAC.act');
Route::get('/About-Us/PNAC-Rules', [WebsiteController::class, 'PNACRules'])->name('PNAC.rules');
Route::get('/About-Us/Impartiality-Polic', [WebsiteController::class, 'ImpartialityPolic'])->name('impartiality.polic');
Route::get('/About-Us/Mission-Vision', [WebsiteController::class, 'MissionVision'])->name('mission.vision');
Route::get('/About-Us/Annual-Reports', [WebsiteController::class, 'AnnualReports'])->name('annual.reports');
Route::get('/About-Us/Long-Term-Plan', [WebsiteController::class, 'LongTerm'])->name('long.term');
Route::get('/About-Us/NewsLetter', [WebsiteController::class, 'NewsLetter'])->name('news.letter');
Route::get('/About-Us/PNAC-Footprint', [WebsiteController::class, 'PNACFootprint'])->name('PNAC.footprint');
Route::get('/About-Us/HR-Plan', [WebsiteController::class, 'HRPlan'])->name('hr.plan');
Route::get('/About-Us/Pnac-Committees', [WebsiteController::class, 'PnacCommittees'])->name('pnac.committees');
Route::get('/About-Us/harassment-of-women', [WebsiteController::class, 'HarassmentWomen'])->name('harassment.women');
Route::get('/history-panac', [WebsiteController::class, 'history'])->name('history');

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
Route::get('/Services/Testing-and-Calibration-Laboratories', [WebsiteController::class, 'servicesCAB'])->name('testing.calibration');
Route::get('/Services/Certification-Bodies', [WebsiteController::class, 'servicesCAB'])->name('services.certification.bodies');
Route::get('/Services/Medical-Laboratories', [WebsiteController::class, 'servicesCAB'])->name('medical.laboratories');
Route::get('/Services/Inspection-Bodies', [WebsiteController::class, 'servicesCAB'])->name('inspection.bodies');
Route::get('/Services/Halal-Certification-Bodies', [WebsiteController::class, 'servicesCAB'])->name('halal.certification');
Route::get('/Services/Proficiency-Testing-Provider', [WebsiteController::class, 'servicesCAB'])->name('proficiency.testing');
Route::get('/Services/Product-Certification-Bodies', [WebsiteController::class, 'servicesCAB'])->name('product.certification');
Route::get('/Services/Personnel-Certification-Bodies', [WebsiteController::class, 'servicesCAB'])->name('personnel.certification');
Route::get('/How-to-apply', [WebsiteController::class, 'apply'])->name('How-to-apply');
// service pages
Route::resource('servicepage', ServicepagesController::class);

// Services Other Services

Route::get('/Services/Accreditation-Process', [WebsiteController::class, 'AccreditationProcess'])->name('accreditation.process');
Route::get('/Services/Grievance-Pensioners', [WebsiteController::class, 'GrievancePensioners'])->name('grievance.pensioners');
Route::get('/Services/Complaint-Appeals', [WebsiteController::class, 'ComplaintAppeals'])->name('complaint.appeals');
Route::get('/Services/Lists-Proficiency', [WebsiteController::class, 'ListsProficiency'])->name('lists.proficiency');
Route::get('/Services/TaxRegistration-Numbers', [WebsiteController::class, 'TaxRegistrationNumbers'])->name('taxRegistration.numbers');
Route::get('/Services/Foreign-Currency', [WebsiteController::class, 'ForeignCurrency'])->name('foreign.currency');
Route::get('/Services/Accreditation-Fee', [WebsiteController::class, 'AccreditationFee'])->name('accreditation.fee');
//traing

Route::get('/training', [WebsiteController::class, 'training'])->name('training');
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
Route::post('/verify-otp', [TrainingController::class, 'verify_otp'])->name('verify-otp');

//
Route::post('/Trailogin', [TrainingController::class,'trainingstore'])->name( 'Train.login');
Route::get('/registration', [TrainingController::class, 'Trainingregistration'])->name('training.registration');
Route::post('/Trairegistr', [TrainingController::class, 'trairegister'])->name('traini.Registr');
Route::get('training-logout',[TrainingController::class,'TrainingLogout'])->name('training.logout');
Route::get('/training/dashboard', [TrainingController::class, 'dashboardTraining'])->name('training.home');
Route::get('profile-data/{id}', [TrainingController::class, 'profile_data'])->name('profile_data');
Route::post('profile-data-store/{id}', [TrainingController::class, 'profile_data_store'])->name('profile_data_store');
Route::get('/training/feedback', [TrainingController::class, 'feedbackTraining'])->name('feedbackTraining');

//to store feedback for individual training
Route::get('training/addfeedback/{id}', [TrainingController::class, 'addTrainingFeedback'])->name('addTrainingFeedback');

Route::post('/training/feedback/store', [TrainingController::class, 'feedbackTrainingstore'])->name('feedbackTrainingstore');
Route::get('/training/feedback/index', [TrainingController::class, 'feedbackTrainingindex'])->name('feedbackTrainingindex');
Route::get('/training/feedback/show/{id}', [TrainingController::class, 'feedbackTrainingshow'])->name('feedbackTrainingshow');
Route::get('/close-training/{status}',[TrainingController::class,'TrainingDashboardStatus'])->name('training.status');
Route::get('/laboratory-accredi-content/{name}', [TrainingController::class, 'LabAccrediatContent'])->name('laboraccrediat.content');
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
Route::get('/list-participants', [TrainingController::class, 'participants'])->name('participants');
// traingUser login side

Route::get('trainguser-profile', [TrainingController::class, 'trainguser_profile'])->name('trainguser_profile');
Route::get('trainguser-profile-edit', [TrainingController::class, 'trainguser_profile_edit'])->name('trainguser_profile_edit');
Route::post('trainguser-profile-store', [TrainingController::class, 'trainguser_profile_store'])->name('trainguser_profile_store');





// Gallery
Route::get('/gallery', [WebsiteController::class, 'Gallery'])->name('gallery');
//carrer

Route::get('/carrer', [WebsiteController::class, 'carrer'])->name('carrer');
//feedback
Route::get('/feedback', [WebsiteController::class, 'feedback'])->name('feedback');

//faq

Route::get('/faq', [WebsiteController::class, 'faq'])->name('faq');
//sitemap

Route::get('/sitemap', [WebsiteController::class, 'sitemap'])->name('sitemap');

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

Route::get('/optimize-clear', function() {
    $exitCode = Artisan::call('optimize:clear');
    return '<h1>Optimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


