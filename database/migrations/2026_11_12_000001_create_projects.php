<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('projects',function(Blueprint $t){ $t->id(); $t->string('name'); $t->string('client'); $t->unsignedInteger('fee_cents'); $t->timestamps(); });
  Schema::create('change_requests',function(Blueprint $t){ $t->id(); $t->foreignId('project_id')->constrained()->cascadeOnDelete(); $t->text('description'); $t->unsignedInteger('amount_cents'); $t->string('source'); $t->string('status')->default('pending'); $t->timestamps(); });
 }
 public function down(): void { Schema::dropIfExists('change_requests'); Schema::dropIfExists('projects'); }
};
