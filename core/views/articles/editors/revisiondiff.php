<table class="fpcm-ui-table">
    <tr>
        <?php $tmpArticle = $article; ?>
        <?php $article    = $revisionArticle; ?>
        <td class="fpcm-half-width">
            <div class="row fpcm-ui-editor-metabox fpcm-ui-padding-md-tb">
                <div class="col-sm-12 fpcm-ui-font-small">
                    <?php include $theView->getIncludePath('articles/times.php'); ?>
                </div>
                <div class="col-sm-12">
                    <?php include $theView->getIncludePath('articles/metainfo.php'); ?>
                </div>
            </div>
        </td>
        <?php
            $article    = $tmpArticle;
            $tmpArticle = null;
        ?>
        <td class="fpcm-half-width">
            <div class="row fpcm-ui-editor-metabox fpcm-ui-padding-md-tb">
                <div class="col-sm-12 fpcm-ui-font-small">
                    <?php include $theView->getIncludePath('articles/times.php'); ?>
                </div>
                <div class="col-sm-12">
                    <?php include $theView->getIncludePath('articles/metainfo.php'); ?>
                </div>
            </div>
        </td>       
    </tr>    
    <tr>
        <td>
            <h3><?php print $theView->escape($revisionArticle->getTitle()); ?></h3>
        </td>
        <td>
            <h3><?php print $theView->escape($article->getTitle()); ?></h3>
        </td>
    </tr>
    <tr>
        <td>
            <div class="fpcm-ui-controlgroup fpcm-ui-editor-categories fpcm-ui-editor-categories-revisiondiff">
                <?php foreach ($categories as $value => $key) : ?>
                <?php $theView->checkbox('article[categories][revision]', 'rcat'.$value)->setValue($value)->setText($key->getName())->setSelected(in_array($value, $revisionArticle->getCategories())); ?>
                <?php endforeach; ?>
            </div>
        </td>
        <td>
            <div class="fpcm-ui-controlgroup fpcm-ui-editor-categories fpcm-ui-editor-categories-revisiondiff">
                <?php foreach ($categories as $value => $key) : ?>
                <?php $theView->checkbox('article[categories][current]', 'ccat'.$value)->setValue($value)->setText($key->getName())->setSelected(in_array($value, $article->getCategories())); ?>
                <?php endforeach; ?>
            </div> 
        </td>
    </tr>
    <tr>
        <td class="fpcm-ui-editor-contentdiff-right" colspan="2">
            <?php print html_entity_decode($textDiff); ?>
        </td>
    </tr>
</table>