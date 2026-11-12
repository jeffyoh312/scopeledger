<?php
namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\ChangeRequest;
use Illuminate\Http\Request;
class ProjectController extends Controller {
 public function index(){ return view('dashboard',['projects'=>Project::with('changes')->latest()->get()]); }
 public function store(Request $r){
  $d=$r->validate(['name'=>'required|string|max:120','client'=>'required|string|max:120','fee'=>'required|regex:/^\d{1,7}(\.\d{1,2})?$/']);
  Project::create(['name'=>$d['name'],'client'=>$d['client'],'fee_cents'=>$this->cents($d['fee'])]);
  return back()->with('message','Project created.');
 }
 public function change(Request $r,Project $project){
  $d=$r->validate(['description'=>'required|string|max:1000','amount'=>'required|regex:/^\d{1,7}(\.\d{1,2})?$/','source'=>'required|in:WhatsApp,Email,Call,Meeting']);
  $project->changes()->create(['description'=>$d['description'],'amount_cents'=>$this->cents($d['amount']),'source'=>$d['source'],'status'=>'pending']);
  return back()->with('message','Change recorded for review.');
 }
 public function decide(Request $r,ChangeRequest $change){
  $d=$r->validate(['status'=>'required|in:approved,rejected']);
  $updated=ChangeRequest::whereKey($change->id)->where('status','pending')->update(['status'=>$d['status'],'updated_at'=>now()]);
  abort_unless($updated,409,'This request already has a decision.');
  return back()->with('message','Decision recorded.');
 }
 private function cents(string $value): int { $parts=explode('.',$value); return ((int)$parts[0]*100)+(int)str_pad($parts[1]??'',2,'0'); }
}
