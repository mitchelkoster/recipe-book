<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Measurement;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // List of ingredients to populate the database with
        $ingredients = [
            "salt","sugar","butter","black pepper","onion","eggs","all-purpose flour","water","olive oil",
            "pepper","milk","garlic cloves","unsalted butter","vegetable oil","extra-virgin olive oil","brown sugar",
            "baking powder","lemon juice","vanilla extract","freshly ground pepper","carrots","cloves garlic","flour",
            "baking soda","tomatoes","kosher salt","ground cinnamon","green onions","large eggs","vanilla","sour cream",
            "honey","cream cheese","granulated sugar","red onion","chicken broth","fresh parsley","garlic powder",
            "cornstarch","oil","grated parmesan cheese","minced garlic","white sugar","mayonnaise","ground cumin",
            "soy sauce","fresh lemon juice","heavy cream","cinnamon","margarine","celery","paprika","shallots",
            "fresh cilantro","potatoes","chili powder","worcestershire sauce","red bell pepper","canola oil","dijon mustard",
            "egg whites","bacon","powdered sugar","lemon","orange juice","dried oregano","scallions","shredded cheddar cheese",
            "cooking spray","cayenne pepper","ground beef","sea salt","shrimp","diced tomatoes","strawberries","melted butter",
            "spinach","ground nutmeg","zucchini","egg yolks","fresh basil","garlic","dry white wine","balsamic vinegar",
            "parmesan cheese","juice","apples","chopped walnuts","ground ginger","semisweet chocolate","chopped pecans","chicken stock"
            ,"buttermilk","chicken","fresh ginger","light brown sugar","lime juice","red pepper","chicken breasts","raisins","red wine vinegar"
        ];

        // Retrieve random vegatable
        $randomIngredient = $ingredients[array_rand($ingredients)];

        // Retrieve random measurement for recipe
        $randomMeasurementId = Measurement::inRandomOrder()
            ->firstOrFail()
            ->id;

        return [
            'name' => $randomIngredient,
            'qty' => rand(1, 10),
            'measurement_id' => $randomMeasurementId
        ];
    }
}
