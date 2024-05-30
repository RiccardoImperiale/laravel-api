<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::orderByDesc('id')->paginate(5);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Type created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Str::slug($request->name, '-');

        $type->update($val_data);

        return to_route('admin.types.index', $type)->with('message', "Type $type->name edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index', $type)->with('message', "Type $type->name deleted successfully");
    }
}
