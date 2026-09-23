<?php

use App\Http\Controllers\DemoController;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('demos', function (Blueprint $table) {
            $table->id();
            // Doit correspondre à une clé du registre DemoController::registry().
            $table->string('slug')->unique();
            $table->string('name');
            $table->unsignedInteger('price')->nullable();
            $table->string('demo_url')->nullable();
            $table->timestamps();
        });

        // Amorçage : une ligne par démo déclarée dans le code, pour que les
        // captures et le tarif soient immédiatement éditables en back-office.
        $now = now();

        DB::table('demos')->insert(array_map(fn (array $demo) => [
            'slug' => $demo['slug'],
            'name' => $demo['name'],
            'price' => $demo['price'],
            'demo_url' => $demo['demoUrl'],
            'created_at' => $now,
            'updated_at' => $now,
        ], array_values(DemoController::registry())));
    }

    public function down(): void
    {
        Schema::dropIfExists('demos');
    }
};
