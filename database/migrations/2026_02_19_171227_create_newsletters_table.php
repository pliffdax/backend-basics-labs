<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('topic_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('subject');
            $table->text('body');
            $table->timestamp('sent_at')->nullable();

            $table->timestamps();

            $table->index(['topic_id', 'sent_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletters');
    }
};
