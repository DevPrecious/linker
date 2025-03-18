<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Link;
use App\Models\Analytic;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;

class PageController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();
        $links = $user->links()->active()->latest()->get();
        return view('user.index', compact('user', 'links'));
    }

    public function click($id)
    {
        $link = Link::findOrFail($id);

        try {
            $location = GeoIP::getLocation(request()->ip());
            $country = $location->country ?? 'Unknown';
        } catch (\Exception $e) {
            $country = 'Unknown';
        }

        // Record analytics
        Analytic::create([
            'link_id' => $link->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'country' => $country,
            'clicks' => 1,
        ]);

        return redirect($link->url);
    }
}
