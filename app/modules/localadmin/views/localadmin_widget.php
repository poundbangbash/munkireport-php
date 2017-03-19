	<div class="col-lg-4 col-md-6">
	<div class="panel panel-default">
		<div class="panel-heading" data-container="body" data-i18n="[title]localadmin.widget.tooltip">
			<h3 class="panel-title"><i class="fa fa-user-secret"></i> <span data-i18n="localadmin.widget.title"></span></h3>
		</div>
		<div class="list-group scroll-box"></div>
	</div><!-- /panel -->
</div><!-- /col -->

<script>
$(document).on('appUpdate', function(e, lang) {
	
	var box = $('#localadmin-widget div.scroll-box');
	
	$.getJSON( appUrl + '/module/localadmin/get_localadmin', function( data ) {
		
		box.empty();
		if(data.length){
			$.each(data, function(i,d){
				var badge = '<span class="badge pull-right">'+d.count+'</span>';
                box.append('<a href="'+appUrl+'/show/listing/localadmin/localadmin/#'+d.users+'" class="list-group-item">'+d.users+badge+'</a>')
			});
		}
		else{
			box.append('<span class="list-group-item">'+i18n.t('localadmin.nolocaladmin')+'</span>');
		}
	});
});	
</script>
