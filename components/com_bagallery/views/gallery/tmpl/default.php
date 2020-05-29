<?php
/**
* @package   BaGallery
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

defined('_JEXEC') or die;

$about = bagalleryHelper::aboutUs();
$v = $about->version;
$pagLimit = array(
    5 => 5,
    10 => 10,
    15 => 15,
    20 => 20,
    25 => 25,
    30 => 30,
    50 => 50,
    100 => 100,
    1 => JText::_('JALL'),
);
$language = JFactory::getLanguage();
$language->load('com_bagallery', JPATH_ADMINISTRATOR);
$uploading = new StdClass();
$uploading->const = JText::_('SAVING');
$uploading->uploading = JText::_('UPLOADING_MEDIA');
$uploading->url = JUri::root();
$uploading = json_encode($uploading);
?>
<link rel="stylesheet" href="components/com_bagallery/assets/css/ba-edit.css?<?php echo $v; ?>" type="text/css"/>
<script type="text/javascript">
    var JUri = '<?php echo JUri::root(); ?>',
        bagalleryLanguage = {
        TITLES_MOVED: '<?php echo $language->_('TITLES_MOVED'); ?>'
    }
    if (document.querySelector('link[href*="components/com_bagallery/assets/css/ba-edit.css"]')) {
        var links = [].slice.call(document.querySelectorAll('head link[rel="stylesheet"]'));
        for (var i = 0; i < links; i++) {
            links[i].remove();
        }
    }
</script>
<?php
if (JVERSION >= '4.0.0') {
?>
<script src="<?php echo JUri::root(); ?>media/vendor/jquery/js/jquery.min.js"></script>
<script src="<?php echo JUri::root(); ?>media/vendor/minicolors/js/jquery.minicolors.min.js"></script>
<link rel="stylesheet" href="media/vendor/minicolors/css/jquery.minicolors.css" type="text/css"/>
<?php
} else {
?>
<script src="<?php echo JUri::root(); ?>media/jui/js/jquery.min.js"></script>
<script src="<?php echo JUri::root(); ?>media/jui/js/jquery.minicolors.js"></script>
<link rel="stylesheet" href="media/jui/css/jquery.minicolors.css" type="text/css"/>
<?php
}
?>
<script src="<?php echo JUri::root(); ?>components/com_bagallery/assets/js/bootstrap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="components/com_bagallery/assets/js/ba-edit.js?<?php echo $v; ?>" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.0/ckeditor.js" type="text/javascript"></script>
<input type="hidden" id="saving-media" value="<?php echo htmlentities($uploading); ?>">
<input type="hidden" value="<?php echo JUri::root(); ?>" id="juri-root">
<input type="hidden" value="<?php echo JText::_('SUCCESS_MOVED'); ?>" id="move-to-const">
<input type="hidden" value="<?php echo JText::_('SUCCESS_DELETE'); ?>" id="delete-const">
<input type="hidden" value="<?php echo JText::_('SUCCESS_UPLOAD'); ?>" id="upload-const">
<input type="hidden" value="<?php echo JText::_('CATEGORY_IS_CREATED'); ?>" id="category-const">
<form autocomplete="off" action="<?php echo JRoute::_('index.php?option=com_bagallery&layout=edit&id='); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
            
<?php
echo $this->form->getInput('id');
echo $this->form->getInput('gallery_category');
echo $this->form->getInput('gallery_items');
echo $this->form->getInput('settings');
echo $this->form->getInput('all_sorting');
echo $this->form->getInput('sorting_mode');
echo '<input type="hidden" id="album-mode" value="'.$this->_album.'">';
?>
    <div id="ba-notification">
        <p></p>
    </div>
    <div id="rename-modal" class="ba-modal-sm modal hide" style="display:none">
            <div class="modal-body">
                <h3><?php echo JText::_('RENAME'); ?></h3>
                <input type="text" maxlength="260" class="new-name">
                <span class="focus-underline"></span>
            </div>
            <div class="modal-footer">
                <a href="#" class="ba-btn" data-dismiss="modal">
                    <?php echo JText::_('CANCEL') ?>
                </a>
                <a href="#" class="ba-btn-primary" id="apply-rename">
                    <?php echo JText::_('SAVE') ?>
                </a>
            </div>
        </div>
    <div id="embed-modal" class="ba-modal-md modal hide" style="display:none">
        <div class="ba-modal-header">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
            <h3><?php echo JText::_('EDIT_EMBED'); ?></h3>
        </div>
        <div class="modal-body">
            <textarea type="text" class="ba-embed"></textarea>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CANCEL') ?></a>
            <a href="#" class="ba-btn-primary" id="embed-apply"><?php echo JText::_('SAVE') ?></a>
        </div>
    </div>
    <div id="move-to-modal" class="ba-modal-md modal hide" style="display:none">
            <div class="modal-body">
                <div class="ba-modal-header">
                    <h3><?php echo JText::_('MOVE_TO'); ?></h3>
                    <i data-dismiss="modal" class="zmdi zmdi-close"></i>
                </div>
                <div class="availible-folders">
                    <ul>
                        <li data-id="root">
                            <span>
                                <i class="zmdi zmdi-folder"></i>
                                <?php echo JText::_('ROOT'); ?>
                            </span>                            
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="ba-btn" data-dismiss="modal">
                    <?php echo JText::_('CANCEL') ?>
                </a>
                <a href="#" class="ba-btn-primary apply-move">
                    <?php echo JText::_('SAVE') ?>
                </a>
            </div>
        </div>
    <div id="html-editor" class="ba-modal-lg modal hide" style="display:none">
        <div class="ba-modal-header">
            <h3><?php echo JText::_('EDIT_DESCRIPTION'); ?></h3>
            <div class="modal-header-icon">
                <i class="zmdi zmdi-check" id="apply-html"></i>
                <i class="zmdi zmdi-close" data-dismiss="modal"></i>    
            </div>
        </div>
        <div class="modal-body">
            <textarea name="CKE-editor"></textarea>
        </div>
    </div>
    <div id="add-link-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('INSERT_LINK'); ?></h3>
            <input type="text" class="image-link" placeholder="<?php echo JText::_('LINK'); ?>">
            <span class="focus-underline"></span>
            <div class="ba-custom-select">
                <input type="text" class="link-target" data-value=""
                       readonly placeholder="<?php echo JText::_('TARGET'); ?>">
                <i class="zmdi zmdi-caret-down"></i>
                <ul>
                    <li data-value="blank"><?php echo JText::_('NEW_WINDOW') ?></li>
                    <li data-value="self"><?php echo JText::_('SAME_WINDOW') ?></li>
                </ul>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary active-button" id="add-link">
                <?php echo JText::_('SAVE') ?>
            </a>
        </div>
    </div>
    <div id="create-category-modal" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('CREATE_CATEGORY'); ?></h3>
            <input type="text" class="category-name" placeholder="<?php echo JText::_('CATEGORY_NAME') ?>">
            <span class="focus-underline"></span>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary" id="create-new-category">
                <?php echo JText::_('SAVE') ?>
            </a>
        </div>
    </div>
    <div id="delete-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <h3><?php echo JText::_('DELETE_ITEM'); ?></h3>
            <p class="modal-text can-delete"><?php echo JText::_('MODAL_DELETE') ?></p>
            <p class="modal-text cannot-delete" style="display:none"><?php echo JText::_('CANNOT_DELETE') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal">
                <?php echo JText::_('CANCEL') ?>
            </a>
            <a href="#" class="ba-btn-primary red-btn" id="apply-delete">
                <?php echo JText::_('DELETE') ?>
            </a>
        </div>
    </div>
    <div id="deafult-message-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <p class="modal-text"><?php echo JText::_('CANNOT_DELETE_DEFAULT') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
        </div>
    </div>
    <div id="message-dialog" class="ba-modal-sm modal hide" style="display:none">
        <div class="modal-body">
            <p class="modal-text cannot-default"><?php echo JText::_('CANNOT_DEFAULT') ?></p>
            <p class="modal-text cannot-unpublish" style="display:none"><?php echo JText::_('CANNOT_UNPUBLISH') ?></p>
        </div>
        <div class="modal-footer">
            <a href="#" class="ba-btn" data-dismiss="modal"><?php echo JText::_('CLOSE') ?></a>
        </div>
    </div>
    <div class="gallery-editor row-fluid">
        <div class="category-list span3">
            <a class="create-categery">
                + <?php echo JText::_('CATEGORY'); ?>
            </a>
            <ul>
                <li class="root" id="root">
                    <a>
                        <i class="zmdi zmdi-folder"></i>
                        <span><?php echo JText::_('ROOT'); ?></span>
                    </a>
                    <ul class="root-list">
                        <li id="category-all" class="ba-category" data-id="0">
                            <a>
                                <label>
                                    <input type="checkbox">
                                    <i class="zmdi zmdi-folder"></i>
                                </label>                        
                                <span><?php echo JText::_('ALL'); ?></span>
                                <i class="zmdi zmdi-star"></i>
                                <input type="hidden" class="cat-options" name="cat-options[]"
                                       value="<?php echo JText::_('ALL') ?>;1;1;*;0">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="images-list span6">
            <div class="table-head">
                <input type="checkbox"  id="check-all">
                <i class="zmdi zmdi-check-circle check-all"></i>
                <div class="header-icons">
                    <label class="ba-custom-select">
                        <span>
                            <i class="zmdi zmdi-sort-asc ba-sorting-action-wrapper"></i>
                            <span class="ba-tooltip ba-bottom">
                                <?php echo JText::_('SORT_OPTIONS'); ?>
                            </span>
                        </span>
                        <ul>
                            <li data-value="name"><?php echo JText::_('NAME') ?></li>
                            <li data-value="newest"><?php echo JText::_('NEWEST') ?></li>
                            <li data-value="oldest"><?php echo JText::_('OLDEST') ?></li>
                        </ul>
                    </label>
                    <label>
                        <i class="zmdi zmdi-forward move-to disabled-item"></i>
                        <span class="ba-tooltip ba-bottom">
                            <?php echo JText::_('MOVE_TO'); ?>
                        </span>
                    </label>
                    <label>
                        <i class="zmdi zmdi-playlist-plus filename-to-title disabled-item"></i>
                        <span class="ba-tooltip ba-bottom">
                            <?php echo JText::_('FILENAME_TO_TITLE'); ?>
                        </span>
                    </label>
                    <label>
                        <i class="zmdi zmdi-delete delete-selected disabled-item"></i>
                    </label>
                </div>
                <div class="pagination-limit">
                    <div class="ba-custom-select">
                        <input readonly value="25"
                           data-value="25"
                           size="2" type="text">
                        <i class="zmdi zmdi-caret-down"></i>
                        <ul>
                            <?php
                            foreach ($pagLimit as $key => $lim) {
                                $str = '<li data-value="'.$key.'">';
                                if ($key == 25) {
                                    $str .= '<i class="zmdi zmdi-check"></i>';
                                }
                                $str .= $lim.'</li>';
                                echo $str;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-body">
                <table class="ba-items-list ba-category-table">
                    <tbody>
                        
                    </tbody>
                </table>
                <table class="ba-items-list ba-items-table">
                    <tbody></tbody>
                </table>
            </div>
            <div class="camera-container disabled-item">
                <i class="zmdi zmdi-camera upload-images disabled-item"></i>
            </div>
        </div>
        <div class="gallery-options span3">
            <div class="gallery-header" style="display: none;">
                <label>
                    <i class="zmdi zmdi-edit edit-description"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('EDIT_DESCRIPTION'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-link add-link"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('INSERT_LINK'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-code add-embed-code"></i>
                    <span class="ba-tooltip ba-bottom">
                        <?php echo JText::_('EMBED_CODE'); ?>
                    </span>
                </label>
                <label>
                    <i class="zmdi zmdi-delete delete-item"></i>
                </label>
            </div>
            <div id="category-options" class="category-options" style="display: none;">
                <div class="img-thumbnail">
                    <div class="camera-container">
                        <i class="zmdi zmdi-camera"></i>
                    </div>
                </div>
                <div class="options">
                    <lable class="option-label"><?php echo JText::_('TITLE') ?></lable>
                    <div>
                        <input id="category-name" type="text">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('ALIAS') ?>
                    </lable>
                    <div>
                        <input type="text" class="category-alias">
                        <span class="focus-underline"></span>
                    </div>
                    <div class="checkbox-parent">
                        <div>
                            <label class="ba-checkbox">
                            	<input type="checkbox" class="default-category">
                            	<span></span>
                            </label>
                            <lable class="option-label"><?php echo JText::_('DEFAULT_CATEGORY') ?></lable>
                        </div>
                        <div>
                        	<label class="ba-checkbox">
                        		<input type="checkbox" class="unpublish-category">
                            	<span></span>
                        	</label>                            
                            <lable class="option-label"><?php echo JText::_('UNPUBLISH') ?></lable> 
                        </div>                                               
                    </div>
                </div>                
            </div>
            <div class="images-options" style="display: none;">
                <div class="img-thumbnail">
                    <div class="camera-container">
                        <i class="zmdi zmdi-camera"></i>
                    </div>
                </div>
                <div class="options">
                    <lable class="option-label">
                        <?php echo JText::_('TITLE') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-title">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('ALIAS') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-alias">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('SHORT_DESCRIPTION') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-short">
                        <span class="focus-underline"></span>
                    </div>                    
                    <lable class="option-label">
                        <?php echo JText::_('IMAGE_ALT') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-alt">
                        <span class="focus-underline"></span>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('TAGS') ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help ba-hide-element">
                            <?php echo JText::_('TAGS_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div class="meta-tags">
                        <select style="display: none;" name="meta_tags[]" class="meta_tags" multiple></select>
                        <ul class="picked-tags">
                            <li class="search-tag">
                                <input type="text">
                            </li>
                        </ul>
                        <ul class="all-tags">
                            <?php foreach ($this->tags as $tag) {
                                echo '<li data-id="'.$tag->id.'" style="display:none;">'.$tag->title.'</li>';
                            } ?>
                        </ul>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('COLORS') ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help ba-hide-element">
                            <?php echo JText::_('COLORS_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div class="image-colors">
                        <select style="display: none;" class="image_colors" multiple></select>
                        <ul class="picked-colors">
                            <li class="search-colors">
                                <input type="text">
                            </li>
                        </ul>
                        <ul class="all-colors" style="display: none;">
                            <?php foreach ($this->colors as $color) {
                                echo '<li data-id="'.$color->id.'">'.$color->title.'</li>';
                            } ?>
                        </ul>
                    </div>
                    <lable class="option-label">
                        <?php echo JText::_('ALTERNATIVE_IMAGE'); ?>
                    </lable>
                    <label class="ba-help-icon">
                        <i class="zmdi zmdi-help"></i>
                        <span class="ba-tooltip ba-help">
                            <?php echo JText::_('ALTERNATIVE_IMAGE_TOOLTIP'); ?>
                        </span>
                    </label>
                    <div>
                        <input type="text" class="alternative-image">
                        <span class="focus-underline"></span>
                    </div>
                    <i class="zmdi zmdi-close delete-alternative-image"></i>
                    <lable class="option-label">
                        <?php echo JText::_('CLASS_SUFFIX') ?>
                    </lable>
                    <div>
                        <input type="text" class="image-suffix">
                        <span class="focus-underline"></span>
                    </div>
                    <div class="checkbox-parent">
                        <div>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="hide-in-category-all">
                                <span></span>
                            </label>                            
                            <lable class="option-label"><?php echo JText::_('HIDE_IN_CATEGORY_ALL') ?></lable> 
                        </div>                                               
                    </div>                 
                </div>                
            </div>
            <img src="<?php echo jUri::root().'administrator/components/com_bagallery/assets/images/gallery-logo.svg' ?>">
        </div>
    </div>    
    <div class="ba-context-menu empty-context-menu" style="display: none">
        <span class="upload-images disabled-item"><i class="zmdi zmdi-camera"></i><?php echo JText::_('ADD_IMAGE'); ?></span>
        <span class="create-categery"><i class="zmdi zmdi-folder"></i><?php echo JText::_('CREATE_CATEGORY'); ?></span>
    </div>
    <div class="ba-context-menu files-context-menu" style="display: none">
        <span class="move-to"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
        <span class="upload-images ba-group-element"><i class="zmdi zmdi-cloud-upload"></i><?php echo JText::_('ADD_IMAGE'); ?></span>
        <span class="create-categery"><i class="zmdi zmdi-folder"></i><?php echo JText::_('CREATE_CATEGORY'); ?></span>
        <span class="delete ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('DELETE'); ?></span>
    </div>
    <div class="ba-context-menu folders-context-menu" style="display: none">
        <span class="rename"><i class="zmdi zmdi-edit"></i><?php echo JText::_('RENAME'); ?></span>
        <span class="move-to"><i class="zmdi zmdi-forward"></i><?php echo JText::_('MOVE_TO'); ?>...</span>
        <span class="delete ba-group-element"><i class="zmdi zmdi-delete"></i><?php echo JText::_('DELETE'); ?></span>
    </div>
    <div class="ba-context-menu help-context-menu" style="display: none">
        <span class="quick-view"><i class="zmdi zmdi-graduation-cap"></i><?php echo JText::_('QUICK_VIEW'); ?></span>
        <span class="documentation">
            <a target="_blank" href="http://www.balbooa.com/joomla-gallery-documentation/basics">
                <i class="zmdi zmdi-info"></i><?php echo JText::_('DOCUMENTATION'); ?>
            </a>
        </span>
        <span class="support ba-group-element">
            <a target="_blank" href="http://support.balbooa.com/forum/joomla-gallery">
                <i class="zmdi zmdi-help"></i><?php echo JText::_('SUPPORT'); ?>
            </a>
        </span>
    </div>
    <input type="hidden" name="task" value="forms.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>
<div class="save-gallery" onclick="Joomla.submitbutton('gallery.save')">
    <i class="zmdi zmdi-check"></i>
    <span><?php echo JText::_('SAVE'); ?></span>
</div>
<div id="file-upload-form" style="display: none;">
    <form target="upload-form-target" enctype="multipart/form-data" method="post"
        action="<?php echo JUri::base(); ?>index.php?option=com_bagallery&task=gallery.formUpload">
        <input type="file" multiple name="files[]">
    </form>
    <iframe src="javascript:''" name="upload-form-target"></iframe>
</div>