<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\LibraryWordResource;
use App\Http\Responses\Resources\ResourceOKResponse;
use App\Models\LibraryWord;

class LibraryController extends Controller
{
    public function index()
    {
        return ResourceOKResponse::response(LibraryWordResource::collection(LibraryWord::all()));
    }
}
