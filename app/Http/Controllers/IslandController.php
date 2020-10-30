<?php

namespace App\Http\Controllers;

use App\Models\Island;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IslandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetch islands */

		$islands = Island::query()
			->with('characters')
			->orderBy('name')
			->get();

		/* Show view */

        return Inertia::render('Islands/Index', compact('islands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/* Instantiate empty model */

        $island = new Island();

		/* Show view */

        return Inertia::render('Islands/Create', compact('island'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		/* Sanitize data */

        $data = $request->all();
		$name = $data['name'] ?? '';

		/* Create Island */

		$island = Island::create([
			'name' => $name,
		]);

		/* Redirect */

		return redirect(route('islands.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function show(Island $island)
    {
        dd($island);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function edit(Island $island)
    {
		/* Show view */

        return Inertia::render('Islands/Edit', compact('island'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Island $island)
    {
		/* Sanitize data */

        $data = $request->all();
		$name = $data['name'] ?? $island->name;

        /* Update island */

		$island->name = $name;
		$island->save();

		/* Redirect */

		return redirect(route('islands.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Island  $island
     * @return \Illuminate\Http\Response
     */
    public function destroy(Island $island)
    {
        //
    }
}
