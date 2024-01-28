<?php

namespace App\Models;
use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Auth;

class CategoryImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            if($key != 0)
            {
                try{
                    $category = Category::create([
                        'category_name'        => $row[0],
                    ]);
                }
                catch (\Exception $e) {
                    //
                }
            }
            $key = $key+1;
        }
    }
}
