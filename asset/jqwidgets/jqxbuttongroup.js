/*
jQWidgets v2.9.2 (2013-July-04)
Copyright (c) 2011-2013 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxButtonGroup","",{});a.extend(a.jqx._jqxButtonGroup.prototype,{defineInstance:function(){this.mode="default";this.roundedCorners=true;this.disabled=false;this.enableHover=false;this.orientation="horizontal";this.width=null;this.height=null;this._eventsMap={mousedown:"touchstart",mouseup:"touchend"};this._events=["selected","unselected","buttonclick"];this._buttonId={};this._selected=null;this._pressed=null;this.rtl=false;this._baseId="group_button";this.aria={"aria-disabled":{name:"disabled",type:"boolean"}}},createInstance:function(b){this._isTouchDevice=a.jqx.mobile.isTouchDevice();var c=this;a.jqx.aria(this);this.addHandler(this.host,"selectstart",function(d){if(!c.disabled){d.preventDefault()}})},refresh:function(){if(this.width){this.host.width(this.width)}if(this.height){this.host.height(this.height)}this._refreshButtons()},render:function(){this.refresh()},_getEvent:function(b){if(this._isTouchDevice){var c=this._eventsMap[b]||b;c+="."+this.element.id;return c}b+="."+this.element.id;return b},_refreshButtons:function(){if(this.lastElement){this.lastElement.remove()}this.lastElement=a("<div style='clear: both;'></div>");var c=this.host.children(),d=c.length,e;switch(this.mode){case"radio":this.host.attr("role","radiogroup");break;case"checkbox":case"default":this.host.attr("role","group");break}for(var b=0;b<d;b+=1){e=a(c[b]);this._refreshButton(e,b,d)}this.lastElement.appendTo(this.host)},_refreshButton:function(c,b,d){(function(e){e=this._render(e);this._removeStyles(e);this._addStyles(e,b,d);this._performLayout(e);this._removeButtonListeners(e);this._addButtonListeners(e);this._handleButtonId(e,b);if(this.mode=="radio"){e.attr("role","radio")}else{e.attr("role","button")}e.attr("disabled",this.disabled);if(this.disabled){e.addClass(this.toThemeProperty("jqx-fill-state-disabled"))}else{e.removeClass(this.toThemeProperty("jqx-fill-state-disabled"))}}).apply(this,[c])},destroy:function(b){var d=this.host.children(),e=d.length,f;for(var c=0;c<e;c+=1){f=a(d[c]);this._removeStyles(f);this._removeButtonListeners(f)}if(b!=false){this.host.remove()}},_render:function(b){if(b[0].tagName.toLowerCase()==="button"){return this._renderFromButton(b)}else{return this._renderButton(b)}},_renderButton:function(b){var c;b.wrapInner("<div/>");return b},_removeStyles:function(b){this.host.removeClass("jqx-widget");this.host.removeClass("jqx-rc-all");b.removeClass(this.toThemeProperty("jqx-fill-state-normal"));b.removeClass(this.toThemeProperty("jqx-group-button-normal"));b.removeClass(this.toThemeProperty("jqx-rc-tl"));b.removeClass(this.toThemeProperty("jqx-rc-bl"));b.removeClass(this.toThemeProperty("jqx-rc-tr"));b.removeClass(this.toThemeProperty("jqx-rc-br"));b.css("margin-left",0)},_addStyles:function(c,b,d){this.host.addClass("jqx-widget");this.host.addClass("jqx-rc-all");this.host.addClass("jqx-buttongroup");c.addClass(this.toThemeProperty("jqx-button"));c.addClass(this.toThemeProperty("jqx-group-button-normal"));c.addClass(this.toThemeProperty("jqx-fill-state-normal"));if(this.roundedCorners){if(b===0){this._addRoundedCorners(c,true)}else{if(b===d-1){this._addRoundedCorners(c,false)}}}if(this.orientation=="horizontal"){c.css("margin-left",-parseInt(c.css("border-left-width"),10))}else{c.css("margin-top",-parseInt(c.css("border-left-width"),10))}},_addRoundedCorners:function(b,c){if(this.orientation=="horizontal"){if(c){b.addClass(this.toThemeProperty("jqx-rc-tl"));b.addClass(this.toThemeProperty("jqx-rc-bl"))}else{b.addClass(this.toThemeProperty("jqx-rc-tr"));b.addClass(this.toThemeProperty("jqx-rc-br"))}}else{if(c){b.addClass(this.toThemeProperty("jqx-rc-tl"));b.addClass(this.toThemeProperty("jqx-rc-tr"))}else{b.addClass(this.toThemeProperty("jqx-rc-bl"));b.addClass(this.toThemeProperty("jqx-rc-br"))}}},_centerContent:function(c,b){c.css({"margin-top":(b.height()-c.height())/2,"margin-left":(b.width()-c.width())/2});return c},_renderFromButton:function(b){var c=b.val();if(c==""){c=b.html()}var e;var d=b[0].id;b.wrap("<div/>");e=b.parent();e.attr("style",b.attr("style"));b.remove();a.jqx.utilities.html(e,c);e[0].id=d;return e},_performLayout:function(b){if(this.orientation=="horizontal"){if(this.rtl){b.css("float","right")}else{b.css("float","left")}}else{b.css("float","none")}this._centerContent(a(b.children()),b)},_mouseEnterHandler:function(d){var b=d.data.self,c=a(d.currentTarget);if(b._isDisabled(c)||!b.enableHover){return}c.addClass(b.toThemeProperty("jqx-group-button-hover"));c.addClass(b.toThemeProperty("jqx-fill-state-hover"))},_mouseLeaveHandler:function(d){var b=d.data.self,c=a(d.currentTarget);if(b._isDisabled(c)||!b.enableHover){return}c.removeClass(b.toThemeProperty("jqx-group-button-hover"));c.removeClass(b.toThemeProperty("jqx-fill-state-hover"))},_mouseDownHandler:function(d){var b=d.data.self,c=a(d.currentTarget);if(b._isDisabled(c)){return}b._pressed=c;c.addClass(b.toThemeProperty("jqx-group-button-pressed"));c.addClass(b.toThemeProperty("jqx-fill-state-pressed"))},_mouseUpHandler:function(d){var b=d.data.self,c=a(d.currentTarget);if(b._isDisabled(c)){return}b._handleSelection(c);b._pressed=null;c=b._buttonId[c[0].id];b._raiseEvent(2,{index:c.num,button:c.btn})},_isDisabled:function(b){if(!b||!b[0]){return false}return this._buttonId[b[0].id].disabled},_documentUpHandler:function(d){var b=d.data.self,c=b._pressed;if(c&&!b._buttonId[c[0].id].selected){c.removeClass(b.toThemeProperty("jqx-fill-state-pressed"));b._pressed=null}},_addButtonListeners:function(c){var b=this;this.addHandler(c,this._getEvent("mouseenter"),this._mouseEnterHandler,{self:this});this.addHandler(c,this._getEvent("mouseleave"),this._mouseLeaveHandler,{self:this});this.addHandler(c,this._getEvent("mousedown"),this._mouseDownHandler,{self:this});this.addHandler(c,this._getEvent("mouseup"),this._mouseUpHandler,{self:this});this.addHandler(a(document),this._getEvent("mouseup"),this._documentUpHandler,{self:this})},_removeButtonListeners:function(b){this.removeHandler(b,this._getEvent("mouseenter"),this._mouseEnterHandler);this.removeHandler(b,this._getEvent("mouseleave"),this._mouseLeaveHandler);this.removeHandler(b,this._getEvent("mousedown"),this._mouseDownHandler);this.removeHandler(b,this._getEvent("mouseup"),this._mouseUpHandler);this.removeHandler(a(document),this._getEvent("mouseup"),this._documentUpHandler)},_handleSelection:function(b){if(this.mode==="radio"){this._handleRadio(b)}else{if(this.mode==="checkbox"){this._handleCheckbox(b)}else{this._handleDefault(b)}}},_handleRadio:function(b){var c=this._getSelectedButton();if(c&&c.btn[0].id!==b[0].id){this._unselectButton(c.btn,true)}for(var d in this._buttonId){this._buttonId[d].selected=true;this._unselectButton(this._buttonId[d].btn,false)}this._selectButton(b,true)},_handleCheckbox:function(c){var b=this._buttonId[c[0].id];if(b.selected){this._unselectButton(b.btn,true)}else{this._selectButton(c,true)}},_handleDefault:function(b){this._selectButton(b,false);for(var c in this._buttonId){this._buttonId[c].selected=true;this._unselectButton(this._buttonId[c].btn,false)}},_getSelectedButton:function(){for(var b in this._buttonId){if(this._buttonId[b].selected){return this._buttonId[b]}}return null},_getSelectedButtons:function(){var b=[];for(var c in this._buttonId){if(this._buttonId[c].selected){b.push(this._buttonId[c].num)}}return b},_getButtonByIndex:function(b){var d;for(var c in this._buttonId){if(this._buttonId[c].num===b){return this._buttonId[c]}}return null},_selectButton:function(c,d){var b=this._buttonId[c[0].id];if(b.selected){return}b.btn.addClass(this.toThemeProperty("jqx-group-button-pressed"));b.btn.addClass(this.toThemeProperty("jqx-fill-state-pressed"));b.selected=true;if(d){this._raiseEvent(0,{index:b.num,button:b.btn})}a.jqx.aria(b.btn,"aria-checked",true)},_unselectButton:function(c,d){var b=this._buttonId[c[0].id];if(!b.selected){return}b.btn.removeClass(this.toThemeProperty("jqx-group-button-pressed"));b.btn.removeClass(this.toThemeProperty("jqx-fill-state-pressed"));b.selected=false;if(d){this._raiseEvent(1,{index:b.num,button:b.btn})}a.jqx.aria(b.btn,"aria-checked",false)},setSelection:function(b){if(this.mode==="checkbox"){if(typeof b==="number"){this._setSelection(b)}else{for(var c=0;c<b.length;c+=1){this._setSelection(b[c])}}}else{if(typeof b==="number"&&this.mode==="radio"){this._setSelection(b)}}},_setSelection:function(b){var c=this._getButtonByIndex(b);this._handleSelection(c.btn)},getSelection:function(){if(this.mode==="radio"){return this._getSelectedButton().num}else{if(this.mode==="checkbox"){return this._getSelectedButtons()}}return undefined},disable:function(){this.disabled=true;var c;for(var b in this._buttonId){c=this._buttonId[b];this.disableAt(c.num)}a.jqx.aria(this,"aria-disabled",true)},enable:function(){this.disabled=false;var c;for(var b in this._buttonId){c=this._buttonId[b];this.enableAt(c.num)}a.jqx.aria(this,"aria-disabled",false)},disableAt:function(b){var c=this._getButtonByIndex(b);if(!c.disabled){c.disabled=true;c.btn.addClass(this.toThemeProperty("jqx-fill-state-disabled"))}},enableAt:function(b){var c=this._getButtonByIndex(b);if(c.disabled){c.disabled=false;c.btn.removeClass(this.toThemeProperty("jqx-fill-state-disabled"))}},_handleButtonId:function(b,d){var f=b[0].id,e={btn:b,num:d,selected:false},c;if(!f){f=this._baseId+new Date().getTime()}b[0].id=f;this._buttonId[f]=e;return f},_raiseEvent:function(d,c){var b=a.Event(this._events[d]);b.args=c;return this.host.trigger(b)},_unselectAll:function(){for(var b in this._buttonId){this._unselectButton(this._buttonId[b].btn,false)}},clearSelection:function(){this._unselectAll()},propertyChangedHandler:function(b,c,e,d){if(c=="theme"&&d!=null){a.jqx.utilities.setTheme(e,d,b.host)}if(c==="mode"){if(d!="checkbox"){b._unselectAll()}b.refresh();return}else{if(c==="disabled"){if(d){b.disable()}else{b.enable()}}else{b.refresh()}}}})})(jQuery);