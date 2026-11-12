<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ChangeRequest extends Model {
 protected $fillable = ['description','amount_cents','source','status'];
}
