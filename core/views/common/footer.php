            </div>

            <div class="fpcm-ui-clear"></div>

            <div class="fpcm-footer fpcm-ui-font-small fpcm-ui-center fpcm-ui-block fpcm-footer-bottom fpcm-ui-hidden">
                <div class="fpcm-footer-text">
                    <b>Version</b> <?php print $theView->version; ?><br>
                    &copy; 2011-<?php print date('Y'); ?> <a href="https://nobody-knows.org/download/fanpress-cm/" target="_blank">nobody-knows.org</a>                    
                </div>
            </div>

        <?php if ($theView->formActionTarget) : ?></form><?php endif; ?>

    </body>
</html>
