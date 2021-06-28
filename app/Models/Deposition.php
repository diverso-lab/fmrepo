<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'conceptrecid',
        'doi',
        'doi_url',
        'prereserve_doi',
        'created',
        'modified',
        'owner',
        'record_id',
        'state',
        'submitted',
        'access_right',
        'title',
        'description',
        'license',
        'upload_type',
        'user_id',
        'feature_model_id'
    ];

    public function feature_model()
    {
        return $this->belongsTo('App\Models\FeatureModel');
    }

    public function files()
    {
        return $this->hasMany('App\Models\DepositionFile');
    }
}
