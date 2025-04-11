<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class CategoriesExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Category::query();

        // Apply filters
        if ($this->request->filled('category_type')) {
            $query->where('category_type', 'like', '%' . $this->request->category_type . '%');
        }
        if ($this->request->filled('category_name')) {
            $query->where('category_name', 'like', '%' . $this->request->category_name . '%');
        }
        if ($this->request->filled('status')) {
            $query->where('status', $this->request->status);
        }

        // Apply sorting
        $sortBy = $this->request->get('sort_by', 'created_at');
        $order = $this->request->get('order', 'desc');
        $query->orderBy($sortBy, $order);

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Category Type',
            'Category Name',
            'Sub Category',
            'Status',
            'Created At',
            'Updated At'
        ];
    }

    public function map($category): array
    {
        return [
            $category->id,
            $category->category_type,
            $category->category_name,
            $category->sub_category,
            $category->status ? 'Active' : 'Inactive',
            $category->created_at->format('Y-m-d H:i:s'),
            $category->updated_at->format('Y-m-d H:i:s')
        ];
    }
} 