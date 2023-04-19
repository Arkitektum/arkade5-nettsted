<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use App\Models\ArkadeDownloader;
use App\Models\ArkadeDownload;
use App\Models\ArkadeRelease;
use App\Models\Organization;

use App\Services\OrganizationInfoService;
use App\Http\Resources\OrganizationLocation;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('arkade-downloads', function (Request $request) {

    $arkadeUI = $request->input('arkadeUI');

    $arkadeVersionNumber = $request->input('arkadeVersion');

    $release = isset($arkadeVersionNumber)
        ? ArkadeRelease::whereUserInterface($arkadeUI)->whereVersionNumber($arkadeVersionNumber)->first()
        : ArkadeRelease::whereUserInterface($arkadeUI)->orderByDesc('released_at')->first(); // latest version

    $filename = $release->package_filename;
    $headers = ['Filename' => $filename, 'Access-Control-Expose-Headers' => 'Filename'];

    if(!$arkadePackageFile = Storage::download('builds/releases/'.$filename, $filename, $headers))
        abort(500, 'Download failed');

    $arkadeDownload = new ArkadeDownload();
    $arkadeDownload->arkadeRelease()->associate($release);
    $arkadeDownloader = ArkadeDownloader::updateOrCreate(['email' => $request->input('downloaderEmail')]);
    if ($request->input('downloaderNews')) { // is defined and true
        $arkadeDownloader->wants_news = true;
        $arkadeDownloader->save();
        // no unsubscribe trough open API
    }
    $arkadeDownload->arkadeDownloader()->associate($arkadeDownloader);
    $arkadeDownload->is_automated = $request->input('isAutomated');

    if ($orgNumber = $request->input('orgNumber')) {

        $organization = Organization::updateOrCreate(['org_number' => $orgNumber]);

        try {
            OrganizationInfoService::setOrganizationInfo($organization);
        } catch (Throwable $throwable) {
            Log::info(
                'Could not set organization info for ' . $organization->orgNumber,
                ['exception' => $throwable->getMessage()]
            );
        }

        $arkadeDownload->organization()->associate($organization);
    }
    $arkadeDownload->save();

    return $arkadePackageFile;

})->name('download.store');

Route::get('arkade-versions', function () {
    return ArkadeRelease::IsReleased()->distinct('version_number')
        ->orderBy('version_number', 'desc')->pluck('version_number');
});

Route::get('organization-locations', function () {
   return OrganizationLocation::collection(Organization::withAddressLocation()->get());
});
