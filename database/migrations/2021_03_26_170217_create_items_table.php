
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateItemsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("items", function (Blueprint $table) {

						$table->id('id');
						$table->unsignedBigInteger('seller_id')->nullable();
						$table->unsignedBigInteger('buyer_id')->nullable();
						$table->unsignedBigInteger('secondary_category_id')->nullable();
						$table->unsignedBigInteger('item_condition_id')->nullable();
						

                        $table->string('name');
                        $table->string('image_file_name');
                        $table->text('description');
                        $table->unsignedInteger('price');
                        $table->string('state');

                        $table->timestamps();
                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        $table->foreign("buyer_id")->references("id")->on("users")->onDelete('cascade');
						$table->foreign("seller_id")->references("id")->on("users")->onDelete('cascade');
						$table->foreign('secondary_category_id')->references('id')->on('secondary_categories');
						$table->foreign("item_condition_id")->references("id")->on("item_conditions");



						// ----------------------------------------------------
						// -- SELECT [items]--
						// ----------------------------------------------------
						// $query = DB::table("items")
						// ->leftJoin("users","users.id", "=", "items.buyer_id")
						// ->leftJoin("users","users.id", "=", "items.seller_id")
						// ->leftJoin("secondary_categories","secondary_categories.id", "=", "items.secondry_category_id")
						// ->leftJoin("item_conditions","item_conditions.id", "=", "items.item_condition_id")
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
                Schema::dropIfExists("items");
            }
        }
    