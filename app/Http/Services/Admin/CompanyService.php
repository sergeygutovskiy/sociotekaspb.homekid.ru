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

        $query = null;
        if ( $name_filter ) $query = Company::where('name', 'like', '%'.$name_filter.'%');
        if ( $status_filter ) $query = $query 
            ? $query->where('status', $status_filter)
            : Company::where('status', $status_filter);
        if ( $district_filter ) $query = $query
            ? $query->where('district_id', $district_filter)
            : Company::where('district_id', $district_filter);

        $sort_by = $request->input('sort_by');
        $sort_direction = $request->input('sort_direction');

        if ( $sort_by && $sort_direction )
        {
            if ( $sort_by === 'created_at' ) $query = $query
                ? $query->orderBy('created_at', $sort_direction)
                : Company::orderBy('created_at', $sort_direction);
            else if ( $sort_by === 'updated_at' ) $query = $query 
                ? $query->orderBy('updated_at', $sort_direction)
                : Company::orderBy('updated_at', $sort_direction);
            else if ( $sort_by === 'status' ) $query = $query
                ? $query->orderby('status', $sort_direction)
                : Company::orderby('status', $sort_direction);
        }
        
        $total = $query
            ? $query->count()
            : Company::all()->count();
        $items = $query
            ? $query->with('district')->skip(($page - 1) * $limit)->take($limit)->get() 
            : Company::with('district')->skip(($page - 1) * $limit)->take($limit)->get();

        return [
            'total' => $total,
            'items' => $items,
        ];
    }
}