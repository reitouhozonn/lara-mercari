
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateItemConditionsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("item_conditions", function (Blueprint $table) {

						$table->id('id');

                        $table->string('name');
                        $table->unsignedBigInteger('sort_no');

                        $table->timestamps();

						// ----------------------------------------------------
						// -- SELECT [item_conditions]--
						// ----------------------------------------------------
						// $query = DB::table("item_conditions")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("item_conditions");
            }
        }
    