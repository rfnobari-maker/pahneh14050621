function edit_row(id)
{
 var num_row  =document.getElementById("num_row_val"+id).innerHTML;
 var num_t_row=document.getElementById("num_t_row_val"+id).innerHTML;
 var h_t      =document.getElementById("h_t_val"+id).innerHTML;
 var w_t      =document.getElementById("w_t_val"+id).innerHTML;


 document.getElementById("num_row_val"+id)  .innerHTML="<input type='text' style='width:70px; height:30px ; ' id='num_row_text"+id+"' value='"+num_row+"'>";
 document.getElementById("num_t_row_val"+id).innerHTML="<input type='text' style='width:70px; height:30px ; ' id='num_t_row_text"+id+"' value='"+num_t_row+"'>";
 document.getElementById("h_t_val"+id)      .innerHTML="<input type='text' style='width:70px; height:30px ; ' id='h_t_text"+id+"' value='"+h_t+"'>";
 document.getElementById("w_t_val"+id)      .innerHTML="<input type='text' style='width:70px; height:30px ; ' id='w_t_text"+id+"' value='"+w_t+"'>";
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
}

function save_row(id)
{
 var num_row=document.getElementById("num_row_text"+id).value;
 var num_t_row=document.getElementById("num_t_row_text"+id).value;
 var h_t=document.getElementById("h_t_text"+id).value;
 var w_t=document.getElementById("w_t_text"+id).value;
 var zer_kesh = num_row * num_t_row * h_t * w_t  ; 
//var zer_kesh = 135.2300 ; 
 var zer_kesh = Math.round(zer_kesh*100) / 100 ;
 document.getElementById("zer_kesh_val"+id)      .innerHTML= zer_kesh ; 	

 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row:'edit_row',
   row_id:id,
   num_row_val:num_row,
   num_t_row_val:num_t_row,
   h_t_val:h_t,
   w_t_val:w_t
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("num_row_val"+id).innerHTML=num_row;
    document.getElementById("num_t_row_val"+id).innerHTML=num_t_row;
    document.getElementById("h_t_val"+id).innerHTML=h_t;
    document.getElementById("w_t_val"+id).innerHTML=w_t;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
   }
  }
 });
}

function delete_row(id)
{
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   delete_row:'delete_row',
   row_id:id,
  },
  success:function(response) {
   if(response=="success")
   {
    var row=document.getElementById("row"+id);
    row.parentNode.removeChild(row);
   }
  }
 });
}

function insert_row()
{
 var num_row=document.getElementById("new_num_row").value;
 var num_t_row=document.getElementById("new_num_t_row").value;
 var h_t=document.getElementById("new_h_t").value;
 var w_t=document.getElementById("new_w_t").value;
 var zer_kesh = num_row * num_t_row * h_t * w_t  ; 
 var zer_kesh = Math.round(zer_kesh*100) / 100 ; 
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   insert_row:'insert_row',
   num_row_val:num_row,
   num_t_row_val:num_t_row,
   h_t_val:h_t,
   w_t_val:w_t

  },
  success:function(response) {
   if(response!="")
   {
    var id=response;
    var table=document.getElementById("user_table");
    var table_len=(table.rows.length)-1;

	
	

    var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='num_row_val"+id+"'>"+num_row+"</td><td id='num_t_row_val"+id+"'>"+num_t_row+"</td><td id='num_h_t_val"+id+"'>"+h_t+"</td><td id='w_t_val"+id+"'>"+w_t+"</td><td id='zer_kesh_val"+id+"'>"+zer_kesh+"</td><td><input type='button' class='edit_button' id='edit_button"+id+"' value='ویرایش' onclick='edit_row("+id+");'/><input type='button' class='save_button' id='save_button"+id+"' value='ذخیره' onclick='save_row("+id+");'/><input type='button' class='delete_button' id='delete_button"+id+"' value='حذف' onclick='delete_row("+id+");'/></td></tr>";

    document.getElementById("new_num_row").value="";
    document.getElementById("new_num_t_row").value="";
    document.getElementById("new_h_t").value="";
    document.getElementById("new_w_t").value="";

   }
  }
 });
}