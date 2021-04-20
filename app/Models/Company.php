<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Company
 * @package App\Models
 * @property Branch[] branches
 * @property int id
 * @property string name
 * @property string profile_picture
 * @property string business_type
 * @property boolean is_visible
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'profile_picture', 'business_type', 'is_visible'];

    /**
     * @return HasMany
     */
    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class, 'company_id', 'id');
    }

}
