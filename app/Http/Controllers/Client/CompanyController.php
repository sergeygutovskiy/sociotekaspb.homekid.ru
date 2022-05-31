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
     * 
     * @bodyParam phone string required Номер телефона организации Example: 8 (800) 123 45-67
     * @bodyParam email string required Электронная почта организации Example: site@yandex.ru
     * @bodyParam site string required Ссылка на официальный сайт организации Example: https://site
     * 
     * @bodyParam owner string required Руководитель организации Example: Владелец
     * @bodyParam responsible string required Ответственный за предоставление информации Example: Ответственный
     * @bodyParam responsible_phone string required Телефон ответственного за предоставление информации Example: 8 (800) 123 45-67
     * 
     * @bodyParam organization_type_id int required Тип организации Example: 1
     * @bodyParam district_id int required Район Example: 1
     * 
     * @bodyParam education_license object optional Лицензия на осуществление образовательной деятельности
     * @bodyParam education_license.number int Номер лицензии Example: 1234
     * @bodyParam education_license.type string Вид деятельности Example: Дошкольное образование
     * @bodyParam education_license.date string Дата выдачи лицензии Example: 22.05.2022
     * 
     * @bodyParam medical_license object optional Лицензия на осуществление медицинской деятельности
     * @bodyParam medical_license.number int Номер лицензии Example: 1234
     * @bodyParam medical_license.date string Дата выдачи лицензии Example: 22.05.2022
     * 
     * @bodyParam is_has_innovative_platform bool required Наличие инновационной площадки в организации
     * 
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'full_name' => 'required',

            'phone' => 'required',
            'email' => 'required',
            'site' => 'required',

            'owner' => 'required',
            'responsible' => 'required',
            'responsible_phone' => 'required',

            'organization_type_id' => 'required|numeric|exists:dictionaries,id',
            'district_id' => 'required|numeric|exists:dictionaries,id',
            
            'education_license' => 'array:number,date,type|required|nullable',
            'education_license.number' => 'required_with:education_license|numeric',
            'education_license.date' => 'required_with:education_license|date_format:d.m.Y',
            'education_license.type' => 'required_with:education_license',

            'medical_license' => 'array:number,date|required|nullable',
            'medical_license.number' => 'required_with:medical_license|numeric',
            'medical_license.date' => 'required_with:medical_license|date_format:d.m.Y',
            
            'is_has_innovative_platform' => 'required|boolean',
        ]);

        if ( $validator->fails() ) 
        {
            return response()->json([
                'error' => 'Ошибка валидации',
                'data' => null,
            ], 400);
        }

        $validated = $validator->validated();
        $validated['status'] = CompanyStatus::Pending;

        $user = $request->user();
        $company = $user->company;

        $company->update($validated);

        return response()->json([
            'error' => null,
            'data' => null,
        ]);
    }
}
