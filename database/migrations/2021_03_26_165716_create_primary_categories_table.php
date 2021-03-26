
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreatePrimaryCategoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("primary_categories", function (Blueprint $table) {

						$table->id('id');



						// ----------------------------------------------------
						// -- SELECT [primary_categories]--
						// ----------------------------------------------------
						// $query = DB::table("primary_categories")
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
                Schema::dropIfExists("primary_categories");
            }
        }
    