<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name_vswa',
        'abbrevation_vswa',
        'vswa_email',
        'vswa_phone',
        'applicant_name',
        'applicant_email',
        'applicant_mobile_no',
        'applicant_type',
        'password',
        'retype_password',
        'thematic_id',
        'vswa_hq_id'
    ];

    /**
     * Get the thematic area associated with the user.
     */
    public function thematicArea()
    {
        return $this->belongsTo(ThematicArea::class, 'thematic_id');
    }

    /**
     * Get the VSWA headquarter associated with the user.
     */
    public function vswaHeadQuarter()
    {
        return $this->belongsTo(VswaHeadQuarter::class, 'vswa_hq_id');
    }
}
