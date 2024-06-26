<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [App\Http\Controllers\GeneralController::class, 'index']);

Route::get('change-language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'ar'])) {
        abort(404);
    }

    App::setLocale($locale);
    // Session
    session()->put('locale', $locale);

    return redirect()->back();
})->name('change-lang');

Auth::routes();

// Fund Raising Request Route
Route::get('fund-raising-request', [App\Http\Controllers\FundRaisingRequestController::class, 'fundRequest'])->name('fund-raising-request');
Route::post('fund-raising-request', [App\Http\Controllers\FundRaisingRequestController::class, 'addFundRequest'])->name('postFund-raising-request');


Route::group(['middleware' => ['auth', 'verified']], function () {
    //Registration Steps
//    Route::get('/register/step/{step}', [App\Http\Controllers\HomeController::class, 'registerSteps'])->name('step');
//    Route::post('/register/step/{step}', [App\Http\Controllers\HomeController::class, 'postRegisterSteps'])->name('step');

    //Id Verification
    Route::get('/register/step/id-verification', [App\Http\Controllers\HomeController::class, 'registerIdVerification'])->name('id-verification')->middleware('id_verification');
    Route::post('/register/step/id-verification', [App\Http\Controllers\HomeController::class, 'postRegisterIdVerification'])->name('id-verification')->middleware('id_verification');
    Route::post('/register/step/id-verification/status', [App\Http\Controllers\HomeController::class, 'idVerificationStatus'])->name('stepIdVerificationStatus');

    //National Address Verification
    Route::get('/register/step/national-address-verification', [App\Http\Controllers\HomeController::class, 'registerNationalAddress'])->name('stepAddressVerification')->middleware('id_verification');
    Route::post('/register/step/national-address-verification', [App\Http\Controllers\HomeController::class, 'postRegisterNationalAddress']);
    //General Info
    Route::get('/register/step/general-info', [App\Http\Controllers\HomeController::class, 'registerGeneralInfo'])->name('general-info')->middleware('general_info');
    Route::post('/register/step/general-info', [App\Http\Controllers\HomeController::class, 'postRegisterGeneralInfo'])->name('general-info')->middleware('general_info');
    //Financial Status
    Route::get('/register/step/financial-status', [App\Http\Controllers\HomeController::class, 'registerFinancialStatus'])->name('financial-status')->middleware('financial_status');
    Route::post('/register/step/financial-status', [App\Http\Controllers\HomeController::class, 'postRegisterFinancialStatus'])->name('financial-status')->middleware('financial_status');

//    Investor Dashboard
    Route::group(['middleware' => ['is_investor'], 'prefix' => 'investor'], function () {

        Route::get('/home/{filter?}', [App\Http\Controllers\InvestorController::class, 'index'])->name('investor.home');
        // Investment Chart Route
        Route::post('/home/chart', [App\Http\Controllers\InvestorController::class, 'index'])->name('investor.home.chart');

        // My Projects
        Route::get('/projects', [\App\Http\Controllers\investor\MyProjectsController::class, 'projects'])->name('investor.projects');
        Route::get('/projects/search', [\App\Http\Controllers\investor\MyProjectsController::class, 'projects'])->name('investor.projects.search');
        Route::get('/project/{id}', [\App\Http\Controllers\investor\MyProjectsController::class, 'projectsDeatils'])->name('investor.projects.detail');
        Route::get('/project/{id}/invest', [\App\Http\Controllers\investor\MyProjectsController::class, 'projectsInvest'])->name('investor.project.invest')->middleware('check_investor_steps');
        Route::post('/project/{id}/invest', [\App\Http\Controllers\investor\MyProjectsController::class, 'postProjectsInvest'])->name('investor.project.invest');
        Route::post('/project/otp/verified', [\App\Http\Controllers\investor\MyProjectsController::class, 'verifyOTP'])->name('investor.project.otp');

        //Wallet Route
        Route::get('wallet/list', [\App\Http\Controllers\WalletController::class, 'wallet'])->name('investor.wallet');
        Route::get('wallet/listing', [\App\Http\Controllers\WalletController::class, 'index'])->name('investor.wallet.list');
        Route::post('withdraw-request', [\App\Http\Controllers\WalletController::class, 'postWithdrawRequest'])->name('investor.wallet.withdrawRequest');
        Route::post('withdraw-request/confirm', [\App\Http\Controllers\WalletController::class, 'postWithdrawRequestConfirm'])->name('investor.wallet.withdrawRequest.confirm');

        //Vote
        Route::get('vote', [\App\Http\Controllers\VoteController::class, 'voteList'])->name('investor.vote');
        Route::get('vote/listing', [\App\Http\Controllers\VoteController::class, 'index'])->name('investor.vote.list');
        Route::get('vote/listing2', [\App\Http\Controllers\VoteController::class, 'index2'])->name('investor.vote.list2');
        Route::get('vote/{id}', [\App\Http\Controllers\VoteController::class, 'getVoteCampaign'])->name('investor.vote.view');
        Route::post('vote/investor', [\App\Http\Controllers\VoteController::class, 'castInvestorVote'])->name('investor.vote.investor');

        // Share For Sale
        Route::group(['prefix' => 'buy'], function () {
            Route::get('share', [\App\Http\Controllers\investor\BuySharesController::class, 'getBuyShares'])->name('investor.buy.shares');
            Route::get('share/listing', [\App\Http\Controllers\investor\BuySharesController::class, 'index'])->name('investor.buy.shares.list');
            Route::get('share/bidding/listing', [\App\Http\Controllers\investor\BuySharesController::class, 'bidList'])->name('investor.buy.shares.bid.list');
            Route::get('share/details/{id}', [\App\Http\Controllers\investor\BuySharesController::class, 'shareDetails'])->name('investor.buy.shares.details');
            Route::post('share/place/bid', [\App\Http\Controllers\investor\BuySharesController::class, 'placeBid'])->name('investor.place.bid');
        });
        Route::group(['prefix' => 'sell'], function () {
            Route::get('share', [\App\Http\Controllers\investor\SellSharesController::class, 'getsellShares'])->name('investor.sell.shares');
            Route::get('share/listing', [\App\Http\Controllers\investor\SellSharesController::class, 'index'])->name('investor.sell.shares.list');
            Route::get('share/bidding/offer/listing', [\App\Http\Controllers\investor\SellSharesController::class, 'bidOfferList'])->name('investor.sell.shares.bidding_offer.list');
            Route::get('share/investor', [\App\Http\Controllers\investor\SellSharesController::class, 'sellShares'])->name('investor.sell.ownShares');
            Route::post('share/project', [\App\Http\Controllers\investor\SellSharesController::class, 'postSellShares'])->name('investor.sell.sellshare');
            Route::post('share/bid/status', [\App\Http\Controllers\investor\SellSharesController::class, 'changeStatusBidding'])->name('investor.sell.bid.statusChange');
        });

        // My Portfolio Route
        Route::get('my-portfolio', [\App\Http\Controllers\investor\MyPortfolioController::class, 'myPortfolio'])->name('investor.my-portfolio');
        Route::get('my-portfolio/listing', [\App\Http\Controllers\investor\MyPortfolioController::class, 'index'])->name('investor.my-portfolio.list');


        //Help Center
        Route::get('help-center', [\App\Http\Controllers\HelpCenterController::class, 'helpCenter'])->name('investor.help-center');
        Route::post('submit', [\App\Http\Controllers\HelpCenterController::class, 'submit'])->name('investor.submit');

        // Settings
        Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('investor.settings');
        Route::put('profile-settings', [\App\Http\Controllers\SettingsController::class, 'updateProfileSettings'])->name('investor.profile-settings');
        Route::put('back-acount', [\App\Http\Controllers\SettingsController::class, 'updateBankAccount'])->name('investor.back-account');
        Route::put('mobile', [\App\Http\Controllers\SettingsController::class, 'updateMobileNumber'])->name('investor.mobile');

        // Performance
        Route::get('performance', [\App\Http\Controllers\PerformanceController::class, 'index'])->name('investor.performance');
        Route::post('performance/details', [\App\Http\Controllers\PerformanceController::class, 'performanceReportDetails'])->name('investor.performance.info');

        //Performance PDF Route
        Route::get('investor/pdf/{report_id}', [\App\Http\Controllers\PerformanceController::class, 'generatePDF'])->name('investor.pdf');

        //Upgrade to pro
        Route::get('upgrade-to-pro', [\App\Http\Controllers\UpgradeToPro::class, 'index'])->name('investor.upgrade');
        Route::post('upgrade-to-pro', [\App\Http\Controllers\UpgradeToPro::class, 'postPro'])->name('investor.upgrade.post');


    });
    //Get User Notifications
    Route::get('investor/notification', [HomeController::class, 'usersNotification'])->name('investor.notifications');

    //Admin Routes
    Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin'], function () {
        Route::get('home', [\App\Http\Controllers\AdminController::class, 'adminHome'])->name('admin.home');
        //Category Routes
        Route::get('category/list', [\App\Http\Controllers\CategoryController::class, 'categoryList'])->name('admin.category');
        Route::get('category/listing', [\App\Http\Controllers\CategoryController::class, 'index'])->name('admin.category.list');
        Route::get('category/add', [\App\Http\Controllers\CategoryController::class, 'addCategory'])->name('admin.category.add');
        Route::post('category/add', [\App\Http\Controllers\CategoryController::class, 'postAddCategory'])->name('admin.category.add');
        Route::get('category/edit/{category:id}', [\App\Http\Controllers\CategoryController::class, 'editCategory'])->name('admin.category.edit');
        Route::post('category/edit', [\App\Http\Controllers\CategoryController::class, 'postEditCategory'])->name('admin.category.postEdit');
        Route::post('category/delete', [\App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('admin.category.delete');

        //Company Routes
        Route::get('company/list', [\App\Http\Controllers\CompanyController::class, 'companyList'])->name('admin.company');
        Route::get('company/listing', [\App\Http\Controllers\CompanyController::class, 'index'])->name('admin.company.list');
        Route::get('company/add', [\App\Http\Controllers\CompanyController::class, 'addCompany'])->name('admin.company.add');
        Route::post('company/add', [\App\Http\Controllers\CompanyController::class, 'postAddCompany'])->name('admin.company.add');
        Route::get('company/edit/{company:id}', [\App\Http\Controllers\CompanyController::class, 'editCompany'])->name('admin.company.edit');
        Route::post('company/edit', [\App\Http\Controllers\CompanyController::class, 'postEditCompany'])->name('admin.company.postEdit');
        Route::post('company/status', [\App\Http\Controllers\CompanyController::class, 'statusCompany'])->name('admin.company.status');

        //Projects Routes
        Route::get('projects/list', [\App\Http\Controllers\ProjectsController::class, 'projectsList'])->name('admin.projects');
        Route::get('projects/listing', [\App\Http\Controllers\ProjectsController::class, 'index'])->name('admin.projects.list');
        Route::post('city', [\App\Http\Controllers\ProjectsController::class, 'getCities'])->name('city');
        Route::get('projects/add', [\App\Http\Controllers\ProjectsController::class, 'addProjects'])->name('admin.projects.add');

        Route::post('projects/add/projectInfo', [\App\Http\Controllers\ProjectsController::class, 'addProjectInfo'])->name('admin.projects.addProjectInfo');
        Route::post('projects/edit/projectInfo', [\App\Http\Controllers\ProjectsController::class, 'editProjectInfo'])->name('admin.projects.editProjectInfo');

        Route::post('projects/add/ProjectDetails', [\App\Http\Controllers\ProjectsController::class, 'addProjectDetails'])->name('admin.projects.addProjectDetails');
        Route::post('projects/edit/ProjectDetails', [\App\Http\Controllers\ProjectsController::class, 'editProjectDetails'])->name('admin.projects.editProjectDetails');

        Route::post('projects/add/projectLocation', [\App\Http\Controllers\ProjectsController::class, 'addProjectLocation'])->name('admin.projects.addProjectLocation');

        Route::post('projects/add/projectFunding', [\App\Http\Controllers\ProjectsController::class, 'addProjectFunding'])->name('admin.projects.addProjectFunding');
        Route::post('projects/edit/projectFunding', [\App\Http\Controllers\ProjectsController::class, 'editProjectFunding'])->name('admin.projects.editProjectFunding');

        Route::post('projects/add/projectSponsor', [\App\Http\Controllers\ProjectsController::class, 'addProjectSponsor'])->name('admin.projects.addProjectSponsor');
        Route::post('projects/edit/projectSponsor', [\App\Http\Controllers\ProjectsController::class, 'editProjectSponsor'])->name('admin.projects.editProjectSponsor');
        Route::post('projects/edit/remove/sponsor', [\App\Http\Controllers\ProjectsController::class, 'removeProjectSponsor'])->name('admin.projects.removeProjectSponsor');

        Route::post('projects/add/projectDoc', [\App\Http\Controllers\ProjectsController::class, 'addProjectDoc'])->name('admin.projects.addProjectDoc');
        Route::post('projects/edit/projectDoc', [\App\Http\Controllers\ProjectsController::class, 'editProjectDoc'])->name('admin.projects.editProjectDoc');
        Route::post('projects/remove/doc', [\App\Http\Controllers\ProjectsController::class, 'removeProjectDoc'])->name('admin.projects.removeProjectDoc');

        Route::post('projects/add/projectUploads', [\App\Http\Controllers\ProjectsController::class, 'addProjectUploads'])->name('admin.projects.addProjectUploads');
        Route::post('projects/edit/projectUploads', [\App\Http\Controllers\ProjectsController::class, 'editProjectUploads'])->name('admin.projects.editProjectUploads');
        Route::post('projects/edit/remove/uploads', [\App\Http\Controllers\ProjectsController::class, 'removeProjectUploads'])->name('admin.projects.removeProjectUploads');

        Route::get('projects/edit/{projects:id}', [\App\Http\Controllers\ProjectsController::class, 'editProjects'])->name('admin.projects.edit');
        Route::post('projects/edit', [\App\Http\Controllers\ProjectsController::class, 'postEditProjects'])->name('admin.projects.postEdit');
        Route::get('projects/view/{projects:id}', [\App\Http\Controllers\ProjectsController::class, 'editProjects'])->name('admin.projects.view');
        Route::get('projects/delete/{id}', [\App\Http\Controllers\ProjectsController::class, 'deleteProjects'])->name('admin.projects.delete');
        Route::post('project/status/', [\App\Http\Controllers\ProjectsController::class, 'changeStatusProject'])->name('admin.project.statusChange');

        //Project Mark as sold
        Route::post('projects/marked/sold', [\App\Http\Controllers\ProjectsController::class, 'projectSold'])->name('admin.projects.sold');


        //Transaction Route
        Route::get('transaction/list', [\App\Http\Controllers\TransactionController::class, 'transactionList'])->name('admin.transaction');
        Route::get('transaction/listing', [\App\Http\Controllers\TransactionController::class, 'index'])->name('admin.transaction.list');
        Route::get('transaction/statusChange/{id}/{status}', [\App\Http\Controllers\TransactionController::class, 'transactionStatusChange'])->name('admin.transaction.statusChange');

        //Funding Campaign Route
        Route::get('funding-campaign/list', [\App\Http\Controllers\FundingCampaignsController::class, 'fundingCampaignList'])->name('admin.funding-campaign');
        Route::get('funding-campaign/listing', [\App\Http\Controllers\FundingCampaignsController::class, 'index'])->name('admin.funding-campaign.list');
        Route::get('funding-campaign/add', [\App\Http\Controllers\FundingCampaignsController::class, 'addFundingCampaign'])->name('admin.funding-campaign.add');
        Route::post('funding-campaign/add', [\App\Http\Controllers\FundingCampaignsController::class, 'postAddFundingCampaign'])->name('admin.funding-campaign.add');
        Route::get('funding-campaign/edit/{id}', [\App\Http\Controllers\FundingCampaignsController::class, 'editFundingCampaign'])->name('admin.funding-campaign.edit');
        Route::post('funding-campaign/edit/{id}', [\App\Http\Controllers\FundingCampaignsController::class, 'postEditFundingCampaign'])->name('admin.funding-campaign.edit');
        Route::post('funding-campaign/status', [\App\Http\Controllers\FundingCampaignsController::class, 'changeStatusFundingCampaign'])->name('admin.funding-campaign.statusChange');
        Route::post('project-category', [\App\Http\Controllers\FundingCampaignsController::class, 'getCategory'])->name('projectCategory');

        //Investor Listing
        Route::get('investors', [\App\Http\Controllers\InvestorListingController::class, 'investorsList'])->name('admin.investor.listing');
        Route::get('investor/listing', [\App\Http\Controllers\InvestorListingController::class, 'index'])->name('admin.investor.list');
        Route::get('investor/vote-campaign/listing', [\App\Http\Controllers\InvestorListingController::class, 'voteCampaignListing'])->name('admin.investor.vote-campaign.list');
        Route::get('investor/view/{id}', [\App\Http\Controllers\InvestorListingController::class, 'viewInvestors'])->name('admin.investor.view');
        Route::post('investor/status', [\App\Http\Controllers\InvestorListingController::class, 'changeInvestorStatus'])->name('admin.investor.statusChange');
        Route::post('investor/delete', [\App\Http\Controllers\InvestorListingController::class, 'deleteInvestor'])->name('admin.investor.delete');

        //Funding Request
        Route::get('funding-request/list', [\App\Http\Controllers\FundRaisingRequestController::class, 'fundRequestList'])->name('admin.fund-request');
        Route::get('funding-request/listing', [\App\Http\Controllers\FundRaisingRequestController::class, 'index'])->name('admin.fund-request.list');
        Route::post('funding-request/status', [\App\Http\Controllers\FundRaisingRequestController::class, 'fundRequestStatus'])->name('admin.fund-request.status');
        Route::get('funding-request/{id}', [\App\Http\Controllers\FundRaisingRequestController::class, 'viewFundRequest'])->name('admin.fund-request.view');

        //Voting Campaign
        Route::get('vote-campaign/list', [\App\Http\Controllers\VoteCampaignController::class, 'voteCampaignList'])->name('admin.vote-campaign');
        Route::get('vote-campaign/listing', [\App\Http\Controllers\VoteCampaignController::class, 'index'])->name('admin.vote-campaign.list');
        Route::get('vote-campaign/view/{id}', [\App\Http\Controllers\VoteCampaignController::class, 'voteCampaignView'])->name('admin.vote-campaign.view');
        Route::get('vote-campaign/another/listing', [\App\Http\Controllers\VoteCampaignController::class, 'index2'])->name('admin.vote-campaign.another.list');
        Route::get('vote-campaign/add', [\App\Http\Controllers\VoteCampaignController::class, 'addVoteCampaign'])->name('admin.vote-campaign.add');
        Route::post('vote-campaign/add', [\App\Http\Controllers\VoteCampaignController::class, 'postAddVoteCampaign'])->name('admin.vote-campaign.add');
        Route::get('vote-campaign/view/{id}', [\App\Http\Controllers\VoteCampaignController::class, 'viewVoteCampaign'])->name('admin.vote-campaign.view');
        Route::post('vote-campaign/status', [\App\Http\Controllers\VoteCampaignController::class, 'changeStatusVoteCampaign'])->name('admin.vote-campaign.statusChange');

        //Shares Approval Requests Route
        Route::get('approval/requests/list', [\App\Http\Controllers\admin\SharesApprovalRequestsController::class, 'approvalList'])->name('admin.approval.requests');
        Route::get('approval/requests/listing', [\App\Http\Controllers\admin\SharesApprovalRequestsController::class, 'index'])->name('admin.approval.requests.list');
        Route::get('approval/requests/statusChange/{id}/{status}', [\App\Http\Controllers\admin\SharesApprovalRequestsController::class, 'approvalStatusChange'])->name('admin.approval.requests.statusChange');

        //Shares Listing Route
        Route::get('shares/list', [\App\Http\Controllers\admin\ShareListController::class, 'sharesList'])->name('admin.shares.list');
        Route::get('shares/listing', [\App\Http\Controllers\admin\ShareListController::class, 'index'])->name('admin.shares.listing');
        Route::get('shares/bid/offers/listing', [\App\Http\Controllers\admin\ShareListController::class, 'bidOffers'])->name('admin.shares.bid.offers.listing');
        Route::get('shares/bids/listing/{bid_id}', [\App\Http\Controllers\admin\ShareListController::class, 'bidOffersListing'])->name('admin.shares.bids.listing');

        // Help center
        Route::get('help-center', [\App\Http\Controllers\HelpCenterController::class, 'helpCenter'])->name('admin.help-center');
        Route::get('help-center/action/{id}', [\App\Http\Controllers\HelpCenterController::class, 'action'])->name('admin.help-center.edit');
        Route::delete('help-center/delete', [\App\Http\Controllers\HelpCenterController::class, 'delete'])->name('admin.help-center.delete');
        Route::put('help-center/update', [\App\Http\Controllers\HelpCenterController::class, 'update'])->name('admin.help-center.update');

        // Settings
        Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('admin.settings');
        Route::post('update-countries', [\App\Http\Controllers\SettingsController::class, 'updateCountries'])->name('admin.update-countries');
        Route::get('get-countries', [\App\Http\Controllers\SettingsController::class, 'getCountries'])->name('admin.get-countries');
        Route::get('get-cities', [\App\Http\Controllers\SettingsController::class, 'getCities'])->name('admin.get-cities');
        Route::post('vat', [\App\Http\Controllers\SettingsController::class, 'updateVat'])->name('admin.update-vat');
        Route::post('limit', [\App\Http\Controllers\SettingsController::class, 'updateLimit'])->name('admin.update-limit');
        Route::post('faq', [\App\Http\Controllers\SettingsController::class, 'faq'])->name('admin.faq');
        Route::post('terms-conditions', [\App\Http\Controllers\SettingsController::class, 'termsAndConditions'])->name('admin.terms-conditions');
        Route::post('privacy-policy', [\App\Http\Controllers\SettingsController::class, 'privacyPolicy'])->name('admin.privacy-policy');
        Route::post('about-us', [\App\Http\Controllers\SettingsController::class, 'aboutUs'])->name('admin.about-us');

        // performance
        Route::get('performance', [\App\Http\Controllers\PerformanceController::class, 'index'])->name('admin.performance');
        Route::get('create-new-report', [\App\Http\Controllers\PerformanceController::class, 'createNewReport'])->name('admin.create-new-report');
        Route::get('get-project-dates', [\App\Http\Controllers\PerformanceController::class, 'getProjectDates'])->name('admin.get-project-dates');
        Route::get('view/{id}', [\App\Http\Controllers\PerformanceController::class, 'viewPerformance'])->name('admin.view-performance');
        Route::post('save-report', [\App\Http\Controllers\PerformanceController::class, 'storeReport'])->name('admin.store-report');
        Route::post('delete-report', [\App\Http\Controllers\PerformanceController::class, 'deleteReport'])->name('admin.delete-report');
        Route::post('save-progress', [\App\Http\Controllers\PerformanceController::class, 'storeProgress'])->name('admin.store-progress');
        Route::post('save-progress-report-summary', [\App\Http\Controllers\PerformanceController::class, 'storeProgressReportSummary'])->name('admin.store-progress-report-summary');
        Route::post('save-attached-documents', [\App\Http\Controllers\PerformanceController::class, 'storeAttachedDocuments'])->name('admin.store-attached-documents');
        Route::put('update-report', [\App\Http\Controllers\PerformanceController::class, 'updateReport'])->name('admin.update-report');
        Route::post('update-development-progress', [\App\Http\Controllers\PerformanceController::class, 'updateDevelopmentProgress'])->name('admin.update-development-progress');
        Route::put('update-progress-report-summary', [\App\Http\Controllers\PerformanceController::class, 'updateProgressReportSummary'])->name('admin.update-progress-report-summary');
        Route::post('update-attached-documents', [\App\Http\Controllers\PerformanceController::class, 'updateAttachedDocuments'])->name('admin.update-attached-documents');
        Route::post('remove-development-progress', [\App\Http\Controllers\PerformanceController::class, 'removeDevelopmentProgress'])->name('admin.remove-development-progress');
        Route::post('remove-attached-document', [\App\Http\Controllers\PerformanceController::class, 'removeAttachedDocument'])->name('admin.remove-attached-document');
        Route::post('project/info', [\App\Http\Controllers\PerformanceController::class, 'getProjectInfo'])->name('admin.project.info');

        //Notifications Routes
        Route::get('notifications', [\App\Http\Controllers\admin\NotificationsController::class, 'notifications'])->name('admin.notifications');
        Route::get('notifications/listing', [\App\Http\Controllers\admin\NotificationsController::class, 'index'])->name('admin.notifications.list');
        Route::post('notifications', [\App\Http\Controllers\admin\NotificationsController::class, 'postNotifications'])->name('admin.send.notification');
        Route::post('project/investors', [\App\Http\Controllers\admin\NotificationsController::class, 'getProjectInvestors'])->name('admin.get.project.investors');


        //Upgrade to pro
        Route::get('upgrade-to-pro', [\App\Http\Controllers\UpgradeToPro::class, 'proView'])->name('admin.upgrade');
        Route::get('upgrade-to-pro/list', [\App\Http\Controllers\UpgradeToPro::class, 'proList'])->name('admin.upgrade.list');
        Route::post('upgrade-to-pro/status', [\App\Http\Controllers\UpgradeToPro::class, 'proStatus'])->name('admin.upgrade.status');

    });
});


Route::get('/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
Route::post('/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');
