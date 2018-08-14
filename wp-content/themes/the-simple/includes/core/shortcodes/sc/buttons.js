scnShortcodeMeta={

	attributes:[

		{

			label:"Button Title",

			id:"content",

			isRequired:true

		},

		{

			label:"Button type",

			id:"type",

			help:"Select the type of the button you will use.(The style values can be changed in Theme Option)",

            controlType:"select-control", 

			selectValues:['default', 'business', 'no_padding', 'rounded', 'big', 'with_icon', 'gradient']

        },

        {

            label:"Button align",

            id:"align",

            help:"Set the button text align",

            controlType:"select-control", 

            selectValues:['left', 'right']

        },


        {

			label:"Button target (link window mode)",

			id:"target",

			help:"Do you want target attributes?(only for anchor)",

            controlType:"select-control", 

			selectValues:['_self', '_blank', '_parent', '_top']

        },

        {

			label:"Link (for anchor)",

			id:"link",

			help:"Enter the link if you want for anchor",

            

        },


      

        {

			label:"Background Color",

			id:"color",

			help:"Select the color for your button"

			

        },

        {

            label:"Background Color Hover",

            id:"bg_color_hover",

            help:"Select the bg color for your button on hover"

        },

         {

			label:"Border Color",

			id:"bordercolor",

			help:"Select the color for your border button"

			

        },

        {

            label:"Border Color Hover",

            id:"bordercolor_hover",

            help:"Select the color for your border button hover"

            

        },
  

        {

			label:"Select icon",

			id:"icon",

			help:"",

            controlType:"select-control", 

			selectValues:[

                'none',
"linea-arrows-anticlockwise", 

            "linea-arrows-anticlockwise-dashed", 

            "linea-arrows-button-down", 

            "linea-arrows-button-off", 

            "linea-arrows-button-on", 

            "linea-arrows-button-up", 

            "linea-arrows-check", 

            "linea-arrows-circle-check", 

            "linea-arrows-circle-down", 

            "linea-arrows-circle-downleft", 

            "linea-arrows-circle-downright", 

            "linea-arrows-circle-left", 

            "linea-arrows-circle-minus", 

            "linea-arrows-circle-plus", 

            "linea-arrows-circle-remove", 

            "linea-arrows-circle-right", 

            "linea-arrows-circle-up", 

            "linea-arrows-circle-upleft", 

            "linea-arrows-circle-upright", 

            "linea-arrows-clockwise", 

            "linea-arrows-clockwise-dashed", 

            "linea-arrows-compress", 

            "linea-arrows-deny", 

            "linea-arrows-diagonal", 

            "linea-arrows-diagonal2", 

            "linea-arrows-down", 

            "linea-arrows-down-double", 

            "linea-arrows-downleft", 

            "linea-arrows-downright", 

            "linea-arrows-drag-down", 

            "linea-arrows-drag-down-dashed", 

            "linea-arrows-drag-horiz", 

            "linea-arrows-drag-left", 

            "linea-arrows-drag-left-dashed", 

            "linea-arrows-drag-right", 

            "linea-arrows-drag-right-dashed", 

            "linea-arrows-drag-up", 

            "linea-arrows-drag-up-dashed", 

            "linea-arrows-drag-vert", 

            "linea-arrows-exclamation", 

            "linea-arrows-expand", 

            "linea-arrows-expand-diagonal1", 

            "linea-arrows-expand-horizontal1", 

            "linea-arrows-expand-vertical1", 

            "linea-arrows-fit-horizontal", 

            "linea-arrows-fit-vertical", 

            "linea-arrows-glide", 

            "linea-arrows-glide-horizontal", 

            "linea-arrows-glide-vertical", 

            "linea-arrows-hamburger1", 

            "linea-arrows-hamburger-2", 

            "linea-arrows-horizontal", 

            "linea-arrows-info", 

            "linea-arrows-keyboard-alt", 

            "linea-arrows-keyboard-cmd", 

            "linea-arrows-keyboard-delete", 

            "linea-arrows-keyboard-down", 

            "linea-arrows-keyboard-left", 

            "linea-arrows-keyboard-return", 

            "linea-arrows-keyboard-right", 

            "linea-arrows-keyboard-shift", 

            "linea-arrows-keyboard-tab", 

            "linea-arrows-keyboard-up", 

            "linea-arrows-left", 

            "linea-arrows-left-double-32", 

            "linea-arrows-minus", 

            "linea-arrows-move", 

            "linea-arrows-move2", 

            "linea-arrows-move-bottom", 

            "linea-arrows-move-left", 

            "linea-arrows-move-right", 

            "linea-arrows-move-top", 

            "linea-arrows-plus", 

            "linea-arrows-question", 

            "linea-arrows-remove", 

            "linea-arrows-right", 

            "linea-arrows-right-double", 

            "linea-arrows-rotate", 

            "linea-arrows-rotate-anti", 

            "linea-arrows-rotate-anti-dashed", 

            "linea-arrows-rotate-dashed", 

            "linea-arrows-shrink", 

            "linea-arrows-shrink-diagonal1", 

            "linea-arrows-shrink-diagonal2", 

            "linea-arrows-shrink-horizonal2", 

            "linea-arrows-shrink-horizontal1", 

            "linea-arrows-shrink-vertical1", 

            "linea-arrows-shrink-vertical2", 

            "linea-arrows-sign-down", 

            "linea-arrows-sign-left", 

            "linea-arrows-sign-right", 

            "linea-arrows-sign-up", 

            "linea-arrows-slide-down1", 

            "linea-arrows-slide-down2", 

            "linea-arrows-slide-left1", 

            "linea-arrows-slide-left2", 

            "linea-arrows-slide-right1", 

            "linea-arrows-slide-right2", 

            "linea-arrows-slide-up1", 

            "linea-arrows-slide-up2", 

            "linea-arrows-slim-down", 

            "linea-arrows-slim-down-dashed", 

            "linea-arrows-slim-left", 

            "linea-arrows-slim-left-dashed", 

            "linea-arrows-slim-right", 

            "linea-arrows-slim-right-dashed", 

            "linea-arrows-slim-up", 

            "linea-arrows-slim-up-dashed", 

            "linea-arrows-square-check", 

            "linea-arrows-square-down", 

            "linea-arrows-square-downleft", 

            "linea-arrows-square-downright", 

            "linea-arrows-square-left", 

            "linea-arrows-square-minus", 

            "linea-arrows-square-plus", 

            "linea-arrows-square-remove", 

            "linea-arrows-square-right", 

            "linea-arrows-square-up", 

            "linea-arrows-square-upleft", 

            "linea-arrows-square-upright", 

            "linea-arrows-squares", 

            "linea-arrows-stretch-diagonal1", 

            "linea-arrows-stretch-diagonal2", 

            "linea-arrows-stretch-diagonal3", 

            "linea-arrows-stretch-diagonal4", 

            "linea-arrows-stretch-horizontal1", 

            "linea-arrows-stretch-horizontal2", 

            "linea-arrows-stretch-vertical1", 

            "linea-arrows-stretch-vertical2", 

            "linea-arrows-switch-horizontal", 

            "linea-arrows-switch-vertical", 

            "linea-arrows-up", 

            "linea-arrows-up-double-33", 

            "linea-arrows-upleft", 

            "linea-arrows-upright", 

            "linea-arrows-vertical"
 
            

            ]

        },

        {

			label:"Icon Color",

			id:"icon_color",

			help:"",

          
        },

        {

            label:"Icon Color on Hover",

            id:"icon_color_hover",

            help:"",

          
        },


        {

        	label:"Font Color",

			id:"font_color"

		

        },

        {

            label:"Font Color Hover",

            id:"font_color_hover"

        

        },



		],

		

		shortcode:"shortcode_button"

};