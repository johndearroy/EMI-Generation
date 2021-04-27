import Swal from 'sweetalert2'
import axios from "axios";
import moment from 'moment';

let Helper = {};

Helper.api = axios.create({
    //baseURL: '/api/',
    timeout: 1000,
});

Helper.getInitial = (value, firstIndex, lastIndex) => {
    return value.split(" ").slice(firstIndex, lastIndex).map((n)=>n[0].toUpperCase()).join("");
};

Helper.formatByMoment = (value, format) => {
    return moment(value).format(format);
};

Helper.notify = (position, icon, text, toast, timer, showConfirmButton) => {
    Swal.fire({
        position: position || 'top-end',
        icon: icon || 'success',
        title: text || '',
        showConfirmButton: showConfirmButton || false,
        timer: timer || 1000,
        toast: toast || true
    });
};

export default Helper;
