<?php

namespace App\Http\Controllers\Admin;

use App\Models\SaleSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleSliderController extends Controller
{
    public function index()
    {
        $sliders = SaleSlider::all();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'discount' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            // 'link' => 'required|url',
        ]);

        SaleSlider::create($request->all());

        return redirect()->route('admin.sliders.index');
    }

    public function edit(SaleSlider $saleSlider)
    {
        return view('admin.sliders.edit', compact('saleSlider'));
    }

    public function update(Request $request, SaleSlider $saleSlider)
    {
        $request->validate([
            'discount' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            // 'link' => 'required|url',
        ]);

        $saleSlider->update($request->all());

        return redirect()->route('admin.sliders.index');
    }

    public function destroy(SaleSlider $saleSlider)
    {
        $saleSlider->delete();

        return redirect()->route('admin.sliders.index');
    }
}
