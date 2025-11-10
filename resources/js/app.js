import $ from 'jquery';
window.$ = window.jQuery = window.jquery = $;

// import 'bootstrap';

import 'datatables.net-bs4'; 
import DataTable from 'datatables.net-bs5';


// Other extensions (they automatically hook into jQuery once DataTable is bound)
import 'datatables.net-responsive-bs5';

import select2 from 'select2';
select2(window, $);
import 'select2/dist/js/select2.full.js';
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css';

window.DataTable = DataTable;

import 'jquery-validation';