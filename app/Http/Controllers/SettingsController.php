<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\SettingsService;
use App\Http\Requests\SettingsRequest;

class SettingsController extends Controller
{
    public function __construct(public SettingsService $settingsService){

    }
    public function settingsView(User $user)
    {
        $themes = $this->settingsService->getAvailableThemes();
        $fonts = $this->settingsService->getAvailableFonts();
        $fontFamilies = $this->settingsService->getAvailableFontFamilies();
        return view('settings', compact('user', 'themes', 'fonts', 'fontFamilies'));
    }

    public function saveSettings(SettingsRequest $request, User $user)
    {
        $validated = $request->validated();
        $this->settingsService->saveUserSettings($user, $validated);
        return redirect()->route('profile', ['user' => $user->user_key])->with('success', 'Settings saved successfully!');
    }
}
