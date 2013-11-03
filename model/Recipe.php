<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Recipe.php
 *
 * Reprsents a single recipe
 *
 * PHP version 5.3+
 *
 * @author    Daniel Lee <daniel.james.lee@gmail.com>
 * @date      Nov 03, 2013
*/

/**
 * RecipeValidationException 
 * 
 * @author    Daniel Lee <daniel.james.lee@gmail.com> 
 */
class RecipeValidationException extends \Exception {}

/**
 * Recipe 
 * 
 * @author    Daniel Lee <daniel.james.lee@gmail.com> 
 */
class Recipe {
    /**
     * name 
     * 
     * @var string
     * @access private
     */
    private $name = '';

    /**
     * ingredients 
     * 
     * @var array
     * @access private
     */
    private $ingredients  = array();

    /**
     * validationRule 
     * 
     * @var string
     * @access private
     */
    private $validationRule = '/^(.+)$/';

    /**
     * Recipe 
     * 
     * @param string $name 
     * @access public
     * @return void
     */
    public function Recipe($name = '') {
        if (!preg_match($this->validationRule, $name))
            throw new RecipeValidationException("Invalid name for recipe");

        $this->name = $name;
    }

    /**
     * Adds an ingredient to the recipe 
     * 
     * @param Ingredient $item 
     * @access public
     * @return boolean
     */
    public function addIngredient(Ingredient $item) {
        $this->ingredients[] = $item;
        return true;
    }

    /**
     * Checks whether the recipe matches a list of ingredients 
     * 
     * @param array $ingredients 
     * @access public
     * @return boolean/int
     */
    public function checkIngredients($ingredients = array()) {
        $earliestExpiry = 0;
        foreach ($this->ingredients as $recipeIngredient) {
            $ingredientFound = false;

            foreach ($ingredients as $ingredient) {
        
                if ($ingredient->getItem() == $recipeIngredient->getItem() &&
                    $ingredient->getUnit() == $recipeIngredient->getUnit() &&
                    $ingredient->getAmount() >= $recipeIngredient->getAmount() &&
                    $ingredient->getIsExpired() === false) {
                    // ingredient found
                    $ingredientFound = true;

                    // mark the earliest expiry
                    if ($earliestExpiry == 0 || 
                        $earliestExpiry > $ingredient->getUseBy())
                        $earliestExpiry = $ingredient->getUseBy();
                }
            }

            if ($ingredientFound == false) 
                return false;
        }

        // passed all the ingredients, pass back the earliest expiry for sorting
        return $earliestExpiry;
    }

    /**
     * getName 
     * 
     * @access public
     * @return string
     */
    public function getName() {
        return $this->name;
    }
}
