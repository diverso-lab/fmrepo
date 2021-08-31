<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityDataset extends Model
{
    use HasFactory;

    protected $table = "communitydatasets";

    protected $fillable = [
        'dataset_id',
        'community_id'
    ];

    public function community()
    {
        return $this->belongsTo('App\Models\Community');
    }

    public function dataset()
    {
        return $this->belongsTo('App\Models\Dataset');
    }

    public function community_dataset_owner()
    {
        return $this->hasOne('App\Models\CommunityDatasetOwner');
    }
}
