<?php
function redirection($url, $temps){
echo "<script type=\"text/javascript\">\n"
	. "<!--\n"
	. "\n"
	. "function redirect() {\n"
	. "window.location='" . html_entity_decode($url) . "';\n"
	. "}\n"
	. "setTimeout('redirect()','$temps');\n"
	. "\n"
	. "// -->\n"
	. "</script>\n";
}
?>