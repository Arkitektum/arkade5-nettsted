<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\ArkadeDownload;
use App\Http\Resources\ArkadeDownload as ArkadeDownloadResource;
use App\Http\Resources\ArkadeDownloadCollection;

use App\ArkadeRelease;
use App\Http\Resources\ArkadeRelease as ArkadeReleaseResource;
use App\Http\Resources\ArkadeReleaseCollection;

use App\Organization;
use App\Http\Resources\OrganizationCollection;
use App\Http\Resources\Organization as OrganizationResource;

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return [
        'links' => [
            'arkade-nedlastinger' => route('downloads'),
            'organisasjoner' => route('organizations'),
            'brukere' => route('users'),
            'arkade-utgivelser' => route('releases'),
            'self' => route('index'),
        ],
    ];
})->name('index');

Route::get('arkade-nedlastinger', function (Request $request) {
    $downloads = ($releaseId = $request->input('utgivelse'))
        ? ArkadeDownload::whereArkadeReleaseId($releaseId)->paginate()
        : $downloads = ArkadeDownload::paginate();
    return new ArkadeDownloadCollection($downloads);
})->name('downloads');

Route::get('arkade-nedlastinger/{download}', function (ArkadeDownload $download) {
    return new ArkadeDownloadResource(ArkadeDownload::find($download->id));
})->name('download');

Route::get('arkade-utgivelser', function () {
    return new ArkadeReleaseCollection(ArkadeRelease::paginate());
})->name('releases');

Route::get('arkade-utgivelser/{release}', function (ArkadeRelease $release) {
    return new ArkadeReleaseResource(ArkadeRelease::find($release->id));
})->name('release');

Route::get('brukere', function () {
    return new UserCollection(User::paginate());
})->name('users');

Route::get('brukere/{user}', function (User $user) {
    return new UserResource(User::find($user->id));
})->name('user');

Route::get('organisasjoner', function () {
    return new OrganizationCollection(Organization::paginate());
})->name('organizations');

Route::get('organisasjoner/{organization}', function (Organization $organization) {
    return new OrganizationResource(Organization::find($organization->id));
})->name('organization');
