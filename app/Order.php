<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['employee_id', 'customer_id', 'user_id', 'plus', 'height', 'width', 'length'];

    public function bags()
    {
        return $this->hasMany(Bag::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commission()
    {
        return $this->belongsTo(Commission::class);
    }

}
