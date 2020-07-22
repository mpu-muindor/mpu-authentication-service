<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

/**
 * @property integer $id
 * @property string $title
 * @property Department[] $departments
 */
class Faculty extends Model
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
    protected $fillable = ['title'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
