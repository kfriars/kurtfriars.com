let swal = require('sweetalert2');

export default {

	confirm(opts) {
		var defaultOptions = {
			title: 'Are you sure?',
			text: 'You will not be able to undo this action!',
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#ed8936",
			cancelButtonColor: "#a0aec0",
			confirmButtonText: 'Continue',
			cancelButtonText: 'No, Cancel',
			customClass: 'swal-confirm'
		};

		var options = $.extend({}, defaultOptions, opts);

		return swal.fire(options);

	},

	success(opts) {
		var defaultOptions = {
			title: 'Success!',
			icon: "success",
			timer: null,
			showConfirmButton: true,
			confirmButtonText: 'Continue',
			confirmButtonColor: "#48bb78",
			customClass: 'swal-success'
		};

		var options = $.extend({}, defaultOptions, opts);
		return swal.fire(options);
	},

	info(opts) {
		var defaultOptions = {
			title: 'Information',
			icon: "info",
			confirmButtonColor: "#4299e1",
			customClass: 'swal-info'
		};

		var options = $.extend({}, defaultOptions, opts);
		return swal.fire(options);
	},

	error(opts) {
		var defaultOptions = {
			title: 'There Was a Problem',
			text: '',
			icon: "error",
			showConfirmButton: true,
			confirmButtonColor: "#e53e3e",
			customClass: 'swal-error',
			timer: null
		};

		var options = $.extend({}, defaultOptions, opts);
		return swal.fire(options);
	}
}
