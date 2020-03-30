<?php

namespace BirthdayFreebe;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
    public $table = "businesses";

    //found this online, this code automatically updates created_at and updated_at:
    public $timestamps = true;

    //note: $fillable means its ok to enter data in this column, and $guarded means to not fill it, like an admin_key, that should not be allowed easy access to be filled

    protected $fillable = [
    	'location_id',
        'name',
        'zip_code',
        'address',
        'city',
        'state',
        'phone',
        'email', 
        'type_name', 
        'number_of_freebes',
        'created_at',
        'updated_at'
       
    ];
}
