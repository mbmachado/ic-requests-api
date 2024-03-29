<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Enums\AssigneeType;
use \App\Enums\StepType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('assignee_type', AssigneeType::getValues())
                ->default(AssigneeType::Office->value)
                ->nullable();
            $table->enum('step_type', StepType::getValues())->default(StepType::Intermediate->value);
            $table->unsignedTinyInteger('order');
            $table->foreignId('workflow_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('steps');
    }
};
