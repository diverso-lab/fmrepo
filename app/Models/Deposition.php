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
        'dataset_id'
    ];

    public function dataset()
    {
        return $this->belongsTo('App\Models\Dataset');
    }

    public function files()
    {
        return $this->hasMany('App\Models\DepositionFile');
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function is_deposition_empty()
    {
        return count($this->files) == 0;
    }
}
