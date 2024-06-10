<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->id(); // id
            $table->string('id_bill')->unique(); // id_bill
            $table->unsignedBigInteger('id_user'); // id_user
            $table->string('booker_name'); // booker_name
            $table->string('booker_email'); // booker_email
            $table->string('booker_phone'); // booker_phone
            $table->string('booker_address'); // booker_address
            $table->string('receiver_name'); // receiver_name
            $table->string('receiver_phone'); // receiver_phone
            $table->string('receiver_address'); // receiver_address
            $table->decimal('total', 10, 2); // total
            $table->decimal('ship', 10, 2); // ship
            $table->string('voucher')->nullable(); // voucher, có thể null
            $table->string('payment_methods'); // payment_methods
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('id_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill');
    }
}
