require('./bootstrap');
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import Swal from 'sweetalert2';
window.Swal = Swal;
require('./tabl_auto_scroll_down');
require('../vendor/tinymce');
require('./main');

require('jszip');
import pdfMake from "pdfmake/build/pdfmake";
import pdfFonts from "./data_table/fvs_font";
pdfMake.vfs = pdfFonts.pdfMake.vfs;

require('./data_table/fvs_font');
require('datatables.net-bs5');
require('datatables.net-buttons-bs5');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.print.js');
require('datatables.net-colreorder-bs5');
require('datatables.net-datetime');
require('datatables.net-fixedcolumns-bs5');
require('datatables.net-fixedheader-bs5');
require('datatables.net-keytable-bs5');
require('datatables.net-responsive-bs5');
require('datatables.net-rowgroup-bs5');
require('datatables.net-select-bs5');

