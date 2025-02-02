<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Gallery;
use App\Models\User;
use App\Models\Package;
use App\Models\Event;
use App\Models\EventImage;
use App\Models\InterestedEvents;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('email', $user->email)->first();
            if ($finduser) {
                Auth::guard('customer')->login($finduser);

                return redirect('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('Test123456')
                ]);

                Auth::guard('customer')->login($newUser);

                return redirect('/');
            }
        } catch (\Exception $e) {
            return redirect('/');
        }
    }

    public function index()
    {
        $today = date("Y-m-d");
        $spot_light_events = Package::orderBy("id", "DESC")->inRandomOrder()->limit(6)->get();
        $events = Event::orderBy("date", "ASC")->limit(8)->where('status',1)->where('date','>', $today)->get();
        $genres = Event::groupBy('genre')->pluck('genre')->toArray();
        return view('front.index', compact("spot_light_events", "events", "genres"));
    }

    public function content($category)
    {
        $page = Page::where('category',$category)->first();
        return view('front.page', compact("page"));
    }

    public function spotLightEvent()
    {
        $spotlight_events = Package::get();
        return view('front.spotLightEvent', compact("spotlight_events"));
    }

    public function spotlight_event($id)
    {
        $spotlight_events = Package::find($id);
        return view('front.spotlight_event', compact("spotlight_events"));
    }

    public function our_mission()
    {
        return view('front.our_mission');
    }

    public function about_us()
    {
        return view('front.about');
    }

    public function make_donation()
    {
        return view('front.donation');
    }

    public function featured_stories()
    {
        $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->get();
        return view('front.featured_stories', compact("blogs"));
    }

    public function featured_stories_detail($slug)
    {
        $title = str_replace("_", " ", $slug);
        $blog = Blog::where('title', $title)->first();
        $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->limit(6)->get();
        return view('front.featured_stories_detail', compact("blog", "blogs"));
    }

    public function featured_stories_search(Request $request)
    {
        $blogs = Blog::where('title', 'like', '%' . $request->q . '%')->get();
        return view('front.featured_stories', compact("blogs"));
    }

    public function photo_gallery()
    {
        $galleries = Gallery::where('status', 1)->orderBy('id', 'desc')->get();
        return view('front.gallery', compact("galleries"));
    }

    public function photo_gallery_detail($id){
        $gallery = Gallery::find($id);
        $blogs = Blog::where('status', 1)->orderBy('id', 'desc')->limit(6)->get();
        return view('front.gallery_detail', compact("gallery","blogs"));
    }

    public function search(Request $request)
    {

        $events = Event::where('status', 1);
        if ($request->q != "") {
            $events = $events->where('title', 'like', '%' . $request->q . '%');
        }
        if (!is_null($request->d) && $request->d != 0) {
            $events = $events->whereMonth('date', date('m', strtotime($request->d)));
        }
        if ($request->g != 0) {
            $events = $events->whereIn('genre', $request->g);
        }
        if ($request->serie != 0) {
            $events = $events->where('series', $request->serie);
        }

        $events = $events->get();

        $company = Company::first();
        $series = explode(",", $company->series);
        $genres = explode(",", $company->tags);

        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subMonth();
        $months = [];
        for ($i = 0; $i < 13; $i++) {
            $months[] = $startDate->copy()->addMonths($i);
        }

        $pageType = 'list';
        return view('front.events', compact("genres", "events", "series", "months", "request", "pageType"));
    }

    public function events()
    {
        $company = Company::first();
        $events = Event::where('status', 1)->get();
        $series = explode(",", $company->series);
        $genres = explode(",", $company->tags);

        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subMonth();
        $months = [];
        for ($i = 0; $i < 13; $i++) {
            $months[] = $startDate->copy()->addMonths($i);
        }

        $pageType = 'list';
        return view('front.events', compact("genres", "events", "series", "months", "pageType"));
    }

    public function eventsCalendar()
    {
        $company = Company::first();
        $events = Event::where('status', 1)->get();
        $series = explode(",", $company->series);
        $genres = explode(",", $company->tags);

        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subMonth();
        $months = [];
        for ($i = 0; $i < 13; $i++) {
            $months[] = $startDate->copy()->addMonths($i);
        }
        $pageType = 'calendar';
        return view('front.events', compact("genres", "events", "series", "months", "pageType"));
    }

    public function event_detail($id)
    {
        $event = Event::with('galleries','bts_events')->find($id);
        $interested = 0;
        if (Auth::guard('customer')->check()) {
            $interested = !is_null(InterestedEvents::where(['event_id' => $id, 'user_id' => Auth::guard('customer')->user()->id])->first()) ? 1 : 0;
        }
        return view('front.events_detail', compact("event", "interested"));
    }

    public function event_add()
    {
        return view('front.add_events');
    }

    public function event_save(Request $request)
    {
        $model = new Event();
        foreach ($request->all() as $key => $req) {
            if ($key != "_token" && $key != "id" && $key != "gallery") {
                $model->$key = $req;
            }
        }
        $model->status == 0;
        $this->ImageUpload($model, "image", $request, "events");
        $model->save();
        $this->MultiImageUpload(EventImage::class, $model->id, "gallery", $request, "events/gallery");
        return redirect()->back()->with("success", "Event Creation Request Sent Successfully");
    }

    public function event_interested($event_id)
    {
        $obj = new InterestedEvents;
        $obj->event_id = $event_id;
        $obj->user_id = Auth::guard('customer')->user()->id;
        $obj->save();

        return redirect()->back()->with("success", "Event Added to Favorites");
    }

    public function customer_dashboard()
    {

        $events = Event::select('events.*')->where('status', 1)->join('interested_events', 'events.id', '=', 'interested_events.event_id')->where('interested_events.user_id', Auth::guard('customer')->user()->id)->get();
        return view('front.dashboard', compact("events"));
    }

    public function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/');
    }
}
