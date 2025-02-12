/**
 * FanPress CM Options Namespace
 * @article Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2015-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 */
if (fpcm === undefined) {
    var fpcm = {};
}

fpcm.options = {

    init: function () {

        fpcm.ui.tabs('#fpcm-options-tabs', {
            active: fpcm.vars.jsvars.activeTab,
            addTabScroll: true,
            addMainToobarToggle: true,
            saveActiveTab: true
        });

        fpcm.ui.checkboxradio('.fpcm-ui-input-checkbox');

        jQuery('#syschecksubmitstats').click(function () {
            fpcm.ui.showLoader(true);
            fpcm.ajax.get('syscheck', {
                data: {
                    sendstats: 1
                },
                execDone: function () {
                    fpcm.ui.showLoader(false);
                }
            });
        });

        fpcm.system.checkForUpdates();
        
        fpcm.ui.selectmenu('#smtp_enabled', {
            change: function( event, data ) {
                var status = (data.item.value == 1 ? false : true);
                fpcm.ui.isReadonly('input.fpcm-ui-options-smtp-input', status);
                fpcm.ui.selectmenu('#smtp_settingsencr', {
                    disabled: status
                });
                return true;
            }
        });

        fpcm.ui.selectmenu('.fpcm-ui-input-select', {
            removeCornerLeft: true
        })

        jQuery('.fpcm-ui-spinner').spinner( "option", "classes.ui-spinner", "fpcm-ui-border-radius-right" );
    }
};