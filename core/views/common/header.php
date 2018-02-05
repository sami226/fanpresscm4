<!DOCTYPE HTML>
<HTML lang="<?php print $theView->lang->getLangCode(); ?>">
    <head>
        <title><?php $theView->lang->write('HEADLINE'); ?></title>
        <meta http-equiv="content-type" content= "text/html; charset=utf-8">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php print $theView->themePath; ?>favicon.png" type="image/png" /> 
        <?php include_once 'includefiles.php'; ?>
    </head>    

    <body class="fpcm-body" id="fpcm-body"> 

        <?php include_once 'vars.php'; ?>
        
        <div id="fpcm-messages" class="fpcm-messages"></div>

        <div class="fpcm-wrapper-left <?php if (in_array($theView->currentModule, array('system/login', 'installer'))) : ?>fpcm-wrapper-fixed<?php endif; ?>" id="fpcm-wrapper-left">
            
            <div id="fpcm-logo" class="fpcm-logo fpcm-ui-center">
                <div><img class="fpcm-logo" src="<?php print $theView->themePath; ?>logo.svg" alt="FanPress CM News System"></div>
                <div><span>FanPress CM</span> <span>News System</span></div>
            </div>

            <?php include_once 'navigation.php'; ?>

            <div class="fpcm-footer fpcm-footer-left">
                <div class="fpcm-footer-text">
                    <b>Version</b> <?php print $theView->version; ?><br>
                    &copy; 2011-<?php print date('Y'); ?> <a href="https://nobody-knows.org/download/fanpress-cm/" target="_blank">nobody-knows.org</a>                    
                </div>
            </div>

        </div>
        
        <?php if (isset($includeManualCheck) && $includeManualCheck) : ?>
        <?php include $theView->getIncludePath('common/updatemancheck.php'); ?>
        <?php endif; ?>
        
        <div class="fpcm-wrapper <?php if (in_array($theView->currentModule, array('system/login', 'installer'))) : ?>fpcm-wrapper-fixed<?php endif; ?>" id="fpcm-wrapper-right">
            <?php include_once 'menutop.php'; ?>