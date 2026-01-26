<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontendPage;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getPrivacyPolicy(Request $request)
    {
        $lang = $request->get('lang', 'en');

        $page = FrontendPage::firstOrCreate(
            ['slug' => 'privacy-policy'],
            ['title' => 'Privacy Policy']
        );

        $translation = $page->translations()
            ->where('locale', $lang)
            ->first();

        return view('admin.pages.privacy-policy', [
            'privacyPolicy' => $page,
            'translation' => $translation,
            'lang' => $lang,
        ]);
    }

    public function storePrivacyPolicyPage(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'lang' => 'required|string|max:5',
        ]);

        try {
            $page = FrontendPage::firstOrCreate(
                ['slug' => 'privacy-policy'],
                ['title' => 'Privacy Policy']
            );

            $page->translations()->updateOrCreate(
            [
                'frontend_page_id' => $page->id,
                'locale' => $request->lang,
            ],
                [
                    'title' => 'Privacy Policy',
                    'content' => $request->content,
                ]
            );

            return back()->with('success', __('messages.saved_successfully'));
        } catch (Exception $e) {
            Log::error('Error storing privacy policy page: ' . $e->getMessage());

            return back()->with('error', __('messages.something_went_wrong'));
        }
    }

    public function getTermOfUse(Request $request)
    {
        $lang = $request->get('lang', 'en');

        $page = FrontendPage::where('slug', 'term-of-use')->firstOrFail();

        $translation = $page->translations()
            ->where('locale', $lang)
            ->first();

        return view('admin.pages.terms-of-use', [
            'termsOfUse' => $page,
            'translation' => $translation,
            'lang' => $lang,
        ]);
    }

    public function storeTermOfUsePage(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'lang' => 'required|string|max:5',
        ]);

        try {
            $page = FrontendPage::firstOrCreate(
                ['slug' => 'term-of-use'],
                ['title' => 'Term of Use']
            );

            $page->translations()->updateOrCreate(
            [
                'frontend_page_id' => $page->id,
                'locale' => $request->lang,
            ],
            [
                'title' => 'Term of Use',
                'content' => $request->content,
            ]
        );

            return back()->with('success', __('messages.saved_successfully'));
        } catch (Exception $e) {
            Log::error('Error storing term of use page: ' . $e->getMessage());

            return back()->with('error', __('messages.something_went_wrong'));
        }
    }
}
