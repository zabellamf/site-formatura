<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

class galleryTableCategory extends JTable
{
    function __construct(&$db) 
    {
        parent::__construct('#__bagallery_category', 'id', $db);
    }
}