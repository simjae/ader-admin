var world_clock_seoul = AmCharts.makeChart( "world-clock-seoul", {
  "type": "gauge",
  "theme": "light",
  "startDuration": 0.3,
  "marginTop": 0,
  "marginBottom": 0,
  "axes": [ {
    "axisAlpha": 0.3,
    "endAngle": 360,
    "endValue": 12,
    "minorTickInterval": 0.2,
    "showFirstLabel": false,
    "startAngle": 0,
    "axisThickness": 1,
    "valueInterval": 1
  } ],
  "arrows": [ {
    "radius": "50%",
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailRadius": 10,
    "nailAlpha": 1
  }, {
    "nailRadius": 0,
    "radius": "80%",
    "startWidth": 6,
    "innerRadius": 0,
    "clockWiseOnly": true
  }, {
    "color": "#CC0000",
    "nailRadius": 4,
    "startWidth": 3,
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailAlpha": 1
  } ],
  "export": {
    "enabled": false
  }
} );

var world_clock_1 = AmCharts.makeChart( "world-clock-1", {
  "type": "gauge",
  "theme": "light",
  "startDuration": 0.3,
  "marginTop": 0,
  "marginBottom": 0,
  "axes": [ {
    "axisAlpha": 0.3,
    "endAngle": 360,
    "endValue": 12,
    "minorTickInterval": 0.2,
    "showFirstLabel": false,
    "startAngle": 0,
    "axisThickness": 1,
    "valueInterval": 1
  } ],
  "arrows": [ {
    "radius": "50%",
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailRadius": 10,
    "nailAlpha": 1
  }, {
    "nailRadius": 0,
    "radius": "80%",
    "startWidth": 6,
    "innerRadius": 0,
    "clockWiseOnly": true
  }, {
    "color": "#CC0000",
    "nailRadius": 4,
    "startWidth": 3,
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailAlpha": 1
  } ],
  "export": {
    "enabled": false
  }
} );

var world_clock_2 = AmCharts.makeChart( "world-clock-2", {
  "type": "gauge",
  "theme": "light",
  "startDuration": 0.3,
  "marginTop": 0,
  "marginBottom": 0,
  "axes": [ {
    "axisAlpha": 0.3,
    "endAngle": 360,
    "endValue": 12,
    "minorTickInterval": 0.2,
    "showFirstLabel": false,
    "startAngle": 0,
    "axisThickness": 1,
    "valueInterval": 1
  } ],
  "arrows": [ {
    "radius": "50%",
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailRadius": 10,
    "nailAlpha": 1
  }, {
    "nailRadius": 0,
    "radius": "80%",
    "startWidth": 6,
    "innerRadius": 0,
    "clockWiseOnly": true
  }, {
    "color": "#CC0000",
    "nailRadius": 4,
    "startWidth": 3,
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailAlpha": 1
  } ],
  "export": {
    "enabled": false
  }
} );

var world_clock_3 = AmCharts.makeChart( "world-clock-3", {
  "type": "gauge",
  "theme": "light",
  "startDuration": 0.3,
  "marginTop": 0,
  "marginBottom": 0,
  "axes": [ {
    "axisAlpha": 0.3,
    "endAngle": 360,
    "endValue": 12,
    "minorTickInterval": 0.2,
    "showFirstLabel": false,
    "startAngle": 0,
    "axisThickness": 1,
    "valueInterval": 1
  } ],
  "arrows": [ {
    "radius": "50%",
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailRadius": 10,
    "nailAlpha": 1
  }, {
    "nailRadius": 0,
    "radius": "80%",
    "startWidth": 6,
    "innerRadius": 0,
    "clockWiseOnly": true
  }, {
    "color": "#CC0000",
    "nailRadius": 4,
    "startWidth": 3,
    "innerRadius": 0,
    "clockWiseOnly": true,
    "nailAlpha": 1
  } ],
  "export": {
    "enabled": false
  }
} );

// update each second
setInterval( updateClock, 1000 );

// update clock
function updateClock() {
	var date = new Date();
	var date_1 = new Date();
	var date_2 = new Date();
	var date_3 = new Date();
	var hours,minutes,seconds;
	date_1.setTime(date_1.getTime()-(13*60*60*1000)); // 뉴욕
	date_2.setTime(date_2.getTime()+(1*60*60*1000)); // 홍콩
	date_3.setTime(date_3.getTime()-(8*60*60*1000)); // 영국

	// get current date
	if(world_clock_seoul.arrows.length > 0){
		hours = date.getHours();
		minutes = date.getMinutes();
		seconds = date.getSeconds();
		if(world_clock_seoul.arrows[ 0 ].setValue){
			// set hours
			world_clock_seoul.arrows[ 0 ].setValue( hours + minutes / 60 );
			// set minutes
			world_clock_seoul.arrows[ 1 ].setValue( 12 * ( minutes + seconds / 60 ) / 60 );
			// set seconds
			world_clock_seoul.arrows[ 2 ].setValue( 12 * date.getSeconds() / 60 );
		}
	}


	for(var i=1;i<=3;i++) {
		if(eval("world_clock_"+i).arrows.length > 0){
			hours = eval("date_"+i).getHours();
			minutes = eval("date_"+i).getMinutes();
			seconds = eval("date_"+i).getSeconds();

			if(eval("world_clock_"+i).arrows[ 0 ].setValue){
				eval("world_clock_"+i).arrows[ 0 ].setValue( hours + minutes / 60 );
				eval("world_clock_"+i).arrows[ 1 ].setValue( 12 * ( minutes + seconds / 60 ) / 60 );
				eval("world_clock_"+i).arrows[ 2 ].setValue( 12 * seconds / 60 );
			}
		}
	}
}