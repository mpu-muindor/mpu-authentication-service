<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Professor;

/**
 * @property integer $id
 * @property integer $professor_id
 * @property string $department
 * @property string $position
 * @property string $multiplier
 * @property string $created_at
 * @property string $updated_at
 * @property Professor $professor
 */
class EmploymentData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employment_data';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['professor_id', 'department', 'position', 'multiplier', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
}
