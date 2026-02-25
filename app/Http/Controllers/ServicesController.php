<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ServicesController extends Controller
{
    public function servicesCreateFunc(){
        $PublicFunc = Application::where('userid', Auth::id())->get();
        $servicess = Services::all();
        return view("servicesBlock.create", compact("PublicFunc",   "servicess"));
    }
    public function servicesBlockPostFunc(Request $request){
        $request->validate([
            "title" => "required|string",
            "category" => "required|string",
            "titleTwo" => "required|string",
            "subtitle" => "required|string",
            "money" => "required|string",
            "concept" => "required|string",
            "edits" => "required|string",
            "formatTwo" => "required|string",
            "term" => "required|string",
        ]);
        
        $newrequest = new Services([
            "title" => $request->title,
            "category" => $request->category,
            "titleTwo" => $request->titleTwo,
            "subtitle" => $request->subtitle,
            "money" => $request->money,
            "concept" => $request->concept, 
            "edits" => $request->edits,
            "formatTwo" => $request->formatTwo,
            "term" => $request->term,
        ]);
        $newrequest->save();
        return redirect()->route("services");
    }

    /** Обновление услуги (админ/модератор) — название, категория, цена, срок */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->role !== 'moderator') {
            return redirect()->back()->with('error', 'Нет доступа');
        }
        $service = Services::findOrFail($id);
        $request->validate([
            'title' => 'sometimes|nullable|string|max:255',
            'titleTwo' => 'sometimes|nullable|string|max:255',
            'category' => 'sometimes|nullable|string|max:255',
            'money' => 'sometimes|nullable|string|max:100',
            'term' => 'sometimes|nullable|string|max:100',
        ]);
        if ($request->has('title')) $service->title = $request->title;
        if ($request->has('titleTwo')) $service->titleTwo = $request->titleTwo;
        if ($request->has('category')) $service->category = $request->category;
        if ($request->has('money')) $service->money = $request->money;
        if ($request->has('term')) $service->term = $request->term;
        $service->save();
        return redirect()->back()->with('success', 'Услуга обновлена');
    }
}
