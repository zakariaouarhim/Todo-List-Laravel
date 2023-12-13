<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usertodo extends Model
{
    use HasFactory;

    protected $table = 'user_table'; // Specify the name of your table

    protected $fillable = ['name ', 'Email','password']; // Specify the columns that can be mass-assigned
}
