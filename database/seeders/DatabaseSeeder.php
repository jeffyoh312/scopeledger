<?php
namespace Database\Seeders;
use App\Models\Project;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder {
 public function run(): void {
  $p=Project::firstOrCreate(['name'=>'Studio Meranti website'],['client'=>'Studio Meranti','fee_cents'=>250000]);
  if($p->changes()->exists()) return;
  $p->changes()->createMany([
   ['description'=>'Add a bilingual contact form','amount_cents'=>35000,'source'=>'WhatsApp','status'=>'pending'],
   ['description'=>'Build a booking confirmation page','amount_cents'=>50000,'source'=>'Meeting','status'=>'approved'],
   ['description'=>'Add an animated opening sequence','amount_cents'=>80000,'source'=>'Call','status'=>'rejected'],
  ]);
 }
}
