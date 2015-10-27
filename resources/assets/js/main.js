$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
	
	var config = {
	//   protocol:     // the protocol you'd prefer to use. [Default: your current protocol]
	  // url:          // the url you'd like to share. [Default: `window.location.href`]
	  title: 'A Little Treat for Halloween from Exhibit Partners',        // title to be shared alongside your link [Default: See below in defaults section]
	  description: "We can't send candy, but we think this video will brighten your day.  We had a lot of fun making it and we hope you enjoy watching.",  // text to be shared alongside your link, [Default: See below in defaults section]   
	  image: 'http://www.ep-productions.com/img/halloween/placeholder.jpg',       // image to be shared [Default: See below in defaults section]
	  ui: {
	    flyout: 'bottom center',       // change the flyout direction of the shares. chose from `top left`, `top center`, `top right`, `bottom left`, `bottom right`, `bottom center`, `middle left`, or `middle right` [Default: `top center`]
	//     button_font:  // include the Lato font set from the Google Fonts API. [Default: `true`]
	    buttonText:'Share this with others...'  // change the text of the button, [Default: `Share`]
	//     icon_font:    // include the minified Entypo font set. [Default: `true`]
	  },
	//   networks: {
	//     googlePlus: {
	//       enabled: // Enable Google+. [Default: true]
	//       url:     // the url you'd like to share to Google+ [Default: config.url]
	//     },
	//     twitter: {
	//       enabled:      // Enable Twitter. [Default: true]
	//       url:          // the url you'd like to share to Twitter [Default: config.url]
	//       description:  // text to be shared alongside your link to Twitter [Default: config.description]
	//     },
	    // facebook: {
	      // enabled:  true,    // Enable Facebook. [Default: true]
	      // load_sdk:true,     // Load the FB SDK. If false, it will default to Facebook's sharer.php implementation. 
	//                     // NOTE: This will disable the ability to dynamically set values and rely directly on applicable Open Graph tags.
	//                     // [Default: true]
	//       url:          // the url you'd like to share to Facebook [Default: config.url]
	//       app_id:       // Facebook app id for tracking shares. if provided, will use the facebook API
	      // title: 'my title',        // title to be shared alongside your link to Facebook [Default: config.title]
	//       caption:      // caption to be shared alongside your link to Facebook [Default: null]
	//       description:  // text to be shared alongside your link to Facebook [Default: config.description]
	//       image:        // image to be shared to Facebook [Default: config.image]
	    // },
	//     pinterest: {
	//       enabled:      // Enable Pinterest. [Default: true]
	//       url:          // the url you'd like to share to Pinterest [Default: config.url]
	//       image:        // image to be shared to Pinterest [Default: config.image]
	//       description:  // text to be shared alongside your link to Pinterest [Default: config.description]
	//     },
	//     reddit: {
	//       enabled:  // Enable Reddit. [Default: true]
	//       url:      // the url you'd like to share to Reddit [Default: config.url]
	//       title:    // title to be shared alongside your link to Reddit [Default: config.title]
	//     },
	//     linkedin: {
	//       enabled:      // Enable LinkedIn. [Default: true]
	//       url:          // the url you'd like to share to LinkedIn [Default: config.url]
	//       title:        // title to be shared alongside your link to LinkedIn [Default: config.title],
	//       description:  // text to be shared alongside your link to LinkedIn [Default: config.description]
	//     },
	//     whatsapp: {
	//       enabled:      // Enable WhatsApp. [Default: true]
	//       description:  // text to be shared alongside your link to WhatsApp [Default: config.description],
	//       url:          // the url you'd like to share to WhatsApp [Default: config.url]
	//     },
	//     email: {
	//       enabled:      // Enable Email. [Default: true]
	//       title:        // the subject of the email [Default: config.title]
	//       description:  // The body of the email [Default: config.description]
	//     }
	//   }
	}
	
	new ShareButton(config);


	$('.website').click(function(){
		$.post('/action',{action:'website',id:id})
	});
	$('.see-more').click(function(){
		$.post('/action',{action:'youtube',id:id})
	});
	$('.work-with-us').click(function(){
		$.post('/action',{action:'email',id:id})
	});
	$('.skip-video').click(function(){
		$.post('/action',{action:'skip',id:id})
	});

});






