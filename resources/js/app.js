require('./bootstrap');
import $ from 'jquery';
window.jQuery = $;
window.$ = $;

import Swal from 'sweetalert2';
window.Swal = Swal;

import DataTable from 'datatables.net-dt';
window.DataTable = DataTable;

require('./tabl_auto_scroll_down');
require('../vendor/tinymce');
require('./main');
