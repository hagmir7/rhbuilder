<?php

namespace App\Http\Controllers;

use App\Models\SkillType;
use Illuminate\Http\Request;

class SkillTypeController extends Controller
{
    public function index()
    {
        return SkillType::all();
    }


    public function store(Request $request) {}


    public function show(SkillType $skill_type)
    {
        $skill_type->load('skills');
        return $skill_type;
    }
}
