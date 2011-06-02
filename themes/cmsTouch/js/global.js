/*
* Global Configuration to get CMSMS to work with jQueryMobile in CMSTouch Module or Not
* See: http://jquerymobile.com/
* @author: Nuno Costa <nuno@criacaoweb.net>
* IMPORTANT: You may want adjust according to your site. Plase see http://jquerymobile.com  for more info.
* 
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* 
*/

    /*
     * Trigger the Global Configuration
     * See: http://jquerymobile.com/test/docs/api/globalconfig.html
     * Event: mobileinit
     */
    $(document).bind("mobileinit", function(){  
        
        // If you have conflits and ajaxy problems, the best bet is disable Ajax
        // $.mobile.ajaxEnabled = false;


    /*
     * Setup "Before" the cmsms menu ul, without modify the cmsms menu template
     * See: http://jquerymobile.com/test/docs/api/events.html
     * Event: pagebeforecreate
     */
    
    $('div').live('pagebeforecreate',function(){
        
        $('.menu ul')
        .attr('data-'+ $.mobile.ns+'role',"listview")
        .attr('data-inset','true');
				
				$('.search input.search-button').remove();
    });
   	

   	/*
   	 * Disable some href types from Ajax navigation
   	 * See: http://jquerymobile.com/test/docs/pages/docs-pages.html
   	 * Event: pagecreate
   	 */
   	
   	$("div").live('pagecreate',function(){
   	    
   	    var content = "#cmscontent";
   	    //@TODO target="_blank"

   	    $(content+" a[href$=pdf]").attr('rel','external');
        $(content+" a[href$=doc]").attr('rel','external');
        $(content+" a[href$=docx]").attr('rel','external');
        $(content+" a[href$=txt]").attr('rel','external');
        $(content+" a[href$=ppt]").attr('rel','external');
        $(content+" a[href$=xls]").attr('rel','external');
        $(content+" a[href$=cvs]").attr('rel','external');         
        $(content+" a").find('img').parent().attr('rel','external');
        $(content+" a:external").attr('data-ajax','false');
				//$('.search input.search-button').remove();
    
    });


});// End mobileinit

    /*
     * Check whether links are external
     * See: http://james.padolsey.com/javascript/extending-jquerys-selector-capabilities/
     * Author: James Padolsey's :external extension for jQuery (thank you!)
     * NOTE: Only works with elements that have href
     */

    $.extend($.expr[':'],{
        external: function(a,i,m) {
            if(!a.href) {return false;}
            return a.hostname && a.hostname !== window.location.hostname;
        }
    });
