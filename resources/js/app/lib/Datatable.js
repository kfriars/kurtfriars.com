export default {
    rendererFor(type, params) {
        switch (type) {
            case 'render-link':
                return this.renderLink(params);
            case 'render-mailto':
                return this.renderMailTo(params);
            case 'render-icon':
                return this.renderIcon(params);
            case 'render-counted-row':
                return this.renderCountedRow(params);
            case 'render-array':
                return this.renderArray;
            case 'render-array-links':
                return this.renderArrayLinks(params);
            case 'render-notes':
                return this.renderNotes(params);
            case 'render-checkmark':
                return this.renderCheckmark(params);
            case 'render-list':
                return this.renderList(params);
            case 'render-markup':
                return this.renderMarkup(params);
            case 'render-json':
                return this.renderJson(params);
            case 'render-delete-action':
                return this.renderDeleteAction(params);
            case 'render-edit-action':
                return this.renderEditAction(params);
            case 'render-actions':
                return this.renderActions(params);
            case 'render-date':
                return this.renderDate(params);
            case 'render-tags':
                return this.renderTags(params);
            case 'render-badges':
                return this.renderBadges(params);
        }
    },

    handleSelectDeselectTableItem(e, dt){
        let totalRows = dt.rows().count();
        let selectedRows = dt.rows({selected:true}).count();

        if (totalRows == selectedRows){
            $(e.currentTarget).find('thead tr').addClass('selected');
        } else {
            $(e.currentTarget).find('thead tr').removeClass('selected');
        }
    },

    renderActionsColumn(editURL) {
        return function (data, type, row, meta) {
            return  '<div class="table-action-btns">'+
                        '<a class="js-update-button table-action-btn p-0 ladda-button btn waves-effect waves-light ladda-ajax-processed" data-style="slide-right" data-spinner-color="#5fbeaa" data-id="'+data+'" data-row="'+meta.row+'" data-href="'+editURL(data)+'"><span class="ladda-label"><i class="' +EB.icons.edit+' mr-2"></i></span><span class="ladda-spinner"></span></a>'+
                        '<a class="js-delete-button table-action-btn p-0 ladda-button btn waves-effect waves-light ladda-ajax-processed" data-style="slide-right" data-spinner-color="#5fbeaa" data-id="'+data+'"><span class="ladda-label"><i class="'+EB.icons.delete+ '"></i></span><span class="ladda-spinner"></span></a>'+
                    '</div>';
        }
    },

    renderUpdateAction(editURL) {
        return function (data, type, row, meta) {
            return  '<div class="table-action-btns">'+
                        '<a class="js-update-button table-action-btn p-0 ladda-button btn waves-effect waves-light ladda-ajax-processed" data-style="slide-right" data-spinner-color="#5fbeaa" data-id="'+data+'" data-row="'+meta.row+'" data-href="'+editURL(data)+'"><span class="ladda-label"><i class="' +EB.icons.edit+' mr-2"></i></span><span class="ladda-spinner"></span></a>'
                    '</div>';
        }
    },

    renderArray(array) {
        let markup = '<ul>';
        
        Object.keys(array).forEach(function(key,idx) {
            markup = markup + '<li>' + array[key] + '</li>';
        });

        markup = markup + '</ul>';

        return markup;
    },

    renderArrayLinks(elFunc) {
        
        return function (array) {
            let markup = '<ul>';
            
            Object.keys(array).forEach(function(key,idx) {
                markup = markup + '<li>' + elFunc(array[key]) + '</li>';
            });

            markup = markup + '</ul>';

            return markup;
        }
    },

    renderCountedRow(params) {
        return function (data, type, row, meta) {
            let text = row[params.text];
            let action = encodeAction('modal', ['modal-trigger'], {"url": row[params.url]});

            if (params.url) {
                text = '<span '+action+'>'+text+'</span>';
            }

            return '<span class="t-'+params.color+'">'+row[params.count]+'  – </span>'+text;
        }
    },

    renderRiskMeter(params) {
        return function (data, type, row, meta) {
            let cover = 100-parseInt(row[params.risk]);
            return '<div class="progress-line"><div class="to-finish" style="width: calc('+cover+'%);"></div></div>';
        }
    },

    renderNotes(params) {
        return function (data, type, row, meta) {
            let notes = row[params.notes];
            if (notes && notes.length) {
                return '<div class="full-width text-center"><i class="fal fa-comment-lines" title="'+notes+'"></i></div>';
            }

            return '';
        };
    },

    renderCheckmark (params) {
        return function (data, type, row, meta) {
            if (row[params.col]) {
                return '<div class="text-center"><i class="fal fa-check"></i></div>';
            } else if (params.alsoX) {
                return '<div class="text-center"><i class="fal fa-times"></i></div>';
            } else {
                return '';
            }
        }
    },
    
    renderList(params) {
        return function (data, type, row, meta) {
            let markup = '';
            let array = row[params.col];

            Object.keys(array).forEach(function(key,idx) {
                markup = array[key] + '<br>';
            });

            return markup;
        };
    },

    renderMarkup (params) {
        return function (data, type, row, meta) {
            return row[params.col];
        };
    },

    renderJson (params) {
        return function (data, type, row, meta) {
            let obj = row[params.col];
            let json = JSON.stringify(obj, null, 2);

            return '<div class="codetip toggles"><i class="far fa-code toggle-trigger"></i><span class="codetiptext"><pre class="json">' + json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            }) + '</pre></div>';
        };
    },

    renderEditAction(params) {
        return function (data, type, row, meta) {
            let icon = params.icon ? params.icon : 'fal fa-pencil-alt';
            let action = encodeAction('edit', [ icon ], { "id": row[params.idCol] });
            return '<div class="action-icon"><i '+action+'></i></div>';
        };
    },

    renderDeleteAction (params) {
        return function (data, type, row, meta) {
            let icon = params.icon ? params.icon : 'far fa-times';
            let action = encodeAction('delete', [ icon, , 'red' ], { "id": row[params.idCol] });
            return '<div class="action-icon"><i '+action+'></i></div>';
        };
    },

    renderActions(params) {
        return function (data, type, row, meta) {
            let editIcon = params.editIcon ? params.editIcon : 'fal fa-pencil-alt';
            let deleteIcon = params.deleteIcon ? params.deleteIcon : 'far fa-times';
            let editAction = encodeAction('edit', [ editIcon ], { "id": row[params.idCol] });
            let deleteAction = encodeAction('delete', [ deleteIcon, 'red' ], { "id": row[params.idCol] });
            return '<div class="action-icon"><i '+editAction+'></i><i '+deleteAction+'></i></div>';
        };
    },

    renderLink(params) {
        return function (data, type, row, meta) {
            return '<a class="colored underline" href="' + row[params.url] + '"'+(params.newTab ? ' target="_blank"' : '')+'>' + data + '</a>';
        };
    },

    renderMailTo(params) {
        return function (data, type, row, meta) {
            return '<a class="colored underline" href="mailto:'+row[params.emailCol] + '"'+(params.newTab ? ' target="_blank"' : '')+'>' + data + '</a>';
        };
    },

    renderIcon(params) {
        return function (data, type, row, meta) {
            let icon = params.icon ? params.icon : 'fal fa-pencil-alt';
            if (params.url) {
                return '<div class="w-full h-full flex justify-left items-center"><a class="colored underline" href="' + row[params.url] + '"'+(params.newTab ? ' target="_blank"' : '')+'><i class="' + icon + '"></i></a></div>';
            }
            return '<div class="w-full h-full flex justify-left items-center"><i class="' + icon + '"></i></div>';
        };
    },

    renderDate(params) {
        return function (data, type, row, meta) {
            let date = row[params.dateCol];

            if (! date.length) {
                if (row[params.urlCol]) {
                    return '<div style="display: table; height: 100%; width: 100%;">'
                          +     '<div style="display: table-cell; vertical-align: middle; text-align: center; height: 100%; width: 100%;">'
                          +			'<a href="'+row[params.urlCol]+'" target="_blank">'
                          +				'<i class="fa fa-calendar-plus"></i>'
                          +			'</a>'
                          +		'</div>'
                          +	'</div>';
                }

                return '';
            }

            return date;
        };
    },

    renderTags(params) {
        return function (data, type, row, meta) {
            let tags = row[params.tagsCol];

            if (data.length === 0) {
                return '';
            }

            let markup = '<div class="tags">';
            
            tags.forEach((tag) => {
                let color = params['color'];
                markup = markup + '<span class="tag '+color+'">'+tag+'</span>';
            });

            markup = markup + '</div>';
            
            return markup;
        };
    },

    renderBadges(params) {
        return function (data, type, row, meta) {
            let badges = row[params.badgeCol];
            let markup = '<div class="w-full h-full flex-wrap justify-left items-center">';

            badges.forEach((badge) => {
                markup = markup + '<span class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mb-3 mr-2 bg-'+badge.color+'-200">'+badge.label+'</span>';
            });

            markup = markup + '</div>';
            
            return markup;
        };
    },
}

function encodeAction(action, classes = [], data = null) {
    let json = encodeURIComponent(JSON.stringify(data));

    return 'class="table-action '+classes.join(' ')+'"  data-action="'+action+'" data-params="'+json+'"';
}