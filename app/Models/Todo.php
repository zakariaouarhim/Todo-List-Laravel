<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $table = 'todo_list'; // Specify the name of your table

    protected $fillable = ['task', 'time_created']; // Specify the columns that can be mass-assigned
    
}
