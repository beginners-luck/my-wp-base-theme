<form id="siteSearchForm" action="/" method="get">
	<fieldset>
		<table>
			<tr>
				<td valign="top" nowrap="" align="left"><input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
					<input type="submit" id="search-submit" alt="Search" value="Search" />
				</td>
				<div id="searchClose"></div>
			</tr>
		</table>
	</fieldset>
</form>