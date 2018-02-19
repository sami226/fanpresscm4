<table class="fpcm-ui-table fpcm-ui-logs ">
    <tr>
        <th><?php $theView->write('LOGS_LIST_TIME'); ?></th>
        <th><?php $theView->write('LOGS_LIST_TEXT'); ?></th>
    </tr>
    
    <?php \fpcm\view\helper::notFoundContainer($cronjobLogs, 2); ?>
    
    <tr class="fpcm-td-spacer"><td></td></tr>
    <?php foreach ($cronjobLogs as $value) : ?>
    <?php if (!is_object($value)) continue; ?>
    <tr>
        <td><?php print $value->time?></td>
        <td class="fpcm-ui-monospace"><?php print str_replace(['&NewLine;', PHP_EOL], '<br>', $theView->escape($value->text)); ?></td>
    </tr>
    <?php endforeach; ?>
</table>