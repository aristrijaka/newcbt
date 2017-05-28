<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function toNumber($number) {

    $number = str_replace(' ', '', $number);
    $number = str_replace(',', '', $number);
    $number = str_replace('(', '', $number);
    $number = str_replace(')', '', $number);

    return $number;
}

#mengambil uri berikutnya

function urinext($var='') {
    $CI = & get_instance();
    if (!empty($var)) {
        $CI->uri_next = $CI->uri->uri_to_assoc(2);
        if (!empty($CI->uri_next[$var])) {
            return $CI->uri_next[$var];
        } else {
            $CI->uri_next = $CI->uri->uri_to_assoc(1);
            if (!empty($CI->uri_next[$var])) {
                return $CI->uri_next[$var];
            }
        }
    } else {
        return false;
    }
}

#mengambil seluruh uri sesudah $var

function uriafter($var, $url='') {
    if (!empty($url)) {
        $thisUri = explode('/' . $var . '/', $url);
    } else {
        $thisUri = explode('/' . $var . '/', $_SERVER['REQUEST_URI']);
    }

    if (!empty($thisUri[1])) {
        return $thisUri[1];
    } else {
        return false;
    }
}

#mengambil uri sebelum $var seluruhnya

function uribefore($var, $url='') {
    if (!empty($url)) {
        $thisUri = explode('/' . $var . '/', $url);
    } else {
        $thisUri = explode('/' . $var . '/', $_SERVER['REQUEST_URI']);
    }

    if (!empty($thisUri[0])) {
        return $thisUri[0];
    } else {
        return $_SERVER['REQUEST_URI'];
    }
}

#mengambil uri sesudah $var dari url referer

function refnext($var='') {
    $CI = & get_instance();
    if (!empty($var)) {
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $urls = explode('/', $_SERVER['HTTP_REFERER']);
            foreach ($urls as $index => $val) {
                if (!empty($urls[$index + 1])) {
                    ${$val} = $urls[$index + 1];
                }
            }
            if (!empty(${$var})) {
                return ${$var};
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function tabel($class='myTable', $id='', $js='') {
    if (!empty($id)) {
        $setID = ' id="' . $id . '" ';
    } else {
        $setID = '';
    }
    return '<table cellpadding="5" ' . $setID . '  cellspacing="0" border="0px" bgcolor="#FFFFFF" class="' . $class . '" ' . $js . '>';
}

# PAGINATION

function set_paging($baseURL, $total_row, $num_listing) {
    #pagination-----------------------------------------------------------------------------
    $CI = & get_instance();
    $CI->load->library('pagination');

    $current_url = explode('/page', str_replace('index.php', '?', current_url()));

    $aal_segment = explode('?', $current_url[0]);

    $totaluri = $CI->uri->total_segments();
    $my_segment = explode('/', $aal_segment[1]);

    $config['base_url'] = $baseURL . '/page/';
    $config['uri_segment'] = count($my_segment) + 1; //posisi halaman
    $config['num_links'] = 6; //panjang jumlah halaman yg ditampilkan misal [1][2][3][4][5][6] [>]
    $config['total_rows'] = $total_row;
    $config['per_page'] = $num_listing;
    //$config['page_query_string'] = TRUE;
    #---------------------------------------------------------------------------------------

    $CI->pagination->initialize($config);


    return $CI->pagination->create_links();
}

//add by tmn
//----------------------------------------------------------------------------------------
function set_paging_ajax($baseURL, $total_row, $num_listing) {
    #pagination-----------------------------------------------------------------------------
    $CI = & get_instance();
    $CI->load->library('pagination2');

    $current_url = explode('/page', str_replace('index.php', '?', current_url()));

    $aal_segment = explode('?', $current_url[0]);

    $totaluri = $CI->uri->total_segments();
    $my_segment = explode('/', $aal_segment[1]);

    $config['base_url'] = $baseURL . '/page/';
    $config['uri_segment'] = count($my_segment) + 1; //posisi halaman
    $config['num_links'] = 5; //panjang jumlah halaman yg ditampilkan misal [1][2][3][4][5][6] [>]
    $config['total_rows'] = $total_row;
    $config['per_page'] = $num_listing;
    //$config['page_query_string'] = TRUE;
    #---------------------------------------------------------------------------------------

    $CI->pagination2->initialize($config);


    return $CI->pagination2->create_links();
}

function idr($angka, $rp = true) {
    if ($angka <= 0) {
        $angka = 0;
    }
    $angka = number_format($angka);
    $angka = str_replace(',', '.', $angka);
    if ($rp) {
        $rp_mask = 'Rp. ';
    } else {
        $rp_mask = '';
    }
    $angka = $rp_mask . $angka;

    return $angka;
}

function ttk($angka) {
    $angka = number_format($angka);
    $angka = str_replace(',', '.', $angka);

    return $angka;
}

function rp_js($angka) {
    $angka = number_format($angka, 2, ',', '.');

    return $angka;
}

function rand_captcha($length = 6) {
    $CharPool = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z', '3', '4', '6', '7', '8', '9');
    $PoolLength = count($CharPool) - 1;
    $out = '';
    for ($i = 0; $i < $length; $i++) {
        $out .= $CharPool[mt_rand(0, $PoolLength)];
    }
    return $out;
}

// */
// end of add by tmn
//---------------------------------------------------------------------------------------------------

function set_date($data="") {

    $CI = & get_instance();
    $CI->lang->load('calendar');
    $CI->lang->load('date');

    $time = time();

    $data = str_replace(date("l", $time), $CI->lang->line('cal_' . strtolower(date("l", $time))), $data);
    $data = str_replace(date("D", $time), $CI->lang->line('cal_' . strtolower(date("D", $time))), $data);
    $data = str_replace(date("F", $time), $CI->lang->line('cal_' . strtolower(date("F", $time))), $data);
    $data = str_replace(date("M", $time), $CI->lang->line('cal_' . strtolower(date("M", $time))), $data);
    $name = array('year', 'month', 'week', 'day', 'hour', 'minute', 'second',);
    foreach ($name as $n => $lang_eng) {
        $data = str_replace($lang_eng . 's', $CI->lang->line('date_' . strtolower($lang_eng)), $data);
        $data = str_replace($lang_eng, $CI->lang->line('date_' . strtolower($lang_eng)), $data);
        $data = str_replace(strtoupper($lang_eng . 's'), strtoupper($CI->lang->line('date_' . strtolower($lang_eng))), $data);
        $data = str_replace(strtoupper($lang_eng), strtoupper($CI->lang->line('date_' . strtolower($lang_eng))), $data);
        $data = str_replace(ucfirst($lang_eng . 's'), $CI->lang->line('date_' . strtolower($lang_eng)), $data);
        $data = str_replace(ucfirst($lang_eng), $CI->lang->line('date_' . strtolower($lang_eng)), $data);
    }
    return $data;
}

function toYmd($data) {
    if ($data == '') {
        return false;
    }
    $mode = '';
    if (filter_var($data, FILTER_VALIDATE_FLOAT)) {

        return date('Y-m-d H:i:s', $data);
    } elseif (preg_match('[-]', $data)) {
        $data = str_replace('-', ' ', $data);
    } elseif (preg_match('[/]', $data)) {
        $data = str_replace('/', ' ', $data);
    } else {
        return false;
    }
    $set = explode(' ', $data);

    if (count($set) >= 3) {
        if (strlen($set[0]) == 4) {
            #'Ymd';
            $tgl = $set[0] . '-' . $set[1] . '-' . $set[2];
            if (!empty($set[3])) {
                $tgl.=' ' . $set[3];
            }
            if (!empty($set[4])) {
                $tgl.=' ' . $set[4];
            }
            return $tgl;
        } elseif (strlen($set[2]) == 4) {
            #'dmY';
            $tgl = $set[2] . '-' . $set[1] . '-' . $set[0];
            if (!empty($set[3])) {
                $tgl.=' ' . $set[3];
            }
            if (!empty($set[4])) {
                $tgl.=' ' . $set[4];
            }
            return $tgl;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function toDmy($data) {
    if ($data == '') {
        return false;
    }
    $mode = '';
    if (filter_var($data, FILTER_VALIDATE_FLOAT)) {

        return date('d-m-Y H:i:s', $data);
    } elseif (preg_match('[-]', $data)) {
        $data = str_replace('-', ' ', $data);
    } elseif (preg_match('[/]', $data)) {
        $data = str_replace('/', ' ', $data);
    } else {
        return false;
    }
    $set = explode(' ', $data);
    if (count($set) >= 3) {
        if (strlen($set[0]) == 4) {
            #'dari Ymd';
            if(strlen($set[1]) == 1){$set[1] = '0'.$set[1];}
            if(strlen($set[2]) == 1){$set[2] = '0'.$set[2];}
            $tgl = $set[2] . '-' . $set[1] . '-' . $set[0];
            if (!empty($set[3])) {
                $tgl.=' ' . $set[3];
            }
            if (!empty($set[4])) {
                $tgl.=' ' . $set[4];
            }
            return $tgl;
        } elseif (strlen($set[2]) == 4) {
            #'dari dmY';
            if(strlen($set[1]) == 1){$set[1] = '0'.$set[1];}
            if(strlen($set[0]) == 1){$set[0] = '0'.$set[0];}
            
            $tgl = $set[0] . '-' . $set[1] . '-' . $set[2];
            if (!empty($set[3])) {
                $tgl.=' ' . $set[3];
            }
            if (!empty($set[4])) {
                $tgl.=' ' . $set[4];
            }
            return $tgl;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

//function 'Y-m-d h:m:s' to unix / epoch time
function toMktime($data) {
    if ($data == '') {
        return false;
    }
    $mode = '';
    if (filter_var($data, FILTER_VALIDATE_FLOAT)) {

        return $data;
    } elseif (preg_match('[-]', $data)) {
        $data = str_replace('-', ' ', $data);
    } elseif (preg_match('[/]', $data)) {
        $data = str_replace('/', ' ', $data);
    } else {
        return false;
    }
    $set = explode(' ', $data);
    if (count($set) >= 3) {
        if (strlen($set[0]) == 4) {
            if (empty($set[3])) {
                $set[3] = '0:0:0';
            }
            $time = explode(":", $set[3]);
            $tgl = mktime($time[0], $time[1], $time[2], $set[1], $set[2], $set[0]);
            return $tgl;
        } elseif (strlen($set[2]) == 4) {
            if (empty($set[3])) {
                $set[3] = '0:0:0';
            }
            $time = explode(":", $set[3]);
            $tgl = mktime($time[0], $time[1], $time[2], $set[1], $set[0], $set[2]);
            return $tgl;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function sel_hari($x, $y) {
    $sel = abs(toMktime($x) - toMktime($y));
    return $sel / (86400);
}

function send_email($to, $arr, $thema, $subject = '', $att = array()) {
    $CI = & get_instance();
    //$CI->load->model('page');
    $lang = 'id';
    /*
    if ($CI->page->bahasa == 'english') {
        $lang = 'en';
    }
    */
    $mail = out_row('email_thema', array('email_name' => $thema, 'lang' => $lang));
    if ($subject==''){
        $subject= $mail->subject;
    }
    if (!empty($mail)) {
        $tpl = file_get_contents(base_url() . "css/email_tpl/tpl.html");
        if($mail->tpl != ''){ $tpl = file_get_contents(base_url() . "css/email_tpl/".$mail->tpl);}
        $to == '' ? $send_to = $mail->sendto : $send_to = $to;
        $body = str_replace('{BODY}', $mail->body, $tpl);
        $arr['base_url'] = base_url();
        $arr['top_url'] = top_url();
        $arr['date_now'] = norm_date(date('Y-m-d'), false);
        foreach ($arr as $ax => $bx) {
            $body = str_replace('{' . $ax . '}', $bx, $body);
            $subject = str_replace('{' . $ax . '}', $bx, $subject);
        }

        
        $from = 'info@' . str_replace('www.', '', $_SERVER['HTTP_HOST']);
        //$from = 'Joni blukage';
        //$from = $mail->mail_header;
        
        if($CI->config->item('enable_gmail')){
            $config = $CI->config->item('gmail_config');
            $from = $config['smtp_user'];
        }
        $CI->load->library('email');
        $config['charset'] = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $CI->email->initialize($config);
        $CI->email->set_newline("\r\n");
        $CI->email->from($from);
        $CI->email->to($send_to);
        //$CI->email->bcc('timenmail@gmail.com');
        if($subject == ''){$subject = $mail->subject;}
        $CI->email->subject($subject);
        $CI->email->message($body);
        foreach($att as $x){
            $CI->email->string_attach($x['str'], $x['name'], $x['tipe'], "attachment");
        }
        //$CI->email->string_attach($doc, "invoice.pdf", "application/pdf", "attachment");
        $CI->email->send();
    }
}


function send_sms($number, $str) {
    if (strlen($number) > 6) {
        $CI = & get_instance();

        $CI->db->query("insert into sms(tujuan, isi) values('" . $number . "', '" . $str . "')");
    }
}

function xxsend_sms($number, $arr, $theme) {
    if (strlen($number) > 6) {
        $CI = & get_instance();
        $row = out_row('sms_theme', array('id' => $theme));
        $body = $row->body;
        foreach ($arr as $ax => $bx) {
            $body = str_replace($ax, $bx, $body);
        }
        $CI->db->query("insert into sms(tujuan, isi) values('" . $number . "', '" . $body . "')");
    }
}

function cutWord($word, $num) {
    $descr = strrev(substr($word, 0, $num));
    $cut = strpos($descr, ' ', 0);
    $descr = strrev(substr($descr, $cut));
    return $descr;
}

function get_field($field, $q) {
    $ci = & get_instance();
    $query = $ci->db->query($q);
    $out = '';
    if ($query->num_rows() > 0) {
        $row = $query->row();
        $out = $row->$field;
    }
    return $out;
}

function encrypt($str) {
    $ci = & get_instance();
    $ci->load->library('encrypt');
    return str_replace('%', '_', rawurlencode($ci->encrypt->encode($str)));
}

function decrypt($str) {
    $ci = & get_instance();
    $ci->load->library('encrypt');
    return $ci->encrypt->decode(rawurldecode(str_replace('_', '%', $str)));
}

function echo_opt($query, $id, $view, $val = '') {
    $ci = & get_instance();
    $query = $ci->db->query($query);
    $out = '<option value="">-pilih-</option>';
    foreach ($query->result() as $row) {
        if ($row->$view == $val) {
            $out .= '<option value="' . $row->$id . '" selected>' . $row->$view . '</option>';
        } else {
            $out .= '<option value="' . $row->$id . '">' . $row->$view . '</option>';
        }
    }
    return $out;
}

function write_captcha($str = 6) {
    $_SESSION['captcha'] = rand_captcha($str);
    return '<img src="' . base_url() . 'third_party/captcha/captcha.php"/>';
}

function out_where($tb, $where = 'array', $db = 'db', $setting = array()) {
    if ($db == '') {
        $db = 'db';
    }
    $CI = & get_instance();
    $CI->db_x = db_conn($db);

    foreach ($setting as $key => $sett) {
        if ($key == 'orderby') {
            $CI->db_x->order_by($sett[0], $sett[1]);
        }else if($key == 'limit'){
            $CI->db_x->limit($sett[0], $sett[1]);
        }
    }

    if ($where == 'array') {
        $query = $CI->db_x->query($tb);
    } else {
        $query = $CI->db_x->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return array();
    }
}

function out_num_row($tb, $where = 'array', $db = 'db') {
    $CI = & get_instance();
    $CI->db_x = db_conn($db);
    if ($where == 'array') {
        $query = $CI->db_x->query($tb);
    } else {
        $query = $CI->db_x->get_where($tb, $where);
    }

    return $query->num_rows();
}

function out_row($tb, $where = 'array', $db = 'db') {
    $CI = & get_instance();
    $CI->db_x = db_conn($db);
    if ($where == 'array') {
        $query = $CI->db_x->query($tb);
    } else {
        $query = $CI->db_x->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return array();
    }
}

function out_field($tb, $where = 'array', $field = 'id', $db = 'db') {
    $CI = & get_instance();

    $CI->db_x = db_conn($db);
    if ($where == 'array') {
        $query = $CI->db_x->query($tb);
    } else {
        $query = $CI->db_x->get_where($tb, $where);
    }
    if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->$field;
    } else {
        //return array();
    }
    return '';
}

function next_uri($uri) {
    $out = '';
    $str = explode('/', uri_string());
    reset($str);
    $end = 'N';
    foreach ($str as $t) {
        if ($end == 'Y') {
            $out = $t;
            break;
        }
        if ($t == $uri) {
            $end = 'Y';
        }
    }
    return $out;
}

function db_conn($db_name) {
    //echo $db_name;exit;
    $ci = & get_instance();
    $db = 'db';
    if ($db_name == 'pdb') {
        $db = 'master';
    } else if ($db_name == 'db') {
        $db = 'default';
    }else{
        $db = $db_name;
    } 
    $db_name = $ci->load->database($db, TRUE);
    return $db_name;
}

function label($input) {
    return ucwords(strtolower(str_replace('_', ' ', $input)));
}

function paging($url, $query, $page = 5) {
    $CI = & get_instance();
    $CI->load->library('pagination');

    $config['base_url'] = $url . 'page/';
    $config['cur_page'] = next_uri('page');
    $config['num_links'] = 2;
    $config['total_rows'] = out_num_row($query);
    $config['per_page'] = $page;

    $CI->pagination->initialize($config);

    return $CI->pagination->create_links();
}

function xxxwrite_xls($query, $arr_desc, $arr_field, $title) {
    $CI = & get_instance();
    $CI->excel->init(array('filename' => 'Laporan ' . $title));



    $row = 0;
    $CI->excel->w_header(0, 1, $title);
    // */
    //write heading

    $row = $row + 2;
    foreach ($arr_desc as $x => $y) {
        $CI->excel->w_normal($row, 0, $x . ' ' . $y);
        $row++;
    }
    $row++;
    $col = 1;

    $CI->excel->w_th($row, 0, 'No.');

    $len = array();
    foreach ($arr_field as $y) {
        $CI->excel->w_th($row, $col, $y);
        $col++;
        $len[$col] = 4;
    }

    $row++;
    $CI->excel->freeze_panes($row, 0);
    $no = 1;
    foreach ($query as $ro) {
        $col = 0;
        $CI->excel->w_td_num($row, $col, $no);
        $col++;
        $no++;

        foreach ($ro as $x => $y) {
            is_numeric($y) ? $style = 'w_td_num' : $style = 'w_td';
            $CI->excel->$style($row, $col, $y);
            $col++;
            if (strlen($y) > $len[$col]) {
                $len[$col] = strlen($y);
            }
        }
        $row++;
    }



    $CI->excel->set_column(0, 0, 4);
    foreach ($len as $x => $y) {
        $CI->excel->set_column(0, $x - 1, $y + 3);
    }
    $CI->excel->set_column(0, 1, 104);

    $CI->excel->close();
    // */
}

function write_xls($array, $head = array(), $tpl = ''){
    $ci =& get_instance();
    $ci->load->library('xls');
    $xls = $ci->xls->create();
    $ro = 1;
    $xls_ac = $xls->getActiveSheet();
    $ci->xls->fl = $ro;
    $xls = $ci->xls->add_array($xls, $array);
    $ci->xls->save_xls($xls, 'Report '.date('d.m.Y'));
    
}

function get_string_between($string, $start, $end) {
    $string = " " . $string;
    $ini = strpos($string, $start);
    if ($ini == 0)
        return "";
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function load_cssjs() {
    $ci = & get_instance();
    $out = '';
    if ($ci->session->userdata('cssjs') != '') {
        foreach ($ci->session->userdata('cssjs') as $item) {
            $array['level'] = $item;
            $array['is_active'] = 'Y';
            $out .= _cssjs($array);
        }
    }

    return $out;
}

function _cssjs($array) {
    $ci = & get_instance();
    $out = '';
    foreach (out_where('cms_css_js', $array) as $row) {
        $link = str_replace('{base_url}', base_url(), $row->filename);
        $link = str_replace('{top_url}', top_url(), $link);
        $link = str_replace('{tpl}', $ci->config->item('tpl'), $link);
        $link = str_replace('{form_tpl}', $ci->config->item('form_tpl'), $link);
        if ($row->type == 'css') {
            $rr = '<link rel="stylesheet" href="' . $link . '" type="text/css" />' . "\n";
        } else {
            $rr = '<script type="text/javascript" src="' . $link . '"></script>' . "\n";
        }
        //? $rr = format_js($link) : $rr = format_css($link);
        $out .= $rr;
    }
    return $out;
}

function add_css_js($str) {
    $ci = & get_instance();
    $css = $ci->session->userdata('cssjs');
    $css[] = '';

    if (!in_array($str, $css)) {
        $css[] = $str;
    }
    foreach ($css as $key => $item) {
        if ($item == '') {
            unset($css[$key]);
        }
    }

    $ci->session->set_userdata('cssjs', $css);
}

//khusus untuk sub web
function top_url() {
    $CI = & get_instance();
    $CI->config->item('top_url') ? $url = $CI->config->item('top_url') : $url = base_url();
    return $url;
}

function captcha() {
    $_SESSION['captcha'] = rand_captcha();
    return '<img src="' . top_url() . 'third_party/captcha/captcha.php" /> ';
}

function int2kal($int) {
    $abil = array("zio", "einz", "zwei", "drei", "vier", "funf", "sechs", "sieben", "acht", "neun");
    $out = '';
    foreach (str_split($int) as $item) {
        $out .= $abil[$item] . ' ';
    }
    return str_replace(' ', '-', trim($out));
}

function kal2int($words) {
    $abil = array("zio" => 0, "einz" => 1, "zwei" => 2, "drei" => 3, "vier" => 4, "funf" => 5, "sechs" => 6, "sieben" => 7, "acht" => 8, "neun" => 9);
    $out = '';
    foreach (explode('-', $words) as $word) {
        if (isset($abil[$word])) {
            $out .= $abil[$word];
        }
    }
    $out = $out + 0;
    return $out;
}

function norm_date($date, $jam = true) {
    $date = toMktime($date);
    if($date == 0){return '';}
    if ($jam == true) {
        return date('d M Y H:i:s', $date);
    } else {
        return date('d M Y', $date);
    }
}

function content_format($str) {
    //return nl2br($str);
    return '<div id="art_con">' . $str . '</div>';
}

function wrong_captcha() {
    $CI = & get_instance();
    $CI->session->set_userdata('msg_body', array('link' => $_SERVER['HTTP_REFERER']));
    redirect(base_url() . 'home/main/msg/wrong_captcha/');
}

function db_prefik() {
    return 'db';
}

function is_his() {
    $ci = & get_instance();
    if ($ci->session->userdata('db_hist') == 'arsip') {
        return true;
    } else {
        return false;
    }
}

function re_captcha() {
    $ci = & get_instance();
    $ci->load->helper('captcha');
    // Get a key from https://www.google.com/recaptcha/admin/create
    $publickey = "6LdcEc0SAAAAADmSHkLqTYjcQqbxRp8daAtWlYFP";

    # the error code from reCAPTCHA, if any
    $error = null;

    # was there a reCAPTCHA response?

    return recaptcha_get_html($publickey, $error);
}

function cek_captcha() {
    $ci = & get_instance();
    $ci->load->helper('captcha');
    $privatekey = "6LdcEc0SAAAAAIaDXkUqkQD48JWR4u7HzRFPsVe7";
    # the response from reCAPTCHA
    $resp = null;
    if ($ci->input->post("recaptcha_response_field")) {
        $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
            return true;
        } else {
            return false;
        }
    }
}

function terbilang($x) {
    $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    if ($x < 12)
        return " " . $abil[$x];
    elseif ($x < 20)
        return terbilang($x - 10) . " belas";
    elseif ($x < 100)
        return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200)
        return " seratus" . terbilang($x - 100);
    elseif ($x < 1000)
        return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000)
        return " seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
        return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
        return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}

function xml2array($contents, $get_attributes=1, $priority = 'tag') {
    if (!$contents)
        return array();

    if (!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!"; 
        return array();
    }

    //Get the XML parser of PHP - PHP must have this module for the parser to work 
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

    if (!$xml_values)
        return; //Hmm... 

        
//Initializations 
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array; //Refference 
    //Go through the tags. 
    $repeated_tag_index = array(); //Multiple tags with same name will be turned into an array 
    foreach ($xml_values as $data) {
        unset($attributes, $value); //Remove existing values, or there will be trouble 
        //This command will extract these variables into the foreach scope 
        // tag(string), type(string), level(int), attributes(array). 
        extract($data); //We could use the array by itself, but this cooler. 

        $result = array();
        $attributes_data = array();

        if (isset($value)) {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
        }

        //Set the attributes too. 
        if (isset($attributes) and $get_attributes) {
            foreach ($attributes as $attr => $val) {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr' 
            }
        }

        //See tag status and do the needed. 
        if ($type == "open") {//The starting of the tag '<tag>' 
            $parent[$level - 1] = &$current;
            if (!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag 
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;

                $current = &$current[$tag];
            } else { //There was another element with the same tag name 
                if (isset($current[$tag][0])) {//If there is a 0th element it is already an array 
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                } else {//This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = array($current[$tag], $result); //This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag . '_' . $level] = 2;

                    if (isset($current[$tag . '_attr'])) { //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = &$current[$tag][$last_item_index];
            }
        } elseif ($type == "complete") { //Tags that ends in 1 line '<tag />' 
            //See if the key is already taken. 
            if (!isset($current[$tag])) { //New Key 
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            } else { //If taken, put all things inside a list(array) 
                if (isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...
                    // ...push the new element into that array. 
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;

                    if ($priority == 'tag' and $get_attributes and $attributes_data) {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                } else { //If it is not an array... 
                    $current[$tag] = array($current[$tag], $result); //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes) {
                        if (isset($current[$tag . '_attr'])) { //The attribute of the last(0th) tag must be moved as well
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset($current[$tag . '_attr']);
                        }

                        if ($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken 
                }
            }
        } elseif ($type == 'close') { //End of tag '</tag>' 
            $current = &$parent[$level - 1];
        }
    }

    return($xml_array);
}

function post($post) {
    $ci = & get_instance();
    return $ci->input->post($post);
}

function image_upload($upload_dir = 'assets', $filename, $config = array()){
    $CI = & get_instance();
    //$files = array();
    
    if (count($config) < 1) {
        $config['upload_path'] = realpath($upload_dir);
        if(base_url() != top_url()){
            $config['upload_path'] = realpath('../'.$upload_dir);
        }
        $config['allowed_types'] = 'gif|jpg|jpeg|jpe|png|pdf';
        $config['max_size'] = '2048';
    }
    
    $CI->load->library('upload', $config);

    
    $data = '';
    $arr['nama'] = '';
    if (!$CI->upload->do_upload($filename)) {
        //$error = array('error' => $CI->upload->display_errors());
        $arr['error'] = $CI->upload->display_errors();
        //print_r($arr);
        //exit;
    } else {
        $data = $CI->upload->data();
        if ($data['is_image'] == 1 and ($data['image_width'] > 800)) {
            $con['image_library'] = 'gd2';
            $con['source_image'] = $data['full_path'];
            $con['maintain_ratio'] = TRUE;
            $con['width'] = 800;
            $con['height'] = 2000;
            
            $CI->load->library('image_lib');
            $CI->image_lib->initialize($con);
            //$CI->image_lib->resize();
            $CI->image_lib->clear();
            //$files[$key]['image_height'] = ($file['image_height']/$file['image_width'])*800;
            //$files[$key]['image_width'] = 800;
        }
        $arr['nama'] = $data['file_name'];
    }
    return $arr;
}

function multiple_upload($upload_dir = 'uploads', $config = array()) {
    $CI = & get_instance();
    $files = array();

    if (empty($config)) {
        $config['upload_path'] = realpath($upload_dir);
        $config['allowed_types'] = 'gif|jpg|jpeg|jpe|png|pdf';
        $config['max_size'] = '2048';
    }

    $CI->load->library('upload', $config);
    $errors = FALSE;

    foreach ($_FILES as $key => $value) {
        if (!empty($value['name'])) {
            if (!$CI->upload->do_upload($key)) {
                $data['upload_message'] = $CI->upload->display_errors(); // ERR_OPEN and ERR_CLOSE are error delimiters defined in a config file
                $CI->load->vars($data);

                $errors = TRUE;
            } else {
                // Build a file array from all uploaded files
                $up_data = $CI->upload->data();
                $files[$key] = $up_data;
            }
        }
    }
    // There was errors, we have to delete the uploaded files
    if ($errors) {
        foreach ($files as $key => $file) {
            @unlink($file['full_path']);
        }
    } elseif (empty($files) AND empty($data['upload_message'])) {
        $CI->lang->load('upload');
        $data['upload_message'] = $CI->lang->line('upload_no_file_selected') ;
        $CI->load->vars($data);
    } else {
        foreach($files as $key => $file){
            $CI->load->library('image_lib');
            if ($file['is_image'] == 1 and ($file['image_width'] > 800)) {
                $con['image_library'] = 'gd2';
                $con['source_image'] = $file['full_path'];
                $con['maintain_ratio'] = TRUE;
                $con['width'] = 800;
                $con['height'] = 6000;

                $CI->image_lib->initialize($con);
                $CI->image_lib->resize();
                $CI->image_lib->clear();
                $files[$key]['image_height'] = ($file['image_height']/$file['image_width'])*800;
                $files[$key]['image_width'] = 800;
            }
        }
        
        return $files;
    }
}


function get_option($rows, $param, $val = 0, $opt = true, $title = ''){
    $out = '';
    if($opt){
        $out .= '<option value="">'.$title.'</option>';
    }
    
    
    foreach($rows as $row){
        if($val != 0 and $val == $row->{$param['val']}){
            $out .= '<option value="'.$row->{$param['val']}.'" selected="selected">'.$row->{$param['text']}.'</option>';
            continue;
        } if (isset($param['text2'])){
            $out .= '<option value="'.$row->{$param['val']}.'">'.$row->{$param['text']}.' ('.$row->{$param['text2']}.')</option>';    
        }else{
        $out .= '<option value="'.$row->{$param['val']}.'">'.$row->{$param['text']}.'</option>';
    }
    }
    return $out;
}

function to_array($data) {
    if (is_object($data)) $data = get_object_vars($data);
    return is_array($data) ? array_map(__FUNCTION__, $data) : $data;
}
/*
function nl2p($string, $class='') { 
    $class_attr = ($class!='') ? ' class="'.$class.'"' : ''; 
    return 
        '<p'.$class_attr.'>' 
        .preg_replace('#(<br\s*?/?>\s*?){2,}#', '</p>'."\n".'<p'.$class_attr.'>', nl2br($string, true)) 
        .'</p>'; 
} 
*/

function nl2p($text) {
  $text = str_replace('&nbsp;', '', $text);
  $text = "<p>" . str_replace("\n", "</p><p>", $text) . "</p>";
  return str_replace('<p></p>', '', $text);
}

function nl2li($text) {
  return '<ul style="list-style:none;padding:5px;"><li>' . str_replace("\n", "</li><li>", $text) . '</li></li>';
}

function highlight($word, $subject) { 
    
    $split_subject = explode(" ", $subject); 
    $split_word = explode(" ", $word); 

    foreach ($split_subject as $k => $v){ 
       foreach ($split_word as $k2 => $v2){ 
           if($v2 == $v){ 
               
               $split_subject[$k] = "<span class='highlight'>".$v."</span>"; 
           
           } 
       } 
  } 
  
  return implode(' ', $split_subject); 
} 

function date_select(){
    $array = array();
    $out = '<option value="" >--</option>';
    for($i = 1 ; $i <= 31 ; $i++){
        if($i == date('j')){
            //$out .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
        }
        $out .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $array['tgl'] = $out;
    
    $bln = array( 1 => 'Januari', 'Pebruari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
    $out = '<option value="">--</option>';
    for($i = 1 ; $i <= 12 ; $i++){
        if($i == date('n')){
            //$out .= '<option value="'.$i.'" selected="selected">'.$bln[$i].'</option>';
        }
        $out .= '<option value="'.$i.'">'.$bln[$i].'</option>';
    }
    $array['bln'] = $out;
    
    $out = '<option value="">----</option>';
    for($i = 1990 ; $i <= date('Y') ; $i++){
        if($i == date('Y')){
            //$out .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
        }
        $out .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $array['thn'] = $out;
    return $array;
}

function hello_curl($act, $data, $url = 'http://w3.hellotrans.com/curl_act/'){
    $ci = & get_instance();
    
    $member_exclude = array('1', '3', '8', '9');
    $exclude = false;
    foreach($member_exclude as $item){
        if($data['id_member'] == $item){
            $exclude = true;
            break;
        }
    }
    
    $data['id_member'] = '1248';
    $data['f_deposit'] = '1248';
    
    if($exclude){
        //$data['id_member'] = '49';
        //$data['f_deposit'] = '49';
    }
    
    $array = array(
        'base_url' => base_url(),
        'api_key' => 'asdliasgudasibdasasdbhasiudgasdasuoidhbasouix',
        'data' => $data
    );
    
    $ci->load->library('curl');
    $data = json_decode($ci->curl->simple_post($url.$act, $array));
    //return $data;
    
    if(count($data) > 0 and $data->valid){
        return $data->content;
    }
}

function get_lastid($tb){
    $last_id = out_row('select max(id) as id from '.$tb, 'array');
    $last_id_his = out_row('select max(id_booking) as id from '.$tb.'_his', 'array');
    if(count($last_id) > 0){
        $id_last = $last_id->id + 1;
        if($last_id->id < $last_id_his->id){
            $id_last = $last_id_his->id + 1;
        }
    }else{
        $id_last = $last_id_his->id + 1;
    }
    
    return $id_last;
}

function strip_to_numbers_only($string){
     $pattern = '/[^0-9]/';
     return preg_replace($pattern, '', $string);
}

function text2image($text,$configArray=array(),$filepath='temp'){
    if(trim($text) == "")
        return "";
    $conf = array();
    $conf['background-color'] = isset($configArray['background-color']) ? $configArray['background-color'] : '#FFFFFF';
    $conf['color']            = isset($configArray['color'])            ? $configArray['color'] : '#404040';
    $conf['font-size']        = isset($configArray['font-size'])        ? $configArray['font-size'] : '19';
    $conf['font-file']        = isset($configArray['font-file'])        ? $configArray['font-file'] : 'css/fonts/HelveticaNeue-Condensed.otf';
    $conf['params']           = isset($configArray['params'])           ? $configArray['params'] : '';
    
    // calculate a hash out of the configuration array-> image is only generated if its not found in the filepath
    $str = $text;
    foreach($conf as $key => $val){
        $str .= $key."=".$val;
    }
    $hash = md5($str);
    $imagepath = $filepath.'/'.$hash.'.gif';
    if(!file_exists($imagepath)){
        $data = imagettfbbox($conf['font-size'], 0, $conf['font-file'], $text);
        $x = 0 - $data[6];
        $y = 0 - $data[7]-$data[3];
        //print_r($data);
        
        $y *= 1.1;  //dunno why - but without this line the area will be a bit too small in hight
        //echo $y;
        $res = imagecreate($data[2]*1.05, 2*$data[3] + $y);
        $r = hexdec(substr($conf['background-color'],1,2));
        $g = hexdec(substr($conf['background-color'],3,2));
        $b = hexdec(substr($conf['background-color'],5,2));
        $backgroundcolor = imagecolorallocate($res,$r,$g, $b);
        $r = hexdec(substr($conf['color'],1,2));
        $g = hexdec(substr($conf['color'],3,2));
        $b = hexdec(substr($conf['color'],5,2));
        
        $textcolor = imagecolorallocate($res,$r, $g, $b);
        imagettftext($res, $conf['font-size'], 0, 0, $conf['font-size'], $textcolor, $conf['font-file'], $text);
        
        imagegif($res, $imagepath);
    }
    return '<img src="'.$imagepath.'" border="0" alt="'.$text.'"/>';
    
}

function subval_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}

function cetak_pdf($array, $name = 'invoice', $tpl = 'tpl.pdf', $out = 'D'){
    $ci = & get_instance();    
    $array = array(
        //'company_name' => array('posx' => '21', 'posy' => '66', 'size' => '9', 'val' => ''),
    );
    
    
    
    $ci->load->library('fpdi');
    $file = 'css/pdf_tpl/'.$tpl;
    if(!file_exists('css/pdf_tpl/'.$tpl)){
        $file = '../css/pdf_tpl/'.$tpl;
    }
    $pagecount = $ci->fpdi->setSourceFile($file);
    $tplidx = $ci->fpdi->importPage(1, '/MediaBox');
    //print_r($this->fpdi->getTemplateSize());exit;
    $ci->fpdi->addPage();
    $ci->fpdi->useTemplate($tplidx, 0, 0);
    
    foreach($array as $key=>$item){
        if(!isset($arr[$key])){$arr[$key] = '';}
        $ci->fpdi->SetFont('Arial', '', $item['size']);
        $ci->fpdi->SetXY(0, 0);
        $ci->fpdi->Text($item['posx'], $item['posy'], $item['val'].$arr[$key]);
    }
    
    $doc = $ci->fpdi->Output($name.'.pdf', 'S');
    return $doc;
        
}

function gen_qrcode($str = 'jajal'){
    $ci = & get_instance();    
    $ci->load->library('ciqrcode');

	//header("Content-Type: image/png");
	$params['data'] = $str;
	return $ci->ciqrcode->generate($params);
}

function add_log($id_member, $tipe, $deskripsi = ''){
    $ci = & get_instance();
    $array = array('id_member' => $id_member, 'tipe' => $tipe, 'deskripsi' => $deskripsi);   
    $ci->db->insert('log_hist', $array);
}

function log_e($str){
    $myFile = "log_e.txt";
    $fh = fopen($myFile, 'w') or die("can't open file");
    $str = $str."\n";
    fwrite($fh, $str);
    fclose($fh);
}

function search_val($uri,$key){
    $ci = & get_instance();
    $data = $ci->session->userdata('search');
    $out = '';
    if(isset($data[$uri.'_arr'][$key])){
        $out = $data[$uri.'_arr'][$key];
    }
    return $out;
}

function get_opt_calendar($yago = 10, $span = 70){
    $tgl = '';
    for($i = 1; $i < 32; $i++){
        $tgl .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $bln = '';
    for($i = 1; $i < 13; $i++){
        $bln .= '<option value="'.$i.'">'.$i.'</option>';
    }
    $th = date('Y') - $yago;
    $thn = '';
    for($i = $th; $i >= $th - $span; $i--){
        $thn .= '<option value="'.$i.'">'.$i.'</option>';
    }
    return array('tanggal' => $tgl, 'bulan' => $bln, 'tahun' => $thn);
}

function pre_print($arr){
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
function generate_pdf($object,$file_name='',$dirrect_donload=TRUE){
  require_once("dompdf/dompdf_config.inc.php");
   //require_once("./libraries/dompdf/dompdf_config.inc.php");
   $dompdf=new DOMPDF();
   $dompdf->load_html($object);
   $dompdf->render();
   $dompdf->stream($file_name);
}
function _plugin_assets($plugin = "") {
        return base_url().'assets/plugins/' . $plugin . '/';
}
function _upload_path() {
        return base_url() . 'media/';
}
function record_sort($records, $field, $reverse=false)
{
    $hash = array();
    
    foreach($records as $record)
    {
        $hash[$record[$field]] = $record;
    }
    
    ($reverse)? krsort($hash) : ksort($hash);
    
    $records = array();
    
    foreach($hash as $record)
    {
        $records []= $record;
    }
    
    return $records;
}
function generateRandStr($length){ 
      $randstr = ""; 
      for($i=0; $i<$length; $i++){ 
         $randnum = mt_rand(0,61); 
         if($randnum < 10){ 
            $randstr .= chr($randnum+48); 
         }else if($randnum < 36){ 
            $randstr .= chr($randnum+55); 
         }else{ 
            $randstr .= chr($randnum+61); 
         } 
      } 
      return $randstr; 
 } 

function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
//eof