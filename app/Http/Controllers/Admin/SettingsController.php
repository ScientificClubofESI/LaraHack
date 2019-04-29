<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;
use Spatie\Valuestore\Valuestore;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Show settings view with current settings
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $settings = Valuestore::make(storage_path('app/settings.json'));

        return view('dashboard.settings', ['settings' => $settings]);
    }

    /**
     * @param Request $request
     * @param Settings $settings
     * Update the current settings
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Settings $settings, $registrationMode)
    {

        try {
            $settings->put('registration_mode', $registrationMode);

            return response()->json([
                'response' => 200,
            ]);

        } catch (Throwable $err) {
            throw $err;
        }
    }
}
