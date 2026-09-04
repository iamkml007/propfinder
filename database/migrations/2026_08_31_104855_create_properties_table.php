<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 15, 2);
            $table->enum('purpose', ['sale', 'rent']);
            $table->enum('type', ['apartment', 'villa', 'house', 'land', 'commercial']);
            $table->enum('status', ['available', 'sold', 'rented'])->default('available');
            $table->decimal('area', 10, 2)->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(true);
            $table->string('main_image')->nullable();
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message');
            $table->enum('status', ['new', 'read', 'replied'])->default('new');
            $table->timestamps();
        });

        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->unique(['user_id', 'property_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('properties');
    }
};