tinymce.PluginManager.add('minimeShortcodes', function(ed, url) {

    // Add a button that opens a window
    ed.addButton('minime_button', {
        type: 'splitbutton',
        text: '',
        icon: 'emoticons',
        tooltip: 'miniME Shortcodes',        
        menu:   [

                    {
                                    text: 'Box Text',
                                    onclick: function() {
                                        ed.insertContent('[box_text]\
                                        [title_two title=\"your title\"]\
                                        Your content Here\
                                        [/box_text]');
                                    }
                    },


                    {
                                    text: 'Box Image',
                                    onclick: function() {
                                        ed.insertContent('[box_img]\
                                        [img_src url=\"imgurl\"]\
                                        [/box_img]');
                                    }
                    },
					
					
					                    {
                                    text: 'Carousel Slider',
                                    onclick: function() {
                                        ed.insertContent('[carousel_slider]\
                                        [carousel_item title=\"your title\" name=\"name here\" context=\"your Context Here\"]\
                                        [carousel_item title=\"your title\" name=\"name here\" context=\"your Context Here\"]\
                                        [carousel_item title=\"your title\" name=\"name here\" context=\"your Context Here\"]\
                                        [/carousel_slider]');
                                    }
                    },
					
                    
                                        {
                                    text: 'Skill Box',
                                    onclick: function() {
                                        ed.insertContent('[skill_area title=\"My Skills\"]\
                                        [skill_item percent=\"87\" context=\"Develope\" ]\
                                        [skill_item percent=\"95\" context=\"Design\" ]\
                                        [skill_item percent=\"98\" context=\"Develope\" ]\
                                        [skill_item percent=\"65\" context=\"Develope\" ]\
                                        [/skill_area]');
                                    }
                    },



                    {
                                    text: 'Experience List',
                                    onclick: function() {
                                        ed.insertContent('[experience_second]\
                                        [exp_list title=\"Your Title\" date=\"2013-2014\"]\
                                        Your context Here\
                                        [/exp_list]\
                                        [exp_list title=\"Your Title\" date=\"2013-2014\"]\
                                        Your context Here\
                                        [/exp_list]\
                                        [exp_list title=\"Your Title\" date=\"2013-2014\"]\
                                        Your context Here\
                                        [/exp_list]\
                                        [exp_list title=\"Your Title\" date=\"2013-2014\"]\
                                        Your context Here\
                                        [/exp_list]\
                                        [/experience_second]');
                                    }
                    },


                    {
                                    text: 'Blog Posts',
                                    onclick: function() {
                                        ed.insertContent('[blog posts=\"4\" categories=\"all\" excerpt_size=\"14\"]');
                                    }
                    },

                    {
                                    text: 'Contact Area',
                                    onclick: function() {
                                        ed.insertContent('[contact_info icon=\"phone\"]\
                                        +41 345 376 284\
                                        [/contact_info]\
                                        [contact_info icon=\"map-marker\"]\
                                        245 Road Broke Blvd, SteK\
                                        [/contact_info]\
                                        [contact_info icon=\"envelope-o\"]\
                                        info@minime.com\
                                        [/contact_info]<br>\
                                        Your Contact 7 Shortcode Here');
                                    }
                    },
                                


                    {
                                    text: 'Map Area',
                                    onclick: function() {
                                        ed.insertContent('[map_area]');
                                    }
                    }


                ],

    });

});