<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $birthday
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property string $about
 * @property string $created_at
 * @property string $updated_at
 * @property Professor[] $professors
 * @property Student[] $students
 */
class User extends Model
{
    /**
     * @var bool
     */
    public $incrementing = false;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
    /**
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'birthday', 'login', 'email', 'password', 'phone', 'about'
    ];
    protected $hidden = [
        'password'
    ];
    protected $appends = ['user_type'];

    protected static function boot()
    {
        parent::boot();

        static::creating(static function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    public function getUserTypeAttribute()
    {
        return ($this->students()->get()->toArray()) ? 'student' : 'professor';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function professors()
    {
        return $this->hasMany(Professor::class);
    }
}
