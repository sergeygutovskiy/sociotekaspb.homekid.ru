<?php

namespace App\Http\Controllers\Client;

use App\Enums\CompanyStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\CompanyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Получить компанию авторизованного юзера
     *
     * @group Компании
     * @authenticated
     *
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $company = $user->company;

        return response()->json([
            'error' => null,
            'data' => new CompanyResource($company),
        ]);
    }

    /**
     * Обновить компанию авторизованного юзера
     *
     * @group Компании
     * @authenticated
     *
     * @bodyParam name string required Краткое наименование организации Example: Компания 1
     * @bodyParam full_name string required Полное наименование организации Example: Полное название компании
     * @bodyParam owner string required Руководитель организации Example: Владелец
     * @bodyParam responsible string required Ответственный за предоставление информации Example: Ответственный
     * @bodyParam organization_type_id int required Тип организации Example: 1
     * @bodyParam district_id int required Район Example: 1
     * @bodyParam is_has_education_license bool required Наличие лицензии на осуществление образовательной деятельности Example: false
     * @bodyParam is_has_mdedical_license bool required Наличие лицензии на осуществление медицинской деятельности Example: false
     * @bodyParam is_has_innovative_platform bool required Наличие инновационной площадки в организации Example: false
     * 
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'full_name' => 'required',
            'owner' => 'required',
            'responsible' => 'required',
            'organization_type_id' => 'required|numeric|exists:dictionaries,id',
            'district_id' => 'required|numeric|exists:dictionaries,id',
            'is_has_education_license' => 'required|boolean',
            'is_has_mdedical_license' => 'required|boolean',
            'is_has_innovative_platform' => 'required|boolean',
        ]);

        if ( $validator->fails() ) 
        {
            return response()->json([
                'error' => 'Ошибка валидации полей',
                'data' => null,
            ], 401);
        }

        $validated = $validator->validated();
        $validated['status'] = CompanyStatus::Pending;

        $user = $request->user();
        $company = $user->company;

        $company->update($validated);

        return response()->json([
            'error' => null,
            'data' => new CompanyResource($company),
        ]);
    }
}
