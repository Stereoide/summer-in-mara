<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* Fetch items */

		$items = Item::query()
			->orderBy('name')
			->get();

		/* Show view */

        return Inertia::render('Items/Index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		/* Instantiate empty model */

        $item = new Item();

		/* Show view */

        return Inertia::render('Items/Create', compact('item'));
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

		/* Create Item */

		$item = Item::create([
			'name' => $name,
		]);

		/* Redirect */

		return redirect(route('items.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        /* Fetch characters that sell/buy this item */

        $characters = $item->characters;

		/* Show view */

        return Inertia::render('Items/Edit', compact('item', 'characters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
		/* Sanitize data */

        $data = $request->all();
		$name = $data['name'] ?? $item->name;

        /* Update item */

		$item->name = $name;
		$item->save();

		/* Redirect */

		return redirect(route('items.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
