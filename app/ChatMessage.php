<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';
    protected $fillable = ['to_employee_id','from_employee_id','message','status','image', 'team_id'];


    function get_user_name($user_id)
    {
        $query =  User::select('username')->where('id',  $user_id)->get();

        foreach($query as $row)
        {
        return $row['username'];
        }
    }

    

}
