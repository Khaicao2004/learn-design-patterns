<?php

use App\Models\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_receiver_id_foreign');
            $table->dropColumn('receiver_id');
            $table->dropColumn('is_read');
            $table->foreignIdFor(Group::class)->after('id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('receiver_id')->after('sender_id');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_read')->after('content')->default(false);
            $table->dropForeignIdFor(Group::class);
            $table->dropColumn('group_id');
        });
    }
};
