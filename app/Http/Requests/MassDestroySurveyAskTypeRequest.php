<?php

namespace App\Http\Requests;

use App\Models\SurveyAskType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySurveyAskTypeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('survey_ask_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:survey_ask_types,id',
        ];
    }
}
