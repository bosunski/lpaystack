<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Xeviant\Paystack\Contract\PaystackEventType;

class CreateLaravelPaystackEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laravel_paystack_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('event', $this->getEventTypes());
            $table->text('payload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paystack_events');
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    public function getEventTypes(): array
    {
        return collect((new ReflectionClass(PaystackEventType::class))->getConstants())->values()->toArray();
    }
}
