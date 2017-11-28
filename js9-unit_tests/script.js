var dashboard = {};

dashboard.init = function() {
	// fix dates
	var dates = document.querySelectorAll('.date');
	for(var i = 0; i < dates.length; i++) {
		var timestamp = dates[i].innerText;
		dates[i].setAttribute('title', dashboard.formatDate(timestamp));
		dates[i].innerText = dashboard.formatDateAgo(timestamp);
	}

};
dashboard.leadZero = function(num) {
	if (typeof num === "number"){
		num < 0 ? num = Math.abs(num) : '';
        return num < 9 ? "0" + num : '' + num;
	}
	return;
};

/**
 *
 * @param a
 * @param b
 * @returns {number}
 */
dashboard.sum = function(a, b) {
	if(typeof a !== 'string' && typeof b !== 'string'){
        var sum = a + b;
        var pattern = /^\d+\.\d+0{9,}\d$/;
        if (pattern.test(sum)) {
            var findIndexOfZeros = sum.toString().indexOf('000000000');
            sum = sum.toPrecision(findIndexOfZeros - 2);
        }
        return (+sum);
    }
};

/**
 *
 * @param a
 * @returns {number}
 */
dashboard.lieRound = function(a) {
	return Math.round(a);
};

/**
 *
 * @param timestamp
 * @returns {*}
 */
dashboard.formatDate = function(timestamp) {

	if(typeof timestamp !== 'number' ){
        return "Invalid timestamp";
	}

	if(!(timestamp > 1 && timestamp < Date.now())){
        return "Invalid timestamp";
    }

	var d = new Date(+timestamp);

 	return dashboard.leadZero(d.getHours()) + ':' +
		dashboard.leadZero(d.getMinutes()) + ' at ' +
		dashboard.leadZero(d.getDate()) + '-' +
		dashboard.leadZero(d.getMonth()+1) + '-' +
		d.getFullYear();
};

/**
 *
 * @param timestamp
 * @returns {*}
 */
dashboard.formatDateAgo = function(timestamp) {
    var currentDate = +(new Date());

    if(!(timestamp > 1 && timestamp < currentDate)){
        return "Invalid timestamp";
    }

    if(typeof timestamp !== 'number' ){
        return "Invalid timestamp";
    }

	var result = '';
	var delta = (currentDate - timestamp)/1000;
	var timelines = {
		weeks: 7 * 24 * 60 * 60,
		days: 24 * 60 * 60,
		hours: 60 * 60,
		minutes: 60,
		seconds: 1
	};
	var foundTimeline;
	for(var i in timelines) {
		//console.log('delta = ' + delta + '  --  ' + i + ' = ' + timelines[i] );
		if(delta > timelines[i]) {
			foundTimeline = i;
			break;
		}
	}
	var timePassed = Math.floor(Math.round(delta/timelines[foundTimeline]));
	result = timePassed + ' ' + foundTimeline + ' ago';
	return result;
};