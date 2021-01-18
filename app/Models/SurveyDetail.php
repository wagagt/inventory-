<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SurveyDetail extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'survey_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'ask',
        'response',
        'survey_id',
        'ask_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

    public function ask_type()
    {
        return $this->belongsTo(SurveyAskType::class, 'ask_type_id');
    }
}
