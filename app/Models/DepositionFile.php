<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositionFile extends Model
{
    use HasFactory;

    protected $table = 'deposition_files';

    protected $fillable = [
        'checksum',
        'filename',
        'filesize',
        'file_id',
        'download_link',
        'self_link'
    ];

    public function deposition()
    {
        return $this->belongsTo('App\Models\Deposition');
    }
}
