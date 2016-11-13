$(document).ready(function(){

	$('.pie-chart').easyPieChart({
        //your configuration goes here
    });

  var client = $('.wysiwyg').attr('data-client-id');
  $('.wysiwyg').redactor({
    plugins: ['codemirror','fullscreen','imagemanager','table'],
    buttons: ['bold','italic','horizontalrule','link','image', 'file',],
    codemirror: {
        lineNumbers: true,
        mode: 'xml',
        indentUnit: 2,
        tabSize:2,
        indentWithTabs:true,
        theme:'blackboard zenburn'
    },
    imageUpload: '/admin/media_assets/upload?client='+client,
    imageManagerJson: '/admin/media_assets/images?client='+client,
    fileUpload: '/admin/media_assets/uploadFiles?client='+client,
    callbacks:{
      imageUploadError: function(json, xhr){
        window.alert('image upload failed');
      },
      fileUploadError: function(json, xhr){
        window.alert('file upload failed');
      }
    },
  });

  $('.copy-template-submit').click(function(e){
    e.preventDefault();
    if(window.confirm('are you sure? this will replace your current template content entirely.') === false){
      return false;
    }
    var id = $('.copy-template').val();
    $.get('/admin/touches/getTemplate/'+id,function(html){
      $('.wysiwyg').redactor('code.set',html);
    }); 
  });
});

function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

  function deleteSubmit(){
  	return confirm('Are you sure?  This cannot be undone.')
  }