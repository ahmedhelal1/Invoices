<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        $validated = $request->validated();

        Sections::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => auth()->user()->name,
            'created_at' => now(),
            'updated_at' => now(),

        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $section = Sections::findOrFail($request->id);
        $validated = $request->validate(
            [
                'section_name' => ['required', 'max:255', 'unique:sections,section_name,' . $id . ',id'],
                'description' => ['required'],
            ],
            [
                'section_name.required' => '  برجاء ادخال اسم القسم ',
                'section_name.unique' => 'هذا القسم موجود بالفعل',
                'section_name.max' => 'لقد تجاوزت الحد الاقصي ',

                'description.required' => ' برجاء ادخال  الوصف',
            ]
        );
        $section->update([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'updated_at' => now(),
        ]);
        session()->flash('edit', 'تم التعديل بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sections = Sections::findOrFail($request->id);
        $sections->delete($request->id);
        session()->flash("delete", "لقد تم حذف القسم بنجاح");
        return redirect()->back();
    }
}
