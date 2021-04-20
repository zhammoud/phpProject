<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

/**
 * Class Branch
 * @package App\Models
 * @property Company company
 * @property Department[] departments
 * @property int id
 * @property string name
 * @property boolean is_visible
 * @property Date establishment_date
 */
class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'establishment_date', 'company_id','is_visible'];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function departments(): HasMany
    {
        return $this->hasMany(Department::class, 'branch_id', 'id');
    }
}
