<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityDatasetOwner extends Model
{
    use HasFactory;

    protected $table = "communitydatasetowners";

    protected $fillable = [
      'user_id',
      'community_dataset_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function community_dataset()
    {
        return $this->belongsTo('App\Models\CommunityDataset');
    }
}
