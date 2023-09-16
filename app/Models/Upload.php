<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Upload extends Model
{
    use HasFactory;
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uploadable_id',
        'uploadable_type',
        'original_name',
        'name',
        'type',
        'size',
        'file',
        'position',
    ];

    /**
     * Get the parent imageable model (user or post).
     */
    public function uploadable()
    {
        return $this->morphTo();
    }


}
