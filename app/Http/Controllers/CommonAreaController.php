<?php

namespace App\Http\Controllers;

use App\Models\CommonArea;
use Illuminate\Http\Request;

class CommonAreaController extends Controller
{
    
    public function index()
    {
        return inertia('CommonArea/Index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(CommonArea $commonArea)
    {
        //
    }

    public function edit(CommonArea $commonArea)
    {
        //
    }

    public function update(Request $request, CommonArea $commonArea)
    {
        //
    }

    public function destroy(CommonArea $commonArea)
    {
        //
    }
}
