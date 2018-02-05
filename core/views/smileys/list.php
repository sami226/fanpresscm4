<div class="fpcm-content-wrapper">
    <h1>
        <span class="fa fa-smile-o"></span> <?php $theView->lang->write('HL_OPTIONS_SMILEYS'); ?>
    </h1>
    <form method="post" action="<?php print $theView->self; ?>?module=smileys/list">
        <div class="fpcm-tabs-general">
            <ul>
                <li><a href="#tabs-smiley-list"><?php $theView->lang->write('HL_OPTIONS_SMILEYS'); ?></a></li>                
            </ul>

            <div id="tabs-smiley-list">
                <table class="fpcm-ui-table fpcm-ui-smileys">
                    <tr>
                        <th class="fpcm-ui-smiley-listimg"></th>
                        <th><?php $theView->lang->write('FILE_LIST_FILENAME'); ?></th>
                        <th><?php $theView->lang->write('FILE_LIST_SMILEYCODE'); ?></th>
                        <th class="fpcm-th-select-row"><?php fpcm\view\helper::checkbox('fpcm-select-all', '', '', '', 'fpcm-select-all', false); ?></th>
                    </tr>
                    <?php \fpcm\view\helper::notFoundContainer($list, 4); ?>
                    <tr class="fpcm-td-spacer"><td></td></tr>
                    <?php foreach ($list as $smiley) : ?>
                    <tr>
                        <td class="fpcm-ui-smiley-listimg"><img src="<?php print $smiley->getSmileyUrl(); ?>" alt="<?php print $smiley->getFilename(); ?>" <?php print $smiley->getWhstring(); ?>></td>
                        <td><?php print \fpcm\view\helper::escapeVal($smiley->getFilename()); ?></td>
                        <td><?php print \fpcm\view\helper::escapeVal($smiley->getSmileyCode()); ?></td>
                        <td class="fpcm-td-select-row"><?php fpcm\view\helper::checkbox('smileyids[]', 'fpcm-list-selectbox', base64_encode(serialize(array($smiley->getFilename(), $smiley->getSmileyCode()))), '', '', false) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        
        <div class="<?php \fpcm\view\helper::buttonsContainerClass(); ?> fpcm-ui-list-buttons">
            <div class="fpcm-ui-margin-center">
                <?php fpcm\view\helper::linkButton($theView->basePath.'smileys/add', 'FILE_LIST_SMILEYADD', '', 'fpcm-loader fpcm-new-btn'); ?>
                <?php fpcm\view\helper::deleteButton('deleteSmiley'); ?>
            </div>
        </div> 

        <?php (new fpcm\view\helper\pageTokenField('pgtkn')); ?>
        
    </form> 
</div>