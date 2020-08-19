<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\ArkadeDownload;
use App\Http\Resources\ArkadeDownload as ArkadeDownloadResource;
use App\Http\Resources\ArkadeDownloadCollection;

use App\ArkadeRelease;
use App\Http\Resources\ArkadeRelease as ArkadeReleaseResource;
use App\Http\Resources\ArkadeReleaseCollection;

use App\Organization;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\Organization as OrganizationResource;

use App\ArkadeDownloader;
use App\Http\Resources\ArkadeDownloader as DownloaderResource;
use App\Http\Resources\ArkadeDownloaderCollection;

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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::middleware('auth')->prefix('statistikk')->name('statistics.')->group(function () {

    Route::get('/', function () {
        return view('statistics.index',
            ['links' => [
                'arkadenedlastinger' => route('statistics.downloads'),
                'arkadenedlaster-organisasjoner' => route('statistics.organizations'),
                'arkadenedlastere' => route('statistics.downloaders'),
                'arkadeutgivelser' => route('statistics.releases'),
                'self' => route('statistics.index'),
        ]]);
    })->name('index');

    Route::get('arkade-nedlastinger', function (Request $request) {
        $downloads = ($releaseId = $request->input('utgivelse'))
            ? ArkadeDownload::whereArkadeReleaseId($releaseId)->paginate()
            : $downloads = ArkadeDownload::paginate();
        return view('statistics.arkade-downloads.index', ['downloads' => new ArkadeDownloadCollection($downloads)]);
    })->name('downloads');

    Route::get('arkade-nedlastinger/{download}', function (ArkadeDownload $download) {
        return new ArkadeDownloadResource(ArkadeDownload::find($download->id));
    })->name('download');

    Route::get('arkade-utgivelser', function () {
        return view('statistics.arkade-releases.index', ['releases' => new ArkadeReleaseCollection(ArkadeRelease::paginate())]);
    })->name('releases');

    Route::get('arkade-utgivelser/{release}', function (ArkadeRelease $release) {
        return new ArkadeReleaseResource(ArkadeRelease::find($release->id));
    })->name('release');

    Route::get('arkade-nedlastere', function () {
        return view('statistics.arkade-downloaders.index', ['downloaders' => new ArkadeDownloaderCollection(ArkadeDownloader::paginate())]);
    })->name('downloaders');

    Route::get('arkade-nedlastere/{downloader}', function (ArkadeDownloader $downloader) {
        return new DownloaderResource(ArkadeDownloader::find($downloader->id));
    })->name('downloader');

    Route::get('organisasjoner', function () {
        return view('statistics.arkade-organizations.index', ['organizations' => new OrganizationCollection(Organization::paginate())]);
    })->name('organizations');

    Route::get('organisasjoner/{organization}', function (Organization $organization) {
        return new OrganizationResource(Organization::find($organization->id));
    })->name('organization');
});
