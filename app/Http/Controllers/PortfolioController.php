<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Portfolio\StoreRequest;
use App\Http\Requests\Portfolio\UpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;


class PortfolioController extends Controller
{
   
   
   
   
   
    public function index(): View
    {
        $portfolios = Portfolio::all();
        return view('portfolios.index', compact('portfolios'));
    }


     /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('portfolios.form');
    }


      /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request):  \Illuminate\Http\RedirectResponse

    {
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
             // put image in the public storage
            $filePath = Storage::disk('public')->put('images/portfolio/featured-images', request()->file('featured_image'));
            $validated['featured_image'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Portfolio::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Portfolio created successfully!');
            return redirect()->route('portfolios.index');
        }

        return abort(500);
    }


  /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('portfolios.show', [
            'portfolio' => Portfolio::findOrFail($id),
        ]);
    }


     /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('portfolios.form', [
            'portfolio' => Portfolio::findOrFail($id),
        ]);
    }


 /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $portfolio = Portfolio::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('featured_image')) {
            // delete image
            Storage::disk('public')->delete($portfolio->featured_image);

            $filePath = Storage::disk('public')->put('images/portfolio/featured-images', request()->file('featured_image'), 'public');
            $validated['featured_image'] = $filePath;
        }

        $update = $portfolio->update($validated);

        if($update) {
            session()->flash('notif.success', 'Portfoio updated successfully!');
            return redirect()->route('portfolios.index');
        }

        return abort(500);
    }

}
