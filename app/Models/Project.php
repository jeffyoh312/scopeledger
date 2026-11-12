<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Project extends Model {
 protected $fillable = ['name','client','fee_cents'];
 public function changes(): HasMany { return $this->hasMany(ChangeRequest::class); }
 public function approvedTotal(): int { return $this->fee_cents + (int) $this->changes()->where('status','approved')->sum('amount_cents'); }
}
