<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property integer $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    /**
     * Устанавливает uuid новому пользователю.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(static function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'login',
        'email',
        'password',
    ];

    protected $hidden = ['password'];

    public function tokens(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApiToken::class);
    }
}
