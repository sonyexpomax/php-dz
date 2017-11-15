var testPack = [
	{
		name: "lieRound",
		func: dashboard.lieRound,
		mock: 'Math.round = function(a) { return a+1};',
		tests: [
			[[1], 2],
			[[3.6], 4.6],
			[[5.99], 6.99]
		]
	},
	{
		name: "leadZero",
		func: dashboard.leadZero,
		tests: [
			[[1], "01"],
			[[3], "03"],
			[[5], "05"],
			[[10], "10"],
			[[30], "30"]
		]
	},
	{
		name: "sum",
		func: dashboard.sum,
		tests:[[[-1,1], 0],
			[[2,2], 4],
			[[3,3], 6],
			[[0.1,0.2], 0.3],
			[['1',1], undefined],
			[['a','b'], undefined]
		]
	},
	{
		name: "formatDate",
		func: dashboard.formatDate,
		tests:[
			[[1510158800000], "18:33 at 08-11-2017"],
            [["text"], "Invalid timestamp"],
            [[1510158800000000], "Invalid timestamp"],
            [[-1510000000], "Invalid timestamp"],
            [[151], "03:00 at 01-01-1970"],

        ]
	},
	{
		name: "formatDateAgo",
		func: dashboard.formatDateAgo,
		tests:[
            [[Date.now()-1000], "2 seconds ago"],
            [[Date.now()+1000], "Invalid timestamp"],
            [[Date.now()-1000000000], "2 weeks ago"],
            [[Date.now()-10000000000000], "Invalid timestamp"],
			[["text"], "Invalid timestamp"],
		]
	}
];