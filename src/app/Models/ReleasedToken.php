<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $token
 * @property string|Carbon $created_at
 * @property string|Carbon $updated_at
 */
class ReleasedToken extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'token';
    protected $keyType = 'string';
    protected $fillable = ['token'];
}
