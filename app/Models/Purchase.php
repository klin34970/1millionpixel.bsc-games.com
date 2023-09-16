<?php

namespace App\Models;

use App\Traits\HasUploads;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUploads;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'link',
    ];

    protected $appends = [
        'upload',
        'upload_url',
        'upload_hash'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function uploads(){
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
