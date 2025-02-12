/**
 * FanPress CM Comments Namespace
 * @article Stefan Seehafer <sea75300@yahoo.de>
 * @copyright (c) 2015-2018, Stefan Seehafer
 * @license http://www.gnu.org/licenses/gpl.txt GPLv3
 * @since FPCM 3.5
 */
if (fpcm === undefined) {
    var fpcm = {};
}

fpcm.comments = {

    init: function () {

        if (fpcm.ui.langvarExists('ARTICLES_SEARCH')) {
            fpcm.comments.initCommentSearch();
        }
    
        fpcm.ui.checkboxradio('.fpcm-ui-comments-status');
        fpcm.comments.assignActions();

        if (parent.fpcm.editor && parent.fpcm.editor.editorTabs && fpcm.vars.jsvars.reloadList) {
            parent.fpcm.editor.editorTabs.tabs('load', 2);
        }
    },
    
    initAfter: function() {
        
        if (fpcm.dataview && fpcm.dataview.exists('commenttrash')) {
            fpcm.dataview.render('commenttrash', {
                onRenderAfter: function() {
                    fpcm.ui.assignCheckboxes();
                    fpcm.ui.assignControlgroups();
                }
            });
            
            return true;
        }
        
        if (fpcm.dataview && fpcm.dataview.exists('commentlist')) {
            fpcm.dataview.render('commentlist', {
                onRenderAfter: function() {
                    fpcm.ui.assignCheckboxes();
                    fpcm.ui.assignControlgroups();
                }
            });
        }
        
    },

    assignActions: function() {
            
        if (fpcm.vars.jsvars.activeTab) {
            fpcm.vars.jsvars.massEdit = {
                relocateParams: '&rg=' + fpcm.vars.jsvars.activeTab
            }
        }

        jQuery('#massEdit').unbind('click');
        jQuery('#massEdit').click(function () {
            fpcm.system.initMassEditDialog('comments/massedit', 'comments-massedit', fpcm.comments);
            return false;
        });

        return true;
    },

    initWidgets: function(dialogId) {

        fpcm.ui.autocomplete('.fpcm-ui-input-articleid', {
            source: fpcm.vars.ajaxActionPath + 'autocomplete&src=articles',
            appendTo: dialogId,
            minLength: 3
        });

        return true;
    },
    
    initCommentSearch: function() {

        jQuery('#opensearch').unbind('click');
        jQuery('#opensearch').click(function () {

            fpcm.ui.selectmenu('.fpcm-ui-input-select-commentsearch', {
                width: '100%',
                appendTo: '#fpcm-dialog-comments-search'
            });
            
            fpcm.ui.autocomplete('#articleId', {
                source: fpcm.vars.ajaxActionPath + 'autocomplete&src=articles',
                appendTo: '#fpcm-dialog-comments-search',
                minLength: 3
            });

            fpcm.ui.dialog({
                id      : 'comments-search',
                dlWidth: fpcm.ui.getDialogSizes(top, 0.75).width,
                resizable: true,
                title    : fpcm.ui.translate('ARTICLES_SEARCH'),
                dlButtons  : [
                    {
                        text: fpcm.ui.translate('ARTICLE_SEARCH_START'),
                        icon: 'ui-icon-check',
                        class: 'fpcm-ui-button-primary',
                        click: function() {                            
                            var sfields = jQuery('.fpcm-comments-search-input');
                            var sParams = {
                                filter: {}
                            };
                            
                            jQuery.each(sfields, function( key, obj ) {
                                var objVal  = jQuery(obj).val();
                                var objName = jQuery(obj).attr('name');                                
                                sParams.filter[objName] = objVal;
                            });

                            fpcm.comments.startCommentSearch(sParams);
                            jQuery(this).dialog('close');
                        }
                    },                    
                    {
                        text: fpcm.ui.translate('GLOBAL_CLOSE'),
                        icon: "ui-icon-closethick",                        
                        click: function() {
                            jQuery(this).dialog('close');
                        }
                    }                            
                ],
                dlOnOpen: function() {
                    jQuery('#text').focus();
                }
            });

            return false;
        });

    },

    startCommentSearch: function (sParams) {

        if (((new Date()).getTime() - fpcm.vars.jsvars.commentsLastSearch) < 10000) {
            fpcm.ui.addMessage({
                type: 'error',
                txt : fpcm.ui.translate('SEARCH_WAITMSG')
            });
            return false;
        }

        fpcm.ui.showLoader(true);
        
        fpcm.ajax.post('comments/search', {
            data: sParams,
            execDone: function () {
                fpcm.ui.mainToolbar.find('.fpcm-ui-pager-element').addClass('fpcm-ui-hidden');
                fpcm.ui.controlgroup(fpcm.ui.mainToolbar, 'refresh');

                var result = fpcm.ajax.getResult('comments/search', true);
                fpcm.vars.jsvars.dataviews[result.dataViewName] = result.dataViewVars;
                fpcm.dataview.updateAndRender(result.dataViewName, {
                    onRenderAfter: function () {
                        fpcm.ui.assignCheckboxes();
                        fpcm.ui.assignControlgroups();
                    }
                });

                fpcm.ui.showLoader(false);
            }
        });

        fpcm.vars.jsvars.commentsLastSearch = (new Date()).getTime();
    }

};