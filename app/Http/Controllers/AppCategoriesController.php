<?php

namespace App\Http\Controllers;

use App\Models\AppCategory;
use Illuminate\Http\Request;

class AppCategoriesController extends Controller
{
    public function __invoke()
    {
        return AppCategory::get();
    }
}
