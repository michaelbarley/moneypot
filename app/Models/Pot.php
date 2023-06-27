<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'is_private',
        'description',
        'amount',
        'goal',
        'status',
        'cover_photo_path',
        'accent_colour',
        'is_auto_closing',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'double',
        'goal' => 'double',
        'is_private' => 'double',
    ];

    public function administrators()
    {
        return $this->hasMany(Administrator::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
