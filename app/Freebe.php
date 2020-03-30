<?php

namespace BirthdayFreebe;

use Illuminate\Database\Eloquent\Model;

class Freebe extends Model
{
    //
    //
    public $table = "freebes";

    //found this online, this code automatically updates created_at and updated_at:
    public $timestamps = true;

    //note: $fillable means its ok to enter data in this column, and $guarded means to not fill it, like an admin_key, that should not be allowed easy access to be filled

    protected $fillable = [
    	'name',
        'details',
        'type_name',
        'start_date',
        'end_date',
        'location_id', 
        'business_id',   
    ];
}
