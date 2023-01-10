<?php

namespace App\Http\Controllers;

use App\Models\AppCategory;

class AppCategoriesController extends Controller
{
    public function __invoke()
    {
        return AppCategory::get();
    }
}
