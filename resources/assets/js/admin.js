$(document).ready(function(){

	$('.pie-chart').easyPieChart({
        //your configuration goes here
    });

});

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

  function deleteSubmit(){
  	return confirm('Are you sure?  This cannot be undone.')
  }