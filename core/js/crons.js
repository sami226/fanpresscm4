/**
 * FanPress CM Crons Namespace
 * @article Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2015-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @since FPCM 3.5
 */
if (fpcm === undefined) {
    var fpcm = {};
}

fpcm.crons = {

    init: function () {

        fpcm.dataview.render('cronlist', {
            onRenderAfter: function () {

                jQuery('.fpcm-cronjoblist-exec').click(function () {
                    var data = jQuery(this).data();
                    fpcm.crons.execCronjobDemand(data.cjid, data.cjdescr);
                    return false;
                });
                
                fpcm.ui.selectmenu(".fpcm-cronjoblist-intervals", {
                    change: function(event, ui) {
                        var cronjob  = jQuery(this).attr('id').split('_');
                        var interval = jQuery(this).val();
                        fpcm.crons.setCronjobInterval(cronjob[1], interval);
                        return false;
                    }
                });

            }
        });

    },

    execCronjobDemand : function(cronjobId, descr) {
        fpcm.ui.showLoader(true, fpcm.ui.translate('CRONJOB_ECEDUTING').replace('{{cjname}}', descr) );
        fpcm.ajax.get('cronasync', {
            data    : {
                cjId: cronjobId
            },
            execDone: 'fpcm.ui.showLoader(false);'
        });
    },
    
    setCronjobInterval : function(cronjobId, cronjobInterval) {
        fpcm.ui.showLoader(true);
        fpcm.ajax.get('croninterval', {
            data    : {
                cjId:cronjobId,
                interval:cronjobInterval
            },
            execDone: 'fpcm.ui.showLoader(false);'
        });
    }

};