<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Project;
class ScopeLedgerTest extends TestCase {
 use RefreshDatabase;
 public function test_home_loads(): void { $this->get('/')->assertOk()->assertSee('ScopeLedger'); }
 public function test_money_is_stored_as_integer_cents(): void {
  $this->post('/projects',['name'=>'Site','client'=>'Client','fee'=>'120.09'])->assertRedirect();
  $this->assertDatabaseHas('projects',['fee_cents'=>12009]);
 }
 public function test_invalid_money_is_rejected(): void {
  foreach(['-5','1.001','abc','10000000'] as $fee) $this->post('/projects',['name'=>'Site','client'=>'Client','fee'=>$fee])->assertSessionHasErrors('fee');
  $this->assertDatabaseCount('projects',0);
 }
 public function test_only_approved_changes_affect_total_and_decisions_are_final(): void {
  $p=Project::create(['name'=>'Site','client'=>'Client','fee_cents'=>10000]);
  $this->post('/projects/'.$p->id.'/changes',['description'=>'Extra','amount'=>'25.50','source'=>'Call'])->assertRedirect();
  $c=$p->changes()->first();
  $this->assertSame(10000,$p->approvedTotal());
  $this->patch('/changes/'.$c->id,['status'=>'approved'])->assertRedirect();
  $this->assertSame(12550,$p->approvedTotal());
  $this->patch('/changes/'.$c->id,['status'=>'rejected'])->assertStatus(409);
 }
 public function test_rejection_does_not_increase_total(): void {
  $p=Project::create(['name'=>'Site','client'=>'Client','fee_cents'=>10000]);
  $c=$p->changes()->create(['description'=>'Extra','amount_cents'=>500,'source'=>'Email','status'=>'pending']);
  $this->patch('/changes/'.$c->id,['status'=>'rejected'])->assertRedirect();
  $this->assertSame(10000,$p->approvedTotal());
 }
 public function test_invalid_status_and_missing_project_are_rejected(): void {
  $this->post('/projects/999/changes',[])->assertNotFound();
  $p=Project::create(['name'=>'Site','client'=>'Client','fee_cents'=>100]);
  $c=$p->changes()->create(['description'=>'Extra','amount_cents'=>100,'source'=>'Call','status'=>'pending']);
  $this->patch('/changes/'.$c->id,['status'=>'paid'])->assertSessionHasErrors('status');
 }
}
