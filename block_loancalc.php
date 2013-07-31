<?php
// This file is part of the loancalc plugin for Moodle
// This plugin is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This plugin is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this plugin.  If not, see <http://www.gnu.org/licenses/>.


/**
 *
 * @package loancalc
 * @author Arnaud Trouvé - based on code by Dongsheng Cai
 * @copyright 2013 Arnaud Trouvé
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_loancalc extends block_base
{

    function init()
    {
        $this->title = get_string('loancalc', 'block_loancalc');
    }

    function get_content()
    {
        global $CFG;
        $this->content = new stdClass();
        $calc = $CFG->wwwroot . '/pix/t/calc.png';
        $this->content->text = '
        <script type="text/javascript">
       // <![CDATA[
    function num_format(x) { // format numbers with two digits
    sgn = (x < 0);
    x = Math.abs(x);
    x = Math.floor((x * 100) + .5);
    i = 3;
    y = "";
    while(((i--) > 0) || (x > 0)) {
        y = (x % 10) + y;
        x = Math.floor(x / 10);
        if(i == 1) {
            y = "." + y;
        }
    }
    if(sgn) {
        y = "-" + y;
    }
    return(y);
}
function comp(v) { // general entry point for all cases
    // convert all entry fields into variables
    x = document.getElementById("loancalcform");
    pv = parseFloat(x.loanamount.value);
    lpp = parseFloat(x.loanpayperiod[x.loanpayperiod.selectedIndex].value);
    if (isNaN(pv) && (v != "pv"))
    {
        x.loanamount.select();
        x.loanamount.focus();
        alert("' . get_string('error_onlynumber', 'block_loancalc') . '");
        return;
    }
    fv = parseFloat("0");
    yr = parseFloat(x.loanterm.value);
    if (isNaN(yr) && (v != "np"))
    {
        x.loanterm.select();
        x.loanterm.focus();
        alert("' . get_string('error_onlynumber', 'block_loancalc') . '");
        return;
    }
    np = lpp * yr;
    pmt = -parseFloat(x.loanrepayment.value);
    if (isNaN(pmt) && (v != "pmt"))
    {
        x.loanrepayment.select();
        x.loanrepayment.focus();
        alert("' . get_string('error_onlynumber', 'block_loancalc') . '");
        return;
    }
    if(x.loaninterestrate.value == "") {
        alert("' . get_string('error_onlynumber', 'block_loancalc') . '");
    }
    else {
        ir = parseFloat(x.loaninterestrate.value);
        if (isNaN(ir))
        {
            x.loaninterestrate.select();
            x.loaninterestrate.focus();
            alert("' . get_string('error_onlynumber', 'block_loancalc') . '");
            return;
        }
        ir = ((ir / lpp) / 100);

        // test and compute all cases
        if (v == "pv") {
            if(ir == 0) {
                pv = -(fv + (pmt * np));
            }
            else {
                q1 = Math.pow(1 + ir,-np);
                q2 = Math.pow(1 + ir,np);
                pv = -(q1 * (fv * ir - pmt + q2 * pmt))/ir;
            }
            x.loanamount.value = num_format(pv);
        }

        if (v == "np") {
            if(ir == 0) {
                if(pmt != 0) {
                    np = - (fv + pv)/pmt;
                }
                else {
                    alert("' . get_string('error_dividebyzero', 'block_loancalc') . '");
                }
            }
            else {
                np = Math.log((-fv * ir + pmt)/(pmt + ir * pv))/ Math.log(1 + ir);
            }
            if(np == 0) {
                alert("' . get_string('error_dividebyzero', 'block_loancalc') . '");
            }
            else {
                np = (np / lpp)
                if (isNaN(np)) {
                    alert("' . get_string('error_insufficientir', 'block_loancalc') . '");
                } else {
                    x.loanterm.value = num_format(np);
                }
            }
        }

        if (v == "pmt") {
            if(ir == 0.0) {
                if(np != 0) {
                    pmt = (fv + pv)/np;
                }
                else {
                    alert("' . get_string('error_dividebyzero', 'block_loancalc') . '");
                }
            }
            else {
                q = Math.pow(1 + ir,np);
                pmt = ((ir * (fv + q * pv))/(-1 + q));
            }
            x.loanrepayment.value = num_format(pmt);
        }
    }
} // function comp
//]]>
</script>';

        $calculate_tag = html_writer::empty_tag('img', array('src' => $calc, 'alt' => get_string('calculate', 'block_loancalc')));
        $block_content = '';
        $block_content .= html_writer::div(
            html_writer::label(get_string('amountofloan', 'block_loancalc'), 'loanamount')
                . html_writer::tag('input', '', array('name' => 'loanamount', 'type' => 'text'))
                . html_writer::tag('a', $calculate_tag, array('href' => "javascript:comp('pv');")));

        $block_content .= html_writer::div(
            html_writer::label(get_string('repaymentamount', 'block_loancalc'), 'loanrepayment')
                . html_writer::tag('input', '', array('name' => 'loanrepayment', 'type' => 'text'))
                . html_writer::tag('a', $calculate_tag, array('href' => "javascript:comp('pmt');")));

        $block_content .= html_writer::div(
            html_writer::label(get_string('loanterm', 'block_loancalc'), 'loanterm')
                . html_writer::tag('input', '', array('name' => 'loanterm', 'type' => 'text'))
                . html_writer::tag('a', $calculate_tag, array('href' => "javascript:comp('np');")));

        $block_content .= html_writer::div(
            html_writer::label(get_string('interestrate', 'block_loancalc'), 'loaninterestrate')
                . html_writer::tag('input', '', array('name' => 'loaninterestrate', 'type' => 'text')));

        $loanperiod_options = array(
            12 => get_string('monthly', 'block_loancalc'),
            26 => get_string('fortnightly', 'block_loancalc'),
            52 => get_string('weekly', 'block_loancalc')
        );
        $block_content .= html_writer::div(
            html_writer::label(get_string('repaymentfreq', 'block_loancalc'), 'repaymentfreq')
            . html_writer::select($loanperiod_options, 'loanpayperiod', 12));
        $block_content = html_writer::tag('form', $block_content, array('id' => 'loancalcform'));


        $this->content->text .= $block_content;

        return $this->content;
    }
}
?>
