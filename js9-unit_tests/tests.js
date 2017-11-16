QUnit.module('tests from previous homework');

//leadZero
QUnit.test('test leadZero', function ( assert ) {
    assert.equal(dashboard.leadZero(1), '01', 'leadZero(1) = 1 true');
    assert.notEqual(dashboard.leadZero(11), '011', 'leadZero(11) = 11 not true');
    assert.ok(dashboard.leadZero(5) == '05', 'leadZero(5) = 05 OK');
    assert.strictEqual(dashboard.leadZero(-3), '03', 'leadZero(-3) === 03 true');
    assert.strictEqual(dashboard.leadZero('9y'), undefined, 'leadZero(9y) === 03 false');
});
//sum
QUnit.test( "test sum", function( assert ) {
    assert.equal(dashboard.sum(-1,1), 0, 'sum(-1,1) = 0 true');
    assert.notEqual(dashboard.sum(1,1), 0, 'sum(1,1) != 0 true');
    assert.strictEqual(dashboard.sum(0.1,0.2), 0.3, 'sum( 0.1 , 0.2 ) = 0.3 true');
    assert.ok(dashboard.sum('1', 1) == undefined, 'sum(\'1\', 1) == undefined Ok');
    assert.notOk(dashboard.sum('a', 'b') == 'ab', 'sum(\'a\', \'b\') == \'ab\' notOk');
});

//formatDate
QUnit.test('test formatDate', function ( assert ) {
    assert.equal(dashboard.formatDate(1510158800000), "18:33 at 08-11-2017", ' formatDate(1510158800000) = 18:33 at 08-11-2017 true');
    assert.notEqual(dashboard.formatDate(-1510158800000), "18:33 at 08-11-2017", ' formatDate(-1510158800000) != 18:33 at 08-11-2017 true');
    assert.ok(dashboard.formatDate("text") == "Invalid timestamp", ' formatDate("text") == "Invalid timestamp" OK');
    assert.equal(dashboard.formatDate(1510158800000000),"Invalid timestamp", ' formatDate(1510158800000000) = "Invalid timestamp" true');
    assert.equal(dashboard.formatDate(151), "03:00 at 01-01-1970", ' formatDate(151) =  "03:00 at 01-01-1970" true');


});

//formatDateAgo
QUnit.test('test formatDateAgo', function ( assert ) {
    assert.equal(dashboard.formatDateAgo(Date.now()-2000), "2 seconds ago", ' formatDateAgo(NOW - 2 sec) = 2 seconds ago true');
    assert.notEqual(dashboard.formatDateAgo(Date.now()+2000), "in 2 seconds", ' formatDateAgo(NOW + 2 sec) !=  in 2 seconds  true');
    assert.ok(dashboard.formatDateAgo(Date.now()-1000000000) == "2 weeks ago", ' formatDateAgo(NOW - 1000000000 msec) == "2 weeks ago"  ok');
    assert.notOk(dashboard.formatDateAgo(Date.now()-10000000000000) == "20000 weeks ago", ' formatDateAgo(NOW - 10000000000000 msec) == "20000 weeks ago"  notOK');
    assert.strictEqual(dashboard.formatDateAgo("sometime"), "Invalid timestamp", ' formatDateAgo("sometime") === "Invalid timestamp" true');
});
