<?php

namespace App\Exports;

use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class RolesExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $query = Role::query();

        // Apply filters
        if ($this->request->filled('name')) {
            $query->where('name', 'like', '%' . $this->request->name . '%');
        }
        if ($this->request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $this->request->created_from);
        }
        if ($this->request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $this->request->created_to);
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
            'Name',
            'Created At',
            'Updated At',
            'Number of Permissions'
        ];
    }

    public function map($role): array
    {
        return [
            $role->id,
            $role->name,
            $role->created_at->format('Y-m-d H:i:s'),
            $role->updated_at->format('Y-m-d H:i:s'),
            $role->permissions->count()
        ];
    }
} 