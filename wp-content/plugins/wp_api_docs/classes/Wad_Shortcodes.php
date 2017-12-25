<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_Shortcodes" ) ) : 
    
class Wad_Shortcodes { 
    
    public function __construct() {
       add_shortcode('wad_table', array($this, 'sc_wad_table'));
    }
    
	
	
	/* ----------------------------------------------------------------
	 * Shortcode function - 
	 * :: will start a new row.
	 *
	   [wad_table]
	   header1,header2,header3::
	   value1,value2,value3
	   [/wad_table]
	 * ---------------------------------------------------------------- */
	function sc_wad_table( $atts, $content = '' ) 
	{	
		global $fe_templates;
		
		extract( shortcode_atts( array(
			'alt' => '',
		), $atts ) );
		
		$html = '';
		
		$content = str_replace(array('<br />', '<br/>', '<br>'), array('', '', ''), $content);
		$content = str_replace('<p>', '', $content);
		$content = str_replace('</p>', '', $content);
		
		$content 		= str_replace('&nbsp;','',$content);
		$char_codes 	= array( '&#8216;', '&#8217;', '&#8220;', '&#8221;', '&#8242;', '&#8243;' );
		$replacements 	= array( "'", "'", '"', '"', "'", '"' );
		$content = str_replace( $char_codes, $replacements, $content );
		
		
		$data = explode('::', $content);
		
		$data = array_diff($data, array('', ' '));
		$data = array_values($data);
		
		$html.= '<table>';
		
			foreach($data as $i => $row)
			{
				$values = explode(',', $row);
				$td = !$i ? 'th' : 'td';
				
				// thead
				$html.= !$i ? '<thead>' : '';
				$html.= $i == 1 ? '<tbody>' : '';
				
					$html.= '<tr>';
						foreach($values as $value){
							$html.= '<'.$td.'>'.trim($value).'</'.$td.'>';
						}
					$html.= '</tr>';
				
				$html.= $i == 1 ? '</tbody>' : '';
				$html.= !$i ? '</thead>' : '';
			}
		
		$html.= '</table>';
		
		return $html;
	}
	
    

}
    
endif;
?>