<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EmploymentData;
use App\Models\User;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $location
 * @property User $user
 * @property EmploymentData[] $employmentData
 */
class Professor extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'location'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employmentDatas()
    {
        return $this->hasMany(EmploymentData::class);
    }
}
