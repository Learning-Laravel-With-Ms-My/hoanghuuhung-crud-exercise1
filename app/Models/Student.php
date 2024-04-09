<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    public $timestamps = false;
    public function getAll(){
        return DB::table($this->table)->select('id','name','phone')->paginate(3);
    }
    public function insertData($data){
        return DB::table($this->table)->insert($data);
    }
    public function getOne($id){
        return DB::table($this->table)->where('id', $id)->first();
    }
    public function updateStudent($id, $data){
        return DB::table($this->table)->where('id', $id)->update($data);
    }
    public function deleteUser($id){
        return DB::table($this->table)->where('id', $id)->delete();
    }
}
