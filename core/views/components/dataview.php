<?php /* @var $theView fpcm\view\viewVars */ ?>
<?php if (!isset($headline) || !isset($dataViewId)) : ?>
<p><?php $theView->write(__FILE__.' required to assign variables "$headline" and "$dataViewId"!'); ?></p>
<?php else: ?>
    <div class="fpcm-content-wrapper">
        <div class="fpcm-ui-tabs-general">
            <ul>
                <li><a href="#tabs-<?php print $dataViewId; ?>-list"><?php $theView->write($headline); ?></a></li>                
            </ul>

            <div id="tabs-<?php print $dataViewId; ?>-list">

                <?php if (!empty($topDescription)) : ?>
                <div class="row no-gutters mt-2 mb-3">
                    <div class="col-12">
                        <fieldset class="fpcm-ui-margin-none-left fpcm-ui-margin-none-right fpcm-ui-margin-md-top">
                            <legend><?php $theView->write('GLOBAL_INFO'); ?></legend>
                            <?php $theView->write($topDescription); ?>
                        </fieldset>
                    </div>
                </div>
                <?php endif; ?>

                <div id="fpcm-dataview-<?php print $dataViewId; ?>-spinner" class="row no-gutters align-self-center fpcm-ui-inline-loader fpcm-ui-background-white-50p">
                    <div class="col-12 fpcm-ui-center align-self-center">
                        <?php $theView->icon('spinner fa-inverse')->setSpinner('pulse')->setStack('circle')->setSize('2x'); ?>
                    </div>
                </div>  

                <div id="fpcm-dataview-<?php print $dataViewId; ?>"></div>

            </div>
        </div>
    </div>
<?php endif; ?>