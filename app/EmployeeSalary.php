<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
   protected $fillable = ['employee_id','salary_id', 'amount','paid_date','day','month','year'];
}
