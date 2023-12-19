<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
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
            $privacypolicy = PrivacyPolicy::where('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $privacypolicy = PrivacyPolicy::latest()->paginate($perPage);
        }

        return view('backend.privacy-policy.index', compact('privacypolicy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.privacy-policy.create');
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
                if ($request->hasFile('description')) {
            $file = $request->file('description');
            $fileName = str_random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/uploads');
            $file->move($destinationPath, $fileName);
            $requestData['description'] = 'uploads/' . $fileName;
        }

        PrivacyPolicy::create($requestData);

        return redirect('privacy-policy')->with('flash_message', 'PrivacyPolicy added!');
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
        $privacypolicy = PrivacyPolicy::findOrFail($id);

        return view('backend.privacy-policy.show', compact('privacypolicy'));
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
        $privacypolicy = PrivacyPolicy::findOrFail($id);

        return view('backend.privacy-policy.edit', compact('privacypolicy'));
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
                if ($request->hasFile('description')) {
            $file = $request->file('description');
            $fileName = str_random(40) . '.' . $file->getClientOriginalExtension();
            $destinationPath = storage_path('/app/public/uploads');
            $file->move($destinationPath, $fileName);
            $requestData['description'] = 'uploads/' . $fileName;
        }

        $privacypolicy = PrivacyPolicy::findOrFail($id);
        $privacypolicy->update($requestData);

        return redirect('privacy-policy')->with('flash_message', 'PrivacyPolicy updated!');
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
        PrivacyPolicy::destroy($id);

        return redirect('privacy-policy')->with('flash_message', 'PrivacyPolicy deleted!');
    }
}
