<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UserFile\StoreRequest;
use App\Http\Resources\Client\UserFileResource;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\OKResponse;
use App\Models\User;

class UserFileController extends Controller
{
    public function store(StoreRequest $request, User $user)
    {
        $file = $request->file('file');
        $file_category = $request->validated('category');

        $path_to_save = 'users/' . $user->id . '/' . $file_category; 
        $saved_file_path = $file->store($path_to_save, 'public');

        if ( !$saved_file_path ) return ErrorResponse::response('Не удалось сохранить файл', 400);

        $file = $user->files()->create([
            'path' => $saved_file_path,
            'original_name' => $file->getClientOriginalName(),
            'category' => $file_category,
        ]);

        return OKResponse::response([
            'file' => new UserFileResource($file),
        ]);
    }
}
