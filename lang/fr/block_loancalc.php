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
$string['pluginname'] = 'Calculatrice de prêt';
$string['loancalc'] = 'Calculatrice de prêt';
$string['amountofloan'] = 'Montant du prêt';
$string['repaymentamount'] = 'Montant des paiements';
$string['interestrate'] = 'Taux d\'interêt';
$string['loanterm'] = 'Durée du prêt (années)';
$string['repaymentfreq'] = 'Fréquence des paiements';
$string['fortnightly'] = 'Bimensuelle';
$string['monthly'] = 'Mensuelle';
$string['weekly'] = 'Hebdomadaire';
$string['calculate'] = 'Calculer';
$string['error_onlynumber'] = 'Saisir un nombre';
$string['error_dividebyzero'] = 'Calcul impossible : division par zéro.';
$string['error_empty_ir'] = 'Vous devez saisir un taux d\'interêt.';
$string['error_cantcomputeperiod'] = 'Impossible de calculer la durée avec les données saisies';
$string['error_insufficientir'] = 'Le montant des paiements est inférieur aux intêrets. Vous devez augmenter vos paiements pour rembourser votre prêt !';