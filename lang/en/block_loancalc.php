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
$string['pluginname'] = 'Loan calculator';
$string['loancalc'] = 'Loan calculator';
$string['amountofloan'] = 'Amount of loan';
$string['repaymentamount'] = 'Repayment amount';
$string['interestrate'] = 'Interest rate';
$string['loanterm'] = 'Loan term (years)';
$string['repaymentfreq'] = 'Repayment frequency';
$string['fortnightly'] = 'Fortnightly';
$string['monthly'] = 'Monthly';
$string['weekly'] = 'Weekly';
$string['calculate'] = 'Calculate';
$string['error_onlynumber'] = 'Numbers only to be entered';
$string['error_dividebyzero'] = 'Divide by zero error.';
$string['error_empty_ir'] = 'You must enter an interest rate (ir).';
$string['error_cantcomputeperiod'] = 'Can\'t compute Number of Periods for the present values.';
$string['error_insufficientir'] = 'The repayment amount is less than the interest. You must increase your repayments to pay off this loan!';