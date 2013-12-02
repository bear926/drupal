<?php
/*
Plugin Name: Skinnytip Tooltips
Plugin URI: http://www.ebrueggeman.com/skinnytip
Description: Простой генератор всплывающих подсказок. Полный перевод на русский - <a href="http://blogav.ru" target="_blank">GAV</a>
Version: 1.03
Author: Elliott Brueggeman
Author URI: http://www.ebrueggeman.com
*/

//path to skinnytip folder
$skinnytip_path = get_option('siteurl') . "/wp-content/plugins/skinnytip-tooltip-generator/";
//function prints the main tooltip js file into the head
function skinnytip_header() {
global $skinnytip_path;
$header_text = '<!--ToolTip - Полный перевод на русский GAV-->' . "\n";
$header_text .= '<script type="text/javascript" src="' . $skinnytip_path . 'js/skinnytip.js"></script>' . "\n";
print($header_text);
}
//function prints the admin specific js file into the head, allowing generation of tooltip code
function skinnytip_admin_header() {
global $skinnytip_path;
$header_text = '<script type="text/javascript" src="' . $skinnytip_path . 'js/skinnytip_admin.js"></script>' . "\n";
print($header_text);
}
//prints an empty div that tooltips use
function skinnytip_div() {
$div = '<div id="tiplayer" style="position:absolute; visibility:hidden; z-index:10000;"></div>' . "\n";
print($div);
}
//prints admin panel that generates the tooltip code
function skinnytip_write_display() {
global $skinnytip_path;
?>
<div id="postaiosp" class="postbox open">
<h3>Генератор всплывающих подсказок</h3>
<div class="inside">
<div id="postaiosp">
<br />
<p><strong><label for="skinnytip_title">Заголовок окна:</label></strong> 
<input size="32" name="skinnytip_title" id="skinnytip_title" value="" onChange="skinnytip_manage_code();" 
 onKeyUp="skinnytip_manage_code();">
<span style="font-style:italic; color:#666;">Необязательно</span></p>
<p><strong><label for="skinnytip_text">Текст подсказки:</label></strong> 
<input size="64" name="skinnytip_text" id="skinnytip_text" value="" onChange="skinnytip_manage_code();" 
 onKeyUp="skinnytip_manage_code();"></p>
<br />
<p><strong>Тип подсказки:</strong> <input type="radio" name="skinnytip_type" id="skinnytip_type_link" 
 value="link" onClick="skinnytip_manage_type();skinnytip_manage_code();this.blur();" checked>
<label for="skinnytip_type_link">Как ссылка</label>
<input type="radio" name="skinnytip_type" id="skinnytip_type_image" value="image" 
 onClick="skinnytip_manage_type();skinnytip_manage_code();this.blur();">
<label for="skinnytip_type_image">Как картинка</label></p>
<div id="skinnytip_image_div" style="display:none;">
<table style="width:80%;">
<tr>
<td style="text-align:right;"><label for="skinnytip_image">Путь до картинки:</label></td>
<td><input size="40" name="skinnytip_image" id="skinnytip_image" value="http://blogav.ru/extra/images/logo.png" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();" 
 onFocus="skinnytip_manage_greyed_input(this, 'true', 'http://blogav.ru/extra/images/logo.png');" 
 onBlur="skinnytip_manage_greyed_input(this, 'false', 'http://blogav.ru/extra/images/logo.png'); skinnytip_manage_code();">
</td>
</tr>
</table>
</div>
<div id="skinnytip_link_div">
<table style="width:80%;">
<tr>
<td style="text-align:right;"><label for="skinnytip_link">Текст ссылки</label> </td>
<td><input size="40" name="skinnytip_link" id="skinnytip_link" value="Подсказка" onChange="skinnytip_manage_code();" 
 onKeyUp="skinnytip_manage_code();" onFocus="skinnytip_manage_greyed_input(this, 'true', 'Подсказка');" 
  onBlur="skinnytip_manage_greyed_input(this, 'false', 'Подсказка'); skinnytip_manage_code();"></td>
</tr>
<tr>
<td style="text-align:right;"><label for="skinnytip_link">URL ссылки:</label> </td>
<td><input size="40" name="skinnytip_link_dest" id="skinnytip_link_dest" value="#" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();" 
 onFocus="skinnytip_manage_greyed_input(this, 'true', '#');" 
 onBlur="skinnytip_manage_greyed_input(this, 'false', '#'); skinnytip_manage_code();"></td>
</tr>
</table>
</div>
<p><strong>Дополнительные настройки:</strong> 
<input type="radio" name="skinnytip_advanced_options" id="skinnytip_advanced_options_on" value="on" 
 onClick="skinnytip_manage_advanced();skinnytip_manage_code();this.blur();">
<label for="skinnytip_advanced_options_on">ДА</label>
<input type="radio" name="skinnytip_advanced_options" id="skinnytip_advanced_options_off" value="off" 
 onClick="skinnytip_manage_advanced();skinnytip_manage_code();this.blur();" checked>
<label for="skinnytip_advanced_options_off">НЕТ</label></p>
<div id="skinnytip_advanced_div" style="display:none;">
<table style="width:80%;">
<tr>
<td style="text-align:right;"><label for="skinnytip_width">Ширина:</label></td>
<td><input size="4" name="skinnytip_width" id="skinnytip_width" value="200" onChange="skinnytip_manage_code();" 
 onKeyUp="skinnytip_manage_code();">пикс.</td>
<td style="text-align:right;"><label for="skinnytip_backcolor">Цвет фона окна:</label></td>
<td><input size="7" name="skinnytip_backcolor" id="skinnytip_backcolor" value="#FFFFFF" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();"></td>
</tr>
<tr>
<td style="text-align:right;"><label for="skinnytip_border_width">Ширина рамки:</label></td>
<td><input size="4" name="skinnytip_border_width" id="skinnytip_border_width" value="1" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();">пикс.</td>
<td style="text-align:right;"><label for="skinnytip_titlecolor">Цвет заголовка:</label></td>
<td><input size="7" name="skinnytip_titlecolor" id="skinnytip_titlecolor" value="#000000" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();"></td>
</tr>
<tr>
<td style="text-align:right;"><label for="skinnytip_title_padding">Padding заголовка:</label></td>
<td><input size="8" name="skinnytip_title_padding" id="skinnytip_title_padding" value="1px" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();">
<img src="<?php echo $skinnytip_path; ?>images/icon_lightbulb.png" onMouseOver="return tooltip('Устанавливает значение полей вокруг содержимого элемента. Полем называется расстояние от внутреннего края рамки элемента до воображаемого прямоугольника, ограничивающего его содержимое.');" onMouseOut="return hideTip();"></td>
<td style="text-align:right;"><label for="skinnytip_textcolor">Цвет текста:</label></td>
<td><input size="7" name="skinnytip_textcolor" id="skinnytip_textcolor" value="#555" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();"></td>
</tr>
<tr>
<td style="text-align:right;"><label for="skinnytip_text_padding">Padding текста:</label></td>
<td><input size="8" name="skinnytip_text_padding" id="skinnytip_text_padding" value="1px 3px" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();">
<img src="<?php echo $skinnytip_path; ?>images/icon_lightbulb.png" onMouseOver="return tooltip('Устанавливает значение полей вокруг содержимого элемента. Полем называется расстояние от внутреннего края рамки элемента до воображаемого прямоугольника, ограничивающего его содержимое.');" onMouseOut="return hideTip();"></td>
<td style="text-align:right;"><label for="skinnytip_bordercolor">Цвет рамки:</label></td>
<td><input size="7" name="skinnytip_bordercolor" id="skinnytip_bordercolor" value="#8DC70A" 
 onChange="skinnytip_manage_code();" onKeyUp="skinnytip_manage_code();"></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">
<input type="button" onClick="skinnytip_reset_advanced(); skinnytip_manage_code(); this.blur();" value="Сбросить дополнительные настройки">
</td>
</tr>
</table>
<br/>
</div>
<br/>
<strong>Генератор всплывающих подсказок</strong> - скопировать и вставить в окно просмотра HTML в сообщении. <span id="skinnytip_preview"></span>
<textarea id="skinnytip_code" cols="80" rows="3"></textarea>
</div>
</div>
</div>
<?php
}
//add skinnytip tooltip js code to admin & page heads
add_action('wp_head', 'skinnytip_header');
add_action('admin_head', 'skinnytip_header');
//add empty skinnytip div to admin & page heads, necessary to use tooltips
add_action('wp_footer', 'skinnytip_div');
add_action('admin_footer', 'skinnytip_div');
//add js code needed to generate the proper tooltip code for the admin page
add_action('admin_head', 'skinnytip_admin_header');
//add admin widget to page and post write/edit pages
add_action('edit_form_advanced', 'skinnytip_write_display');
add_action('edit_page_form', 'skinnytip_write_display');
?>