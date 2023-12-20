var categoryDate = [];
var groupDate = [];
var gradeDate = [];
var dbDate = [];

var tableBodyCategory =  $('#table_body_category');
var tableBodyGroup =  $('#table_body_group');
var tableBodyGrade =  $('#table_body_grade');
var tableBodyDB =  $('#table_body_db');

var url = "../controller/otherController.php";

$(document).ready(function () {
    categoryList();
})

function categoryList(){

    var url = "../controller/otherController.php";
    var data = {
        category : "load",
    };
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "json", // 추가된 부분
        success: function (data) {

            // console.log("categoryListajax");
            // console.log(data);
            tableBodyCategory.empty();
            tableBodyGroup.empty();
            tableBodyGrade.empty();
            tableBodyDB.empty();

            for(var i=0; i<data.length;i++){
                if (data[i][2] === 'category') {
                    categoryDate.push(data[i]);
                }
                if (data[i][2] === 'mb_group') {
                    groupDate.push(data[i]);
                }
                if (data[i][2] === 'grade') {
                    gradeDate.push(data[i]);
                }
                if (data[i][2] === 'db_ct') {
                    dbDate.push(data[i]);
                }
            }
            
            //console.log(dbDate);
            
            for(var i=0; i<categoryDate.length;i++){
                var messageDivCategory = $("<tr class='fixed-height'></tr>").html("<td scope='col'><input type='checkbox' name='chk_category' id='chk_"+categoryDate[i][0]+"'><input type='hidden' name='ck_no' class='number' value='"+categoryDate[i][0]+"'></td><td scope='col'><input type='text' class='input' value='"+categoryDate[i][1]+"'></td>");
                tableBodyCategory.append(messageDivCategory);
            }
            for(var i=0; i<groupDate.length;i++){
                var messageDivGroup = $("<tr class='fixed-height'></tr>").html("<td scope='col'><input type='checkbox' name='chk_group' id='chk_"+groupDate[i][0]+"'><input type='hidden' name='ck_no' class='number' value='"+groupDate[i][0]+"'></td><td scope='col'><input type='text' class='input' value='"+groupDate[i][1]+"'></td>");
                tableBodyGroup.append(messageDivGroup);
            }
            for(var i=0; i<gradeDate.length;i++){
                var messageDivGrade = $("<tr class='fixed-height'></tr>").html("<td scope='col'><input type='checkbox' name='chk_grade' id='chk_"+gradeDate[i][0]+"'><input type='hidden' name='ck_no' class='number' value='"+gradeDate[i][0]+"'></td><td scope='col'><input type='text' class='input' value='"+gradeDate[i][1]+"'></td>");
                tableBodyGrade.append(messageDivGrade);
            }
            for(var i=0; i<dbDate.length;i++){
                var messageDivDb= $("<tr class='fixed-height'></tr>").html("<td scope='col'><input type='checkbox' name='chk_db' id='chk_"+dbDate[i][0]+"'><input type='hidden' name='ck_no' class='number' value='"+dbDate[i][0]+"'></td><td scope='col'><input type='text' class='input' value='"+dbDate[i][1]+"'></td>");
                tableBodyDB.append(messageDivDb);
            }
            

        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}




$("#selectBtn").click(function () {
    // var rowData = new Array();
    var tdArr_grade = new Array();
    var tdArr_group = new Array();
    var tdArr_category = new Array();
    var tdArr_db = new Array();

    var checkbox_grade = $("input[name=chk_grade]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_group = $("input[name=chk_group]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_category = $("input[name=chk_category]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_db = $("input[name=chk_db]:checked"); // 수정된 부분: 클래스로 체크박스를 선택

    // 체크된 체크 박스 i갯수만큼 반복 
    // console.log(checkbox_grade);
    // console.log(checkbox_group);
    // console.log(checkbox_category);
    

    if (checkbox_grade.length >= 1) {
        checkbox_grade.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value1 = td.eq(1).find('.input').val();
            var num = td.eq(0).find('.number').val();
            var item1 = {
                name: value1,
                no : num,
                category: "grade",
            };

            // rowData.push(tr.val());
            tdArr_grade.push(item1);
        });
    }

    if (checkbox_group.length >= 1) {
        checkbox_group.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value2 = td.eq(1).find('.input').val();
            var num1 = td.eq(0).find('.number').val();
            var item2 = {
                name: value2,
                no : num1,
                category: "group",
            };
            // rowData.push(tr.val());
            tdArr_group.push(item2);
        });
    }

    if (checkbox_category.length >= 1) {
        checkbox_category.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value3 = td.eq(1).find('.input').val();
            var num2 = td.eq(0).find('.number').val();
            var item3 = {
                name: value3,
                no : num2,
                category: "category",
            };
            // rowData.push(tr.val());
            tdArr_category.push(item3);
        });
    }

    if (checkbox_db.length >= 1) {
        checkbox_db.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value4 = td.eq(1).find('.input').val();
            var num4 = td.eq(0).find('.number').val();
            var item4 = {
                name: value4,
                no : num4,
                category: "db_ct",
            };
            // rowData.push(tr.val());
            tdArr_db.push(item4);
        });
    }

    // console.table(tdArr_grade);
    // console.table(tdArr_group);
    // console.table(tdArr_category);
    // console.table(tdArr_category);

    var data = {
        category : "modify",
        tdArr_grade : tdArr_grade,
        tdArr_group : tdArr_group,
        tdArr_category : tdArr_category,
        tdArr_db : tdArr_db,
    };
    
    
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        // dataType: "json", // 추가된 부분
        success: function () {
            // 새로고침
            location.reload();
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });

});

$("#deleteBtn").click(function () {

    let data = seleChk("delete");

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function () {
            // 새로고침
            location.reload();
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
})

function seleChk(type){
    var tdArr_grade = new Array();
    var tdArr_group = new Array();
    var tdArr_category = new Array();
    var tdArr_db = new Array();

    var checkbox_grade = $("input[name=chk_grade]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_group = $("input[name=chk_group]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_category = $("input[name=chk_category]:checked"); // 수정된 부분: 클래스로 체크박스를 선택
    var checkbox_db = $("input[name=chk_db]:checked"); // 수정된 부분: 클래스로 체크박스를 선택

    // 체크된 체크 박스 i갯수만큼 반복 
    // console.log(checkbox_grade);
    // console.log(checkbox_group);
    // console.log(checkbox_category);
    

    if (checkbox_grade.length >= 1) {
        checkbox_grade.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value1 = td.eq(1).find('.input').val();
            var num = td.eq(0).find('.number').val();
            var item1 = {
                name: value1,
                no : num,
                category: "grade",
            };

            // rowData.push(tr.val());
            tdArr_grade.push(item1);
        });
    }

    if (checkbox_group.length >= 1) {
        checkbox_group.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value2 = td.eq(1).find('.input').val();
            var num1 = td.eq(0).find('.number').val();
            var item2 = {
                name: value2,
                no : num1,
                category: "group",
            };
            // rowData.push(tr.val());
            tdArr_group.push(item2);
        });
    }

    if (checkbox_category.length >= 1) {
        checkbox_category.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value3 = td.eq(1).find('.input').val();
            var num2 = td.eq(0).find('.number').val();
            var item3 = {
                name: value3,
                no : num2,
                category: "category",
            };
            // rowData.push(tr.val());
            tdArr_category.push(item3);
        });
    }

    if (checkbox_db.length >= 1) {
        checkbox_db.each(function (i) {
            var tr = $(this).closest('tr'); // 현재 체크박스의 부모 <tr>을 선택
            var td = tr.children();

            // 체크된 tr 내 순서내 값 가져오기
            var value4 = td.eq(1).find('.input').val();
            var num4 = td.eq(0).find('.number').val();
            var item4 = {
                name: value4,
                no : num4,
                category: "db_ct",
            };
            // rowData.push(tr.val());
            tdArr_db.push(item4);
        });
    }

    // console.table(tdArr_grade);
    // console.table(tdArr_group);
    // console.table(tdArr_category);
    // console.table(tdArr_category);

    var data = {
        category : type,
        tdArr_grade : tdArr_grade,
        tdArr_group : tdArr_group,
        tdArr_category : tdArr_category,
        tdArr_db : tdArr_db,
    };

    return data;
}