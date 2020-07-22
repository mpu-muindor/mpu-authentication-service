<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Faculty;
use App\Models\Group;

/**
 * @property integer $id
 * @property integer $faculty_id
 * @property string $title
 * @property Faculty $faculty
 * @property Group[] $groups
 */
class Department extends Model
{
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
    protected $fillable = ['faculty_id', 'title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
