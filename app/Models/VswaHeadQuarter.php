<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VswaHeadQuarter extends Model
{
    use HasFactory;

    protected $fillable = ['vswa_hq_name'];

    /**
     * Get the users associated with the VSWA headquarter.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'vswa_hq_id');
    }
}
