<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Slider;
use Illuminate\Http\Request;
use Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $slider = Slider::where('image', 'LIKE', "%$keyword%")
                ->orWhere('status', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $slider = Slider::latest()->paginate($perPage);
        }

        return view('backend.slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();
                if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $fileName);
            $requestData['image'] = 'uploads/' . $fileName;
        }

        Slider::create($requestData);

        return redirect('slider')->with('flash_message', 'Slider added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('backend.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
                if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads');
            $file->move($destinationPath, $fileName);
            $requestData['image'] = 'uploads/' . $fileName;
        }

        $slider = Slider::findOrFail($id);
        $slider->update($requestData);

        return redirect('slider')->with('flash_message', 'Slider updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Slider::destroy($id);

        return redirect('slider')->with('flash_message', 'Slider deleted!');
    }
}
