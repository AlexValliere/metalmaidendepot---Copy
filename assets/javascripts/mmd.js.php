<script type="text/javascript">
/* *********************************************************
 * Metal maiden tree
 * ********************************************************* */
$(document).ready(function(){
/*	$nodes = $('span[data-node-rarity=blue], span[data-node-rarity=purple]');*/
	$nodes = $('span[data-node-rarity=blue]');

	if ($('span[data-node-id=1]').attr('data-node-rarity') != "blue")
	{
		$nodes.each(function() {
			$(this).text("[ + ]");
			$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').children("div").hide();
		});
	}

	$('span[data-node-id]').click(function(){
		if ($(this).text() == "[ - ]")
		{
			$(this).text("[ + ]");
			$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').children("div").hide();
			//$('div[data-node-id = ' + (parseInt($(this).attr('data-node-id'))) + ']').hide();
		}
		else if ($(this).text() == "[ + ]")
		{
			$(this).text("[ - ]");
			$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').children("div").show();
			//$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').show();
		}
	});

	$('img[data-node-id]').click(function(){
		$span_node = $('span[data-node-id=' + $(this).attr('data-node-id') + ']');

		if ($span_node.text() == "[ - ]")
		{
			$span_node.text("[ + ]");
			$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').children("div").hide();
			//$('div[data-node-id = ' + (parseInt($(this).attr('data-node-id'))) + ']').hide();
		}
		else if ($span_node.text() == "[ + ]")
		{
			$span_node.text("[ - ]");
			$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').children("div").show();
			//$('div[data-node-id=' + (parseInt($(this).attr('data-node-id'))) + ']').show();
		}
	});
});

/* *********************************************************
 * Top navbar fix
 * ********************************************************* */
var onResize = function() {
  // apply dynamic padding at the top of the body according to the fixed navbar height
  $("body").css("padding-top", $(".navbar-fixed-top").height());
};

// attach the function to the window resize event
$(window).resize(onResize);

// call it also when the page is ready after load or reload
$(function() {
  onResize();
});

/* *********************************************************
 * Advanced search
 * ********************************************************* */
$(document).ready(function(){
	$('.show-single').click(function(){
		$target = $( 'div#' + $(this).attr('target') );
		$target.toggle();
	});

	<?php
	if (isset($tank_list_json))		echo '$tank_list = ' . $tank_list_json . ';';
	else							echo '$tank_list = [];';
	?>

	$tank_results = [];

	function sortByTank(a, b)
	{
		if (a["tank"] < b["tank"]) return -1;
		if (a["tank"] > b["tank"]) return 1;
		return 0;
	}

	function advanced_search_print_results( $tank_results ) {
		$("#advanced_search_results").empty();

		$tank_results.sort(sortByTank);

		$.each($tank_results, function (index, value) {
			$text =
				  '<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">'
				+ '<table class="table table-responsive table-bordered advanced_search_tank_table">'
				+ '<tr>'
				+ '<td class="lifestyle_skills">'
			;

			for (var i in $tank_results[index].talents)
			{
				$text = $text
					+ '<img src="<?php echo LIFESTYLE_SKILLS; ?>' + $tank_results[index].talents[i] + '.png" alt="' + $tank_results[index].talents[i] + '\'s icon" />'
					+ $tank_results[index].talents_with_level[i][1]
					+ '<br />'
				;
			}

			$text = $text
				+ '</td>'
				+ '<td class="tank_portrait">'
				+ '<a href="index.php?route=metal_maiden&amp;tank=' + $tank_results[index].tank_slug + '">'
				+ '<img src="<?php echo TANKS_DIR . "portrait/"; ?>' + $tank_results[index].tank.replace('/', '_') + '.png" alt="' + $tank_results[index].tank + ' portrait" class="tank_portrait img-responsive" />'
				+ '</a>'
				+ '</td>'
				+ '<td style="vertical-align: middle;">'
				+ '<a href="<?php echo link_to_route("metal_maiden") . "&amp;tank="; ?>' +  $tank_results[index].tank_slug + '" class="' + $tank_results[index].rarity + '_rarity_text">'
				+ $tank_results[index].tank
				+ '</a>'
				+ '<br />'
				+ 'N' + $tank_results[index].blueprint_rank + ' '
				+ '<img src="<?php echo TANK_CATEGORIES_DIR; ?>' + $tank_results[index].category +'.png" alt="" class="tank_icons" />'
				+ '<img src="<?php echo NATIONAL_FLAGS_DIR; ?>' + $tank_results[index].nation +'.png" alt="" class="tank_icons" />'
				+ '</td>'
				+ '</tr>'
				+ '</table>'
				+ '</div>'
			;

			$("#advanced_search_results").append($text);
		});
	}

	function advanced_search_print_detailed_results( $tank_results ) {
		$("#advanced_search_detailed_results").empty();

		$tank_results.sort(sortByTank);

		$sortable_values = ["tank", "rarity", "blueprint_rank", "category", "firepower", "penetration", "targeting", "durability", "armor", "evasion", "stealth", "detection"];

		$text =
			'<div class="table-responsive">'
			+ '<table class="table table-condensed table-bordered" id="advanced_search_detailed_results_table">'
				+ '<thead>'
					+ '<tr>';

		$.each($sortable_values, function(index, value) {
			$text = $text
				+ '<th style="text-transform: capitalize;">'
					+ value.replace("_", " ")
				+ '</th>';
		});

		$text = $text + '</thead></tr><tbody>';

		$.each($tank_results, function (index, value) {

			$text = $text
				+ '<tr>'
					+ '<td>'
						+ '<a href="index.php?route=metal_maiden&amp;tank=' + $tank_results[index].tank_slug + '" class="' + $tank_results[index].rarity + '_rarity_text">'
							+ $tank_results[index].tank
						+ '</a>'
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].rarity
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].blueprint_rank
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].category
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].firepower
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].penetration
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].targeting
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].durability
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].armor
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].evasion
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].stealth
					+ '</td>'
					+ '<td>'
						+ $tank_results[index].detection
					+ '</td>'
				+ '</tr>';
		});

		$text = $text
			+ '</tbody></table></div>';

		$("#advanced_search_detailed_results").append($text);
	}

	$advanced_search_filters = [];
	$advanced_search_filters["ammo"] = [];
	$advanced_search_filters["blueprint_rank"] = [];
	$advanced_search_filters["blueprint_rank_filter"] = [];
	$advanced_search_filters["category"] = [];
	$advanced_search_filters["chassis"] = [];
	$advanced_search_filters["engines"] = [];
	$advanced_search_filters["nation"] = [];
	$advanced_search_filters["rarity"] = [];
	$advanced_search_filters["talents"] = [];
	$advanced_search_filters["armor_ids"] = [];
	$advanced_search_filters["chassis_ids"] = [];
	$advanced_search_filters["engine_ids"] = [];
	$advanced_search_filters["shell_ids"] = [];

	$("section.advanced_search .filter_icon").click(function() {
		$or_filters = ["category"];
		$and_filters = ["ammo", "blueprint_rank_filter", "chassis", "engines", "nation", "rarity", "talents", "armor_ids", "chassis_ids", "engine_ids", "shell_ids"];

		if ( !$(this).hasClass("active") )
		{
			$(this).addClass("active");
			$( "section.advanced_search [input-id=" + $(this).attr('filter-id') + "]" ).prop('checked', true);
			console.log("Adding to results tanks with " + $(this).attr('filter-type') + " = " + $(this).attr('filter-id'));

/*			if ($.inArray($(this).attr('filter-type'), $and_filters) == -1)
			{
				$tank_results = $.merge($tank_results, $tank_list.filter(x => x[$(this).attr('filter-type')] === $(this).attr('filter-id')));
			}
			else if ($.inArray($(this).attr('filter-type'), $and_filters) > -1)
			{
				$tanks_to_add = $tank_list.filter(x => $.inArray( $(this).attr('filter-id'), x[$(this).attr('filter-type')] ) > -1);
				$tank_results = $.merge($tank_results, $tanks_to_add);
			}
*/
			$advanced_search_filters[$(this).attr('filter-type')] = $.merge($advanced_search_filters[$(this).attr('filter-type')], [$(this).attr('filter-id')]);

			// advanced_search_print_results( $tank_results );
		}	
		else
		{
			$(this).removeClass("active");
			$( "section.advanced_search [input-id=" + $(this).attr('filter-id') + "]" ).prop('checked', false);
			console.log("Removing from results tanks with " + $(this).attr('filter-type') + " = " + $(this).attr('filter-id'));

/*			if ($.inArray($(this).attr('filter-type'), $and_filters) == -1)
			{
				$tanks_to_remove = $tank_list.filter(x => x[$(this).attr('filter-type')] === $(this).attr('filter-id'));
				$tank_results = $($tank_results).not($tanks_to_remove).get();
			}
			else if ($.inArray($(this).attr('filter-type'), $and_filters) > -1)
			{
				$tanks_to_remove = $tank_list.filter(x => $.inArray( $(this).attr('filter-id'), x[$(this).attr('filter-type')] ) > -1);
				$tank_results = $($tank_results).not($tanks_to_remove).get();
			}*/

			$advanced_search_filters[$(this).attr('filter-type')] = $($advanced_search_filters[$(this).attr('filter-type')]).not([$(this).attr('filter-id')]).get();

			// advanced_search_print_results( $tank_results );
		}

		// Start retrieving results from selected filters
		$tank_results = [];

		// Get an initial list of tanks from OR filters
		for (i in $or_filters)
		{
			// $or_filters[i]
			if ($or_filters[i].length > 0)
			{
				for (j in $advanced_search_filters[$or_filters[i]])
				{
					// $advanced_search_filters[$or_filters[i]][j]
					$tanks_to_add = $tank_list.filter(x => x[ $or_filters[i] ] === $advanced_search_filters[$or_filters[i]][j] );
					$tank_results = $.merge($tank_results, $tanks_to_add);
				}
			}
		}

		// If tanks are not found with OR filters, repeat with AND filters
		if ($tank_results.length === 0)
		{
			for (i in $and_filters)
			{
				for (j in $advanced_search_filters[$and_filters[i]])
				{
					// console.log("test : " + $and_filters[i] + " - " + $advanced_search_filters[$and_filters[i]][j] + " . " + $tank_list[0][ $and_filters[i] ]);
					if ( jQuery.type($tank_list[0][ $and_filters[i] ]) === "array" )
					{
						$tank_results = $tank_list.filter(x => $.inArray( $advanced_search_filters[$and_filters[i]][j], x[ $and_filters[i] ] ) > -1);
					}
					else
					{
						// console.log("AND filter = " + $and_filters[i] + " - isArray " + $tank_list[0][ $and_filters[i] ] );
						$tank_results = $tank_list.filter(x => x[ $and_filters[i] ] === $advanced_search_filters[$and_filters[i]][j] );
					}
				}
			}
		}

		// If there is a tank list, applies AND filters
		if ($tank_results.length > 0)
		{
			for (i in $and_filters)
			{
				for (j in $advanced_search_filters[$and_filters[i]])
				{
					if ( jQuery.type($tank_list[0][ $and_filters[i] ]) === "array" )
					{
						$tank_results = $tank_results.filter(x => $.inArray( $advanced_search_filters[$and_filters[i]][j], x[ $and_filters[i] ] ) > -1);
					}
					else
					{
						$tank_results = $tank_results.filter(x => x[ $and_filters[i] ] === $advanced_search_filters[$and_filters[i]][j] );
					}
				}
			}
		}

		advanced_search_print_results( $tank_results );
		advanced_search_print_detailed_results( $tank_results );
		$('#advanced_search_detailed_results_table').DataTable();
	});
});
</script>