<?php /* @var $theView \fpcm\view\viewVars */ ?>
<div class="fpcm-ui-dialog-layer fpcm-ui-hidden fpcm-massedit-dialog" id="fpcm-dialog-articles-massedit">
    
    <div class="row fpcm-ui-padding-md-tb">
        <label class="col-12 col-md-4 fpcm-ui-field-label-general">
            <?php $theView->icon('tags')->setSize('lg'); ?>
            <?php $theView->write('TEMPLATE_ARTICLE_CATEGORYTEXTS'); ?>
        </label>
        <div class="col-12 col-md-auto fpcm-ui-padding-none-lr">
            <div class="fpcm-ui-massedit-categories">
                <?php foreach ($massEditCategories as $name => $id) : ?>
                <?php $theView->checkbox('categories[]', 'cat'.$id)->setClass('fpcm-ui-input-massedit-categories')->setText($name)->setValue($id); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <?php fpcm\components\components::getMassEditFields($masseditFields); ?>
</div>