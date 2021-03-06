<?php

namespace App\Http\Requests;

use App\Models\SurveyAskType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSurveyAskTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('survey_ask_type_create');
    }

    public function rules()
    {
        return [
            'name'  => [
                'string',
                'nullable',
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
