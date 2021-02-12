<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $table ="company";

    protected $fillable =['company_id', 'companyName'];
    use HasFactory;
}
