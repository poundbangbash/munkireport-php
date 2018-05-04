    <h2 data-i18n="sentinelone.client_tab"></h2>

    <div id="sentinelone-msg" data-i18n="listing.loading" class="col-lg-12 text-center"></div>

    <div id="sentinelone-view" class="row hide">
        <div class="col-md-6">
                <h2 data-i18n="sentinelonequarantine.sentinelone_quarantine"></h2>
			<table class="table table-striped">
				<tr>
					<th data-i18n="sentinelonequarantine.path"></th>
					<td id="sentinelonequarantine-path"></td>
				</tr>
				<tr>
					<th data-i18n="sentinelonequarantine.uuid"></th>
					<td id="sentinelonequarantine-uuid"></td>
				</tr>
            </table>
        </div>
        <div class="col-md-6">
        </div>
    </div>

<script>
$(document).on('appReady', function(e, lang) {

    // Get sentinelone data
    $.getJSON( appUrl + '/module/sentinelonequarantine/get_data/' + serialNumber, function( data ) {
            // Hide
            $('#sentinelone-msg').text('');
            $('#sentinelone-view').removeClass('hide');

            // Add strings
            $('#sentinelonequarantine-path').text(data.path);
            $('#sentinelonequarantine-uuid').text(data.uuid);
            
        });
});

</script>
