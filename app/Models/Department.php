<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

/**
 * Class Department
 * @package App\Models
 * @property Branch branch
 * @property int id
 * @property string name
 * @property int number_of_employees
 * @property int branch_id
 * @property boolean is_visible
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name','number_of_employees','branch_id','is_visible'];

    /**
     * @return BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

}
