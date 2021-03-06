<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSetCommunity extends Model
{
    use HasFactory;

    protected $table = "datasetscommunity";

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }

    public function dataset()
    {
        return $this->belongsTo('App\Models\Dataset');
    }
}
