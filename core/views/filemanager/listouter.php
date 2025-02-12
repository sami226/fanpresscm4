<?php /* @var $theView \fpcm\view\viewVars */ ?>
<?php if($mode > 1) : ?><?php include_once $theView->getIncludePath('common/buttons.php'); ?><?php endif; ?>
<div class="<?php if($mode > 1) : ?>fpcm-ui-inner-wrapper<?php else : ?>fpcm-content-wrapper<?php endif; ?>">
    <div class="fpcm-ui-tabs-general <?php if($mode > 1) : ?>fpcm-ui-full-view-min-height<?php endif; ?>" id="fpcm-files-tabs">
        <ul>
            <li data-toolbar-buttons="1" id="tabs-files-list-reload"><a href="#tabs-files-list"><?php $theView->write('FILE_LIST_AVAILABLE'); ?></a></li>                
            <?php if ($permUpload) : ?><li data-toolbar-buttons="2"><a href="#tabs-files-upload"><?php $theView->write('FILE_LIST_UPLOADFORM'); ?></a></li><?php endif; ?>                
        </ul>

        <div id="tabs-files-list">
            <div id="tabs-files-list-content">
                <?php if (!$hasFiles) : ?>
                <p class="fpcm-ui-padding-none fpcm-ui-margin-none"><?php $theView->icon('images', 'far')->setStack('ban fpcm-ui-important-text')->setSize('lg')->setStackTop(true); ?> <?php $theView->write('GLOBAL_NOTFOUND2'); ?></p>
                <?php else : ?>
                <div class="row no-gutters align-self-center fpcm-ui-inline-loader">
                    <div class="col-12 fpcm-ui-center align-self-center">
                        <?php $theView->icon('spinner fa-inverse')->setSpinner('pulse')->setStack('circle')->setSize('2x'); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($permUpload) : ?>
        <?php if ($newUploader) : ?></form><?php endif; ?>
        <div id="tabs-files-upload">
            <?php if ($newUploader) : ?>
                <?php include $theView->getIncludePath('filemanager/forms/jqupload.php'); ?>
            <?php else : ?>
                <?php include $theView->getIncludePath('filemanager/forms/phpupload.php'); ?>
            <?php endif; ?>

        </div>
        <?php endif; ?>
    </div>
</div>

<div class="fpcm-ui-dialog-layer fpcm-ui-hidden fpcm-editor-dialog" id="fpcm-dialog-files-rename">
    <div class="row">
        <div class="col-sm-12 col-md-6 fpcm-ui-padding-md-tb align-self-center"><?php $theView->write('FILE_LIST_FILENAME'); ?>:</div>
        <div class="col-sm-12 col-md-6 fpcm-ui-padding-md-tb"><?php $theView->textInput('newFilenameDialog'); ?></div>
    </div>
</div>

<?php include $theView->getIncludePath('filemanager/searchform.php'); ?>

<div class="fpcm-ui-dialog-layer fpcm-ui-hidden fpcm-editor-dialog" id="fpcm-dialog-files-properties">
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('calendar-alt', 'far')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_UPLOAD_DATE'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all" id="fpcm-dialog-files-properties-filetime"></div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('user')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_UPLOAD_BY'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all" id="fpcm-dialog-files-properties-fileuser"></div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('weight')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_FILESIZE'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all" id="fpcm-dialog-files-properties-filesize"></div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('expand-arrows-alt')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_RESOLUTION'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all" id="fpcm-dialog-files-properties-resulution"></div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('file-alt ')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_FILETYPE'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all" id="fpcm-dialog-files-properties-filemime"></div>
            </div>
        </div>
    </div>
    
    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('hashtag')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_FILEHASH'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all fpcm-ui-ellipsis" id="fpcm-dialog-files-properties-filehash"></div>
            </div>
        </div>
    </div>

    <div class="row no-gutters fpcm-ui-padding-md-tb">
        <div class="col-12 fpcm-ui-padding-none-lr">
            <div class="row">
                <label class="col-12 col-md-4 fpcm-ui-field-label-general">
                    <?php $theView->icon('copyright')->setSize('lg'); ?>
                    <?php $theView->write('FILE_LIST_FILECREDITS'); ?>
                </label>
                <div class="col-sm-12 col-md-8 align-self-center fpcm-ui-padding-none-lr fpcm-ui-border-radius-right fpcm-ui-border-grey-medium fpcm-ui-padding-md-all fpcm-ui-ellipsis pre-box" id="fpcm-dialog-files-properties-credits">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
</div>