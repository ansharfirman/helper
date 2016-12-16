<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  	function getModul()
	{
		$CI =& get_instance(); 
		$CI->load->model('Modul_m', 'modul');

		$condition  = array('parentId' => '0');
		$listModul  = $CI->modul->getModul($condition)->result_array();
		$listModuls = array();

		foreach ($listModul as $key) {
			$condition  = array('parentId' => $key['id']);
			$list2      = $CI->modul->getModul($condition);
			$listModul2 = $list2->result_array();
			$hasChild   = $list2->num_rows();
			
			if ($hasChild > 0) {
				$child = '1';
			} else {
				$child = '0';
			}
			
			$tmp = array(
						'menu'     => $key['name'],
						'url'      => $key['url'],
						'level'    => '1',
						'hasChild' => $child,
						'closing'  => '0',
						'id'       => $key['id']
					);
			array_push($listModuls, $tmp);

			foreach ($listModul2 as $key2) {
				$condition  = array('parentId' => $key2['id']);
				$list3      = $CI->modul->getModul($condition);
				$listModul3 = $list3->result_array();
				$hasChild   = $list3->num_rows();
				$condition  = array('parentId' => $key['id']);
				$closing    = $CI->modul->getClosing($condition)->row_array();
			
				if ($hasChild > 0) {
					$child = '1';
				} else {
					$child = '0';
				}

				if ($key2['id'] == $closing['id']) {
					$closing = '1';
				} else {
					$closing = '0';
				}

				if ($child == 1 and $closing == 1) {
					$closing = 0;
				}
				
				
				$tmp = array(
						'menu'     => $key2['name'],
						'url'      => $key2['url'],
						'level'    => '2',
						'hasChild' => $child,
						'closing'  => $closing,
						'id'       => $key2['id']
					);
				array_push($listModuls, $tmp);

				foreach ($listModul3 as $key3) {
					$condition  = array('parentId' => $key2['id']);
					$closing    = $CI->modul->getClosing($condition)->row_array();

					if ($key3['id'] == $closing['id']) {
						$closing = '1';
					} else {
						$closing = '0';
					}

					$tmp = array(
						'menu'     => $key3['name'],
						'url'      => $key3['url'],
						'level'    => '3',
						'hasChild' => '0',
						'closing'  => $closing,
						'id'       => $key3['id']
					);
					array_push($listModuls, $tmp);
				}
			}
		}

		return json_encode($listModuls);
	}

?>