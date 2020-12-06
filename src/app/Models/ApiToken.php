<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 */
class ApiToken extends Model
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static function (Model $model) {
            $model->setAttribute($model->getKeyName(), Str::random(40));
        });
    }

    protected $table = 'api_tokens';
    protected $primaryKey = 'token';
    protected $keyType = 'string';
    protected $fillable = ['token', 'user_id'];
    protected $hidden = ['user_id'];

    public $incrementing = false;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
