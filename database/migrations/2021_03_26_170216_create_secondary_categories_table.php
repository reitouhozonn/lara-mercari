
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateSecondaryCategoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("secondary_categories", function (Blueprint $table) {

						$table->id('id');
						$table->unsignedBigInteger('primary_category_id')->unsigned();
						//$table->foreign("primary_category_id")->references("id")->on("primary_categories");



						// ----------------------------------------------------
						// -- SELECT [secondary_categories]--
						// ----------------------------------------------------
						// $query = DB::table("secondary_categories")
						// ->leftJoin("primary_categories","primary_categories.id", "=", "secondary_categories.primary_category_id")
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
                Schema::dropIfExists("secondary_categories");
            }
        }
    