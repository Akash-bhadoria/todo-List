import "./bootstrap";
import swal from "sweetalert2";
import moment from "moment";

import Alpine from "alpinejs";

window.Alpine = Alpine;
window.Swal = swal;

window.moment = moment;

Alpine.start();
