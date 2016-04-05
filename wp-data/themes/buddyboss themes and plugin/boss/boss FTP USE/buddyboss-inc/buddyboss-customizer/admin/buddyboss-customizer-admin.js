jQuery(window).load( function() {
    
    var supported_fonts = {
        latin:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Montserrat', 'Lucida Sans Unicode', 'Cabin', 'Lato', 'Pacifico', 'PT Sans', 'Raleway', 'Source Sans Pro'], 
        latin_ext:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Lato', 'PT Sans', 'Source Sans Pro'], 
        cyrillic_ext:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Arial', 'PT Sans'],
        cyrillic:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Arial', 'PT Sans'],
        greek_ext:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Arial'],
        greek:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Ubuntu', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Arial'],
        vietnamese:['Arimo', 'Arial', 'Courier New', 'Georgia', 'Helvetica', 'Verdana', 'Trebuchet MS', 'Times New Roman', 'Tahoma', 'Palatino Linotype', 'Open Sans', 'Lucida Sans Unicode', 'Arial', 'Source Sans Pro']
    };
    function unique(fonts_array){
        var n = {},r=[];
        for(var i = 0; i < fonts_array.length; i++) 
        {
            if (!n[fonts_array[i]]) 
            {
                n[fonts_array[i]] = true; 
                r.push(fonts_array[i]); 
            }
        }
        return r;
    }
    jQuery('#customize-control-multiple_select_setting select').change(function() {
        jQuery('#select-info').text('');
        var fonts_array = [];
        jQuery(this).find("option:selected").each(function () {
            var selected = jQuery(this).val().replace('-', '_');
            fonts_array = fonts_array.concat(supported_fonts[selected]);  
        });
        fonts_array = unique(fonts_array);
        jQuery('#select-info').text(fonts_array);
    });
    	
	/* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	ALTERNATE UI FOR FONTS 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
	jQuery('#accordion-section-boss_text_buttons_section, #accordion-section-title_tagline').find('.customize-control-select').not('#customize-control-boss_search_instead').each(function(){
		
		$li_control = jQuery(this);
		$li_control.addClass('font-ui-alt-anchor');
		
		//hide the select
		$select = $li_control.find('select');
		$select.hide();
		
		//render alternate UI
		var html = "<ul class='fonts-alt-ui' style='display: none'>";
			$select.find('option').each(function(){
				var fontKey = jQuery(this).attr('value');
				var fontName = jQuery(this).text();
				
				var selectedClass = ' ';
				var selected_value = '';
				if(jQuery(this).is(':selected')){
					selectedClass = " class='current' ";
                    selected_value = jQuery(this).attr('value');
				}
                
                var style = "style='font-family:"+ getFontStackAdmin(fontKey) +" '";
                
                if(selected_value) {
                    jQuery(this).closest('.font-ui-alt-anchor').find('label').append('<span class="selected-font">: <span '+style+'> '+getFontStackAdmin(selected_value)+'</span></span>');
                }
				
				html += "<li " + selectedClass + style + " data-value='"+ fontKey + "'>";
				html += 	"<div class='wrapper'><span class='font-name'>" + fontName + "</span></div>";
				html += "</li>";
			});
		html += "</ul>";
		
		$li_control.append( html );
		
		
	});
	
	//bind events
	jQuery('.font-ui-alt-anchor > label').mousedown(function(){
		jQuery(this).closest('.font-ui-alt-anchor').find('.fonts-alt-ui').slideToggle();
		jQuery(this).closest('.font-ui-alt-anchor').toggleClass('opened');
		//jQuery(this).toggleClass('opened');
	});
	
	jQuery('.fonts-alt-ui > li').css({ 'cursor': 'pointer' }).click(function(){
        var selected_value = jQuery(this).data('value');
        
        jQuery(this).closest('.font-ui-alt-anchor').find('.selected-font').remove();
        var style = "style='font-family:"+ getFontStackAdmin(selected_value) +" '";
        jQuery(this).closest('.font-ui-alt-anchor').find('label').append('<span class="selected-font">: <span '+style+'> '+getFontStackAdmin(selected_value)+'</span></span>');
        
		jQuery(this).closest('.font-ui-alt-anchor').find('select').val( selected_value );
		jQuery(this).closest('.font-ui-alt-anchor').find('select').trigger('change');
		
		jQuery('.fonts-alt-ui > li').removeClass('current');
		jQuery(this).addClass('current');
	});
     
    /* ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	ALTERNATE UI FOR THEMES 
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
	$themes_wrapper = jQuery('#customize-control-boss_scheme_select');
	$themes_wrapper.find(' >label').hide();
	$themes_select_dropdown = $themes_wrapper.find('select');
     
    
	
	//render alternate UI
	var html = "<ul class='themes-alt-ui'>";
		$themes_select_dropdown.find('option').each(function(){
			var themeId = jQuery(this).attr('value');
			var theme = BBOSS_THEME_CUSTOMIZER_ADMIN.themes[themeId];
            
            var palette_html = '';
            var palette = theme['palette'];
            
            palette_html += '<table class="color-palette">';
            palette_html +=   '<tbody>';
            palette_html +=       '<tr>';
            
            for( var palette_color in palette ){
            palette_html +=           '<td style="background-color: '+palette[palette_color]+'">&nbsp;</td>';
            }
            
            palette_html +=       '</tr>';
            palette_html +=   '</tbody>';
            palette_html += '</table>';
				
			var selectedClass = ' ';
			var selectedArchorClass = ' ';
			if(jQuery(this).is(':selected')){
				selectedClass = " class='current' ";
				selectedArchorClass = " class='active' ";
			}
			
			html += "<li " + selectedClass + " data-value='"+ themeId + "'>";
			html += 	"<a href='#' " + selectedArchorClass + ">";
            html +=          "<span class='customize-control-title'>" + theme['name'] + "</span>";
            html +=          palette_html;
            html +=     "</a>";
			html += "</li>";
		});
	html += "</ul>";
	
	$themes_wrapper.append( html );
     
	
	jQuery('.themes-alt-ui li').click(function(e){
		e.preventDefault();
        var selected_scheme = jQuery(this).data('value');
        
        $themes_select_dropdown.find('option').removeAttr('selected');
        $themes_select_dropdown.find('option[value="' + selected_scheme + '"]').attr('selected', 'selected');
        $themes_select_dropdown.val( selected_scheme );
		$themes_select_dropdown.trigger('change');
        
        jQuery('.themes-alt-ui li > a').removeClass('active');
        jQuery(this).find('>a').addClass('active');
        
		bbLoadThemeSettings( selected_scheme );
	});
     
     function bbLoadThemeSettings( themeId ){
        rules = BBOSS_THEME_CUSTOMIZER_ADMIN.themes[themeId]['rules'];
        for( var rule in rules ){
//            console.log( '%o : %o', rule, rules[rule] );
            //volatile stuff here!!
            var $control = jQuery('#customize-control-' + rule ).find( 'input[type="text"], select').first();
            $control.val( rules[rule] );
            $control.trigger('change');
        }
    }
    
    function getFontStackAdmin( fontKey ) {
        // Normalize font key value
        var fontKeyValue = fontKey.toString().toLowerCase();
        return BBOSS_THEME_CUSTOMIZER_ADMIN.fonts[fontKeyValue];
    }
    
     
});