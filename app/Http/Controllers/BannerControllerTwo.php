<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use App\Models\Review;
use App\Models\User;

class BannerControllerTwo extends Controller
{
    public function index(Request $request)
    {
        if (!Schema::hasTable('banners')) {
            $banners = collect();
            $category = 'all';
            $PublicFunc = Application::where('userid', Auth::id())->get();
            return view('portfolio', compact('banners', 'category', 'PublicFunc'));
        }

        $category = $request->get('category', 'all');
        $banners = Banner::approved()->byCategory($category)->get();
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $reviews = Review::approved()->orderBy('created_at', 'desc')->get();
        $PublicFunc = Application::all();
        $users = User::withCount('orders')->get();
        
        return view('portfolio', compact('banners', 'category', 'PublicFunc'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|in:stream,game,holiday,esports,travel,art,commercial,auto',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = $request->file('image')->store('banners', 'public');

        $user = Auth::user();
        $isApproved = in_array($user->role, ['admin', 'moderator']);

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'image_path' => $imagePath,
            'category' => $request->category,
            'user_id' => $user->id,
            'is_approved' => $isApproved
        ]);

        return redirect()->route('portfolio')->with('success', 'Баннер успешно загружен! ' . 
            ($isApproved ? '' : 'Ожидайте одобрения администратора.'));
    }

    public function destroy(Banner $banner)
    {
        $user = Auth::user();
        

        if (!in_array($user->role, ['admin', 'moderator']) && $banner->user_id !== $user->id) {
            return back()->with('error', 'У вас нет прав для удаления этого баннера!');
        }


        Storage::disk('public')->delete($banner->image_path);
        
        $banner->delete();

        return back()->with('success', 'Баннер удален!');
    }

    public function approve(Banner $banner)
    {

        if (!in_array(Auth::user()->role, ['admin', 'moderator'])) {
            return back()->with('error', 'У вас нет прав для одобрения баннеров!');
        }

        $banner->update(['is_approved' => true]);
        return back()->with('success', 'Баннер одобрен!');
    }





}