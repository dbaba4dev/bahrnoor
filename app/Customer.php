<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'credit_limit', 'employee_id', 'balance','area_id'];

    protected $dates = ['deleted_at'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
