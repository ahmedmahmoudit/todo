<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoriesListController extends Controller {

    /**
     * Create task
     * @return Category[]|Collection
     */
    public function __invoke()
    {
        return Category::all();
    }
}
