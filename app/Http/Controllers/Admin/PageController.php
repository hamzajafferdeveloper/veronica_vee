<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendPage;
use Exception;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function getPrivacyPolicy()
    {
        $privacyPolicy = FrontendPage::where('slug', 'privacy-policy')->first();

        return view('admin.pages.privacy-policy', compact('privacyPolicy'));
    }

    public function getTermOfUse()
    {
        $termsOfUse = FrontendPage::where('slug', 'term-of-use')->first();

        return view('admin.pages.terms-of-use', compact('termsOfUse'));
    }

    public function storePrivacyPolicyPage()
    {
        try {
            $privacyPolicy = FrontendPage::where('slug', 'privacy-policy')->first();

            if ($privacyPolicy) {
                $privacyPolicy->content = request('content');
                $privacyPolicy->save();
            } else {
                FrontendPage::create([
                    'title' => 'Privacy Policy',
                    'slug' => 'privacy-policy',
                    'content' => request('content'),
                ]);
            }

            return back()->with('success', 'Privacy Policy saved successfully.');
        } catch (Exception $e) {
            Log::error('Error storing privacy policy page: '.$e->getMessage());

            return back()->with('error', 'Something went wrong.');
        }
    }

    public function storeTermOfUsePage()
    {
        try {
            $privacyPolicy = FrontendPage::where('slug', 'term-of-use')->first();

            if ($privacyPolicy) {
                $privacyPolicy->content = request('content');
                $privacyPolicy->save();
            } else {
                FrontendPage::create([
                    'title' => 'Term of Use',
                    'slug' => 'term-of-use',
                    'content' => request('content'),
                ]);
            }

            return back()->with('success', 'Term of Use saved successfully.');
        } catch (Exception $e) {
            Log::error('Error storing term of use page: '.$e->getMessage());

            return back()->with('error', 'Something went wrong.');
        }
    }
}
