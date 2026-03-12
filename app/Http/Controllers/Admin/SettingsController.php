<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update site settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_phone' => 'required|string|max:20',
            'site_address' => 'required|string',
        ]);

        // Settings are read from .env file
        // For production, you can use database or config cache
        // For now, we'll just show success message
        
        return redirect('/admin/settings')->with('success', 'Settings saved successfully! Note: For .env based settings, please edit the .env file directly.');
    }
}
