/**
 *
 *
 * This is plugin was originally BeZoom 0.2 jQuery Plugin:
 * Original author: Benjamin Mock
 * http://benjaminmock.de/bezoom-jquery-plugin/
 * 
 * Conversation to JS Prototype was done by E-Abi
 * (Matis Halmann, Aktsiamaailm LLC)
 * 
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 * 
 * Requires http://prototypejs.org library.
 * 
 *
 * 
 *   */

Eabi_Bezoom = Class.create(Abstract, {
    initialize: function(selection, options) {
        this.selection = selection;
        this.options = Object.extend({
            marginLeft: 10,
            marginTop: 0,
            identifier: 'bezoom',
            height: 200,
            width: 200,
            titleSource: 'title',
            imgSource: 'href',
            bgColor: '#5398EE',
            color: '#ffffff',
            size: '0.8em',
            hideTitle: false,
            imgBorder: '#000000',
            imgBgColor: '#ffffff',
            forceTop: false,
            eventType: 'click'
        }, options || {});
        var settings = this.options;
        
        
        this.selection.each(function(i, index) {
            var title = i.readAttribute(settings.titleSource),
            imgBig = i.readAttribute(settings.imgSource),
            titleAttribute = i.readAttribute('title'),
            img = i.select('img').first();
            

            
            //TODO: convert to mouseenter
            i.observe(settings.eventType, function(e) {
                if ($(settings.identifier)) {
                    $(settings.identifier).remove();
                }
                title = i.readAttribute(settings.titleSource);
                imgBig = i.readAttribute(settings.imgSource);
                titleAttribute = i.readAttribute('title');
                
                i.writeAttribute('title', '');
                
                var imgSmallDimensions = i.select('img').first().getDimensions();
                
                var pos = i.cumulativeOffset();
                
                if (settings.forceTop !== false) {
                    pos.top = settings.forceTop;
                }
                
                var y = Math.ceil(pos.top - 0) + settings.marginTop; // - imgSmallDimensions.height;
                if (y < 0) {
                    y -= settings.marginTop;
                }
                if (y < 0) {
                    y -= imgSmallDimensions.height;
                }
                var x = Math.ceil(pos.left - 0) + imgSmallDimensions.width + settings.marginLeft;
                var titleDiv = '<div style="text-align: center; background-color:'+settings.bgColor+';color:'+settings.color+';font-size:'+settings.size+';">'+title+'</div>';
                
                if (settings.hideTitle) {
                    titleDiv = '';
                }
                
                
                $$('body').first().insert('<div id="'+settings.identifier+'" style="border:1px solid ' + settings.imgBorder + '; background: ' + settings.imgBgColor + '; position:absolute; top:'+y+'px;left:'+x+'px;width:'+settings.width+'px;">' + titleDiv + '<div style="width:'+settings.width+'px;height:'+settings.height+'px;overflow:hidden;position:relative; text-align: center;"><img id="'+settings.identifier+'_img" src="'+imgBig+'" style="position:relative;"></div></div>');
                return e.stop();
                
            });

            //TODO: convert to mouseenter
            i.observe('mouseout', function(e) {
                if ($(settings.identifier)) {
                    $(settings.identifier).remove();
                }
                i.writeAttribute('title', titleAttribute);
            });
            
            i.observe('mousemove', function(e) {
                if (!$(settings.identifier)) {
                    return e;
                }
                var imgSmallDimensions = i.select('img').first().getDimensions();
                var imgBigDimensions = $(settings.identifier + '_img').getDimensions();
                
                var rels = { 
                    height: (imgSmallDimensions.height / imgBigDimensions.height),
                    width: (imgSmallDimensions.width / imgBigDimensions.width)
                };
                var offset = img.positionedOffset();
                
                var mouseX = e.pageX - offset.left;
                var mouseY = e.pageY - offset.top;
                var imgBigX = Math.ceil((mouseX / rels.width) - (settings.width / 2)) * (-1);
                imgBigX = Math.max((-1 * imgBigDimensions.width) + settings.width, imgBigX);
                imgBigX = Math.min(0, imgBigX);
                
                var imgBigY = Math.ceil((mouseY / rels.height) - (settings.height * 0.5)) * (-1);
                imgBigY = Math.max((-1 * imgBigDimensions.height) + settings.height, imgBigY);
                imgBigY = Math.min(0, imgBigY);
                
                $(settings.identifier + '_img').setStyle({left: imgBigX + 'px', top: imgBigY + 'px'});
                
                    
                
            });
            
            
            
        });
        
    }
});