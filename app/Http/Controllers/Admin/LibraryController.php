<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\LibraryWordResource;
use App\Http\Responses\OKResponse;
use App\Http\Responses\Resources\ResourceNotFoundErrorResponse;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Http\Responses\Validation\BadValidationErrorResponse;
use App\Models\LibraryWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page' => 'required|numeric|min:1',
            'limit' => 'required|numeric|min:1',
        ]);

        if ( $validator->fails() ) return BadValidationErrorResponse::response($validator->errors());

        $page = $request->input('page');
        $limit = $request->input('limit');
        $search = $request->input('word');

        $words = LibraryWord::query();
        if ( $search )
        {
            $words = $words
                ->where('word', 'like', '%' . $search .'%')
                ->orWhere('meaning', 'like', '%' . $search .'%')
                ;
        }
   
        $total = $words->count();
        $words = $words->skip(($page - 1) * $limit)->take($limit)->get();

        return ResourceOKResponse::response([
            'items' => LibraryWordResource::collection($words),
            'total' => $total,
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'word' => 'required',
            'meaning' => 'required',
        ]);

        if ( $validator->fails() ) return BadValidationErrorResponse::response($validator->errors());

        LibraryWord::create($validator->validated());

        return OKResponse::response();
    }

    public function show(Request $request, $id)
    {
        $word = LibraryWord::find($id);
        if ( !$word ) return ResourceNotFoundErrorResponse::response();

        return ResourceOKResponse::response(new LibraryWordResource($word));
    }

    public function update(Request $request, $id)
    {
        $word = LibraryWord::find($id);
        if ( !$word ) return ResourceNotFoundErrorResponse::response();

        $validator = Validator::make($request->all(), [
            'word' => 'required',
            'meaning' => 'required',
        ]);

        if ( $validator->fails() ) return BadValidationErrorResponse::response($validator->errors());

        $word->update($validator->validated());

        return OKResponse::response();
    }

    public function delete(Request $request, $id)
    {
        $word = LibraryWord::find($id);
        if ( !$word ) return ResourceNotFoundErrorResponse::response();

        $word->delete();

        return OKResponse::response();
    }
}
