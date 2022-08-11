<?php

namespace App\Http\Services\Admin;

use App\Http\Requests\Admin\Company\ListRequest;
use App\Models\Company;

class CompanyService
{
    public static function list(ListRequest $request)
    {
        $page = $request->input('page');
        $limit = $request->input('limit');

        $name_filter = $request->input('filter_name');
        $status_filter = $request->input('filter_status');
        $district_filter = $request->input('filter_district_id');

        $query = Company::query();
        if ( $name_filter ) $query = $query->where('name', 'like', '%'.$name_filter.'%');
        if ( $status_filter ) $query = $query->where('status', $status_filter);
        if ( is_numeric($district_filter) ) $query = $query->where('district_id', $district_filter);

        $sort_by = $request->input('sort_by');
        $sort_direction = $request->input('sort_direction');

        if ( $sort_by && $sort_direction )
        {
            $sort_column = 'created_at';
            if ( $sort_by === 'updated_at' ) $sort_column = 'updated_at';
            else if ( $sort_by === 'status' ) $sort_column = 'status';

            $query = $query->orderBy($sort_column, $sort_direction);
        }

        $total = $query->count();
        $items = $query->with('district')->skip(($page - 1) * $limit)->take($limit)->get();

        return [
            'total' => $total,
            'items' => $items,
        ];
    }
}