<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * RecipeTest.php
 *
 * Recipe Tests
 *
 * PHP version 5.3+
 * PHPUnit 3.6+
 *
 * @author    Daniel Lee <daniel.james.lee@gmail.com>
 * @date      Nov 03, 2013
*/

require_once('model/Recipe.php');

/**
 * RecipeTest 
 * 
 * @uses      PHPUnit_Framework_TestCase
 * @author    Daniel Lee <daniel.james.lee@gmail.com> 
 */
class RecipeTest extends PHPUnit_Framework_TestCase {
   /**
    * testValidation 
    * 
    * @access public
    * @return void
    */
   public function testValidation() {
        $this->setExpectedException('RecipeValidationException');

        $recipe = new Recipe();
        var_dump($recipe);
   }
}
