<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $department_id
 * @property string $title
 * @property string $specialty
 * @property string $specialization
 * @property string $study_program
 * @property int $study_period
 * @property string $study_form
 * @property string $start_year
 * @property Department $department
 * @property Student[] $students
 */
class Group extends Model
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
    protected $fillable = [
        'department_id',
        'title', 'specialty',
        'specialization',
        'study_program',
        'study_period',
        'study_form',
        'start_year'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
