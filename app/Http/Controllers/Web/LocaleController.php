<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    /**
     * Change application location
     *
     * @param $locale
     * @return RedirectResponse
     */
    public function changeLocale($locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'sk'])) {
            $locale = config('app.locale');
        }

        // Set cookie for 1 year
        $cookie = Cookie::make('locale', $locale, 60 * 24 * 365);

        // Set current locale
        App::setLocale($locale);

        return redirect()->back();
    }
}
