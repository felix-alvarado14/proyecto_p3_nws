<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers;

use Controllers\PrivateController;
use Utilities\Site;

/**
 * Index Controller
 *
 * @category Public
 * @package  Controllers
 * @author   Orlando J Betancourth <orlando.betancourth@gmail.com>
 * @license  MIT http://
 * @link     http://
 */
class Indexadmin extends PrivateController
{
    /**
     * Index run method
     *
     * @return void
     */
    public function run() :void
    {
        Site::addLink("public/css/landing.css");
        $viewData = array();
        \Views\Renderer::render("indexadmin", $viewData);
    }
}
?>
